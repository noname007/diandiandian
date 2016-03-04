<?php

namespace app\controllers;

use app\models\IssusSearch;
use app\models\Issus;
use app\models\CpyRest;
use yii\helpers\VarDumper;
use Yii;
use yii\helpers\Html;
use app\models\OrderForm;
use app\models\Menu;
use app\models\Order;
use app\models\IssusMember;

class CpyController extends \yii\web\Controller
{
    
    public $defaultAction = 'menu';
    
    function actionFind_rest()
    {
        $search = new IssusSearch();
        $dataProvider = $search->search(\Yii::$app->request->queryParams);
        
        $rest_id = implode($this->getSupplyRestIds(),',');
        
        $query = $dataProvider->query->andWhere(['type'=>Issus::TYPE_RESTRANT,'status'=>Issus::NORMAL]);
        if($rest_id){
            $query->andWhere('id not in('.$rest_id.')');
        }
        
        return  $this->render('display',[
            'searchModel' => $search,
            'dataProvider' => $dataProvider,
            'isFindRest' =>true,
        ]);
    }
    
    
    protected  function getSupplyRestIds(){
        $cpy = Issus::find()->select('id')->where(['type'=>Issus::TYPE_CPY,'user_id'=>\Yii::$app->user->getId()])->asArray()->one();
        $cpys = CpyRest::find()->select('rest_id')->where(['cpy_id'=>$cpy['id']])->asArray()->all();
//         $cond_in = implode(, ',');
        return array_column($cpys, 'rest_id');
    }
    
    
    function actionAdd()
    {
        
        $rest_id =\Yii::$app->request->get('id','');

        if(!Issus::find()->where(['id'=>$rest_id,'type'=>Issus::TYPE_RESTRANT])->exists()){
            echo 'param error,no this restaurant';
            \Yii::$app->end();
        }
        
        $cpy = Issus::find()->select('id')->where(['type'=>Issus::TYPE_CPY,'user_id'=>\Yii::$app->user->getId()])->asArray()->one();
      
        if(CpyRest::find()->where(['cpy_id'=>$cpy['id'],'rest_id'=>$rest_id])->exists())
        {
            echo '餐馆已经添加';
            Yii::$app->end();
        }
        
        $model =  new CpyRest;
        $model->cpy_id = $cpy['id'];
        $model->rest_id = $rest_id;
        
        if($model->save())
        {
           echo '添加成功';
           
        }else{
            Yii::error(VarDumper::dumpAsString($model->getErrors()),'CPY_ADD');
            echo '保存失败，请联系系统管理员';
        }

         
    }
    
    function actionView() {
        $search = new IssusSearch();
        $dataProvider = $search->search(\Yii::$app->request->queryParams);
        
        $rest_id = implode($this->getSupplyRestIds(),',');
        
        $query = $dataProvider->query->andWhere(['type'=>Issus::TYPE_RESTRANT,'status'=>Issus::NORMAL]);
        if($rest_id){
            $query->andWhere('id  in('.$rest_id.')');
        }else{
            echo Html::a('去添加','/cpy/find_rest');
            \Yii::$app->end();
        }
        
        return  $this->render('display',[
            'searchModel' => $search,
            'dataProvider' => $dataProvider,
            'isFindRest' =>false,
        ]);
    }
    
    
    function actionDel() {
        $rest_id =\Yii::$app->request->get('id','');
        
        $cpy = Issus::find()->select('id')->where(['type'=>Issus::TYPE_CPY,'user_id'=>\Yii::$app->user->getId()])->asArray()->one();
        $model = CpyRest::find()->where(['cpy_id'=>$cpy['id'],'rest_id'=>$rest_id])->one();
        if(!$model)
        {
            echo 'param error,no this restaurant';
            Yii::$app->end();
        }
        
        $model->delete();
        echo '已删除';
        
    }
    
    function actionMenu()
    {
        $get_menu_sql = 'select name,restaurant_id,money,id from  (select rest_id from cpy_rest cr,issus_member im where im.issus_id = cr.cpy_id and im.user_id = :user_id) t,menu m where m.restaurant_id = t.rest_id and status = 0 group by t.rest_id';
        $menus = \Yii::$app->db->createCommand($get_menu_sql,[':user_id'=>\Yii::$app->user->getId()])->queryAll();
         
    
        //TODO 具体显示
        
        /*
         * array (size=1)
              0 => 
                array (size=4)
                  'name' => string '中华小吃' (length=12)
                  'restaurant_id' => string '4' (length=1)
                  'money' => string '120' (length=3)
                  'id' => string '1' (length=1)
         */
        //         var_dump($menus);
        // //         exit;
        
        
       foreach ($menus as $key=>$v)
       {
            $menus[$key]['name'] .= ' '. round($menus[$key]['money'] /100,2).'元';    
       }
       
       return $this->render('order',['model'=>new OrderForm(),'menus'=>$menus]);
    }
    
    function actionOrder_foods()
    {
        $post = \Yii::$app->request->post();
        
        if(!isset($post['OrderForm']['menus'])){
            echo '参数错误';
            \Yii::$app->end();
        }
        
        $daybegin=strtotime(date("Ymd"));
        $dayend=$daybegin+86400;
        $alread_book = Order::find()->where("create_at>$daybegin and create_at < $dayend")->exists();
        
       if($alread_book){
           echo '已经预定过';
           \Yii::$app->end();
       }
        
        $menu_id = array_filter($post['OrderForm']['menus'],function ($menu_id){
            if(is_numeric($menu_id) && $menu_id > 0){
                return true;
            }else{
                return false;
            }
        });
        
        if(empty($menu_id)){
            echo '参数错误';
            \Yii::$app->end();
        }
        
        $menu = Menu::find()->select("id,money,name,restaurant_id")->where('id in('.implode($menu_id,  ',').')')->asArray()->all();
        $total_money = array_sum(array_column($menu, 'money'));

        if($total_money > 3000){
            echo '超额：'.$total_money;   
            \Yii::$app->end();
        }

        $issus = IssusMember::find()->select('issus_id')->where(['user_id'=>\Yii::$app->user->getId()])->one();

        $order = new Order();

        $order->user_id = \Yii::$app->user->getId();
        $order->cpy_id = $issus['issus_id'];

        $time = time();
        $tranc = \Yii::$app->db->beginTransaction();
        $menu_name = [];
        try{
            foreach ($menu as $v)
            {
                $order->setIsNewRecord(true);
                $order->memu_id = $v['id'];
                $order->restaurant_id = $v['restaurant_id'];
                $order->create_at = $time;
                $order->updated_at = $time;
                $order->money = $v['money'];
                $order->status = 0;
                $order->save();
                $menu_name[] =$v['name'];
            }
            $tranc->commit();
            echo '预定'.implode($menu_name, ',').'成功，共计'.round($total_money/100,2).'元';
        }catch (\Exception $e){
            $tranc->rollBack()  ;
            echo 'sever_error';
            \Yii::error(VarDumper::dumpAsString($order->getErrors()),$e->getMessage(),'ORDER_FOODS');
        }
    }
}
