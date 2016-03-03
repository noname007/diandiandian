<?php

namespace app\controllers;

use app\models\IssusSearch;
use app\models\Issus;
use app\models\CpyRest;
use yii\helpers\VarDumper;
use Yii;
use yii\helpers\Html;

class CpyController extends \yii\web\Controller
{
    
    public $defaultAction = 'find_rest';
    
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
        $sql = 'select name,restaurant_id,money,id menu_id from  (select rest_id from cpy_rest cr,issus_member im where im.issus_id = cr.cpy_id and im.user_id = :user_id) t,menu m where m.restaurant_id = t.rest_id and status = 0';
        $res = \Yii::$app->db->createCommand($sql,[':user_id'=>\Yii::$app->user->getId()])->queryAll();
         
    
        //TODO 具体显示
        var_dump($res);
        // 	       select * from
    }
}
