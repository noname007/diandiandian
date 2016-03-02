<?php

namespace app\controllers;

use app\models\IssusSearch;
use app\models\Issus;
use app\models\CpyRest;
use yii\helpers\VarDumper;
use Yii;

class CpyController extends \yii\web\Controller
{
    
    public $defaultAction = 'view';
    
    function actionFind_rest($incondtion='not')
    {
        $search = new IssusSearch();
        $dataProvider = $search->search(\Yii::$app->request->queryParams);
        
        
        $cpy = Issus::find()->select('id')->where(['type'=>Issus::TYPE_CPY,'user_id'=>\Yii::$app->user->getId()])->asArray()->one();
        $cpys = CpyRest::find()->select('rest_id')->where(['cpy_id'=>$cpy['id']])->asArray()->all();
        
        $cond_in = implode(array_column($cpys, 'rest_id'), ',');
        
        $dataProvider->query->andWhere(['type'=>Issus::TYPE_RESTRANT,'status'=>Issus::NORMAL])->andWhere("id $incondtion in($cond_in)");
       
        return  $this->render('display',[
            'searchModel' => $search,
            'dataProvider' => $dataProvider,
            'isFindRest' =>$incondtion?true:false,
        ]);
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
        return $this->actionFind_rest('');
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
}
