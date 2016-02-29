<?php

namespace app\controllers;

use app\modules\CompanyS\models\Fillrestaurantinfo;
use app\modules\CompanyA\models\Company;
use app\modules\CompanyS\models\Restaurant;
use yii\helpers\VarDumper;

class FillinfoController extends \yii\web\Controller
{
	public  function  beforeAction($action)
	{
	    if (!parent::beforeAction($action)) {
    		return false;
    	}
		$user_id = \Yii::$app->user->getId();
		$cond = ['user_id'=>$user_id];
		if(Restaurant::find()->where($cond)->exists()||Company::find()->where($cond)->exists()){
			$this->redirect(['site/index']);
			return false;
		}
		return true;
	}
	
    public function actionIndex()
    {
        return $this->render('index',['model'=>new Fillrestaurantinfo()]);
    }
    
    public function actionCreate() 
    {
    	
    	$model_form = new Fillrestaurantinfo();
    	if(!$model_form->load(\Yii::$app->request->post()) || !$model_form->validate())
    	{
    		\Yii::error(VarDumper::dumpAsString($model_form->getErrors()),'FILLINFO');
    		return $this->render('index',['model'=>$model_form]);
    	}
    	
    	$type = \Yii::$app->request->post('type',null);

    	if ($model_form->type == 0){
    		$model = new Restaurant();
    	}else if($model_form->type == 1){
    		$model = new Company();
    	}else{
    		return $this->render('index',['model'=>$model_form]);
    	}
    	
    	
    	$model->name =$model_form->name;
    	$model->address =$model_form->address;
    	$user = \Yii::$app->user;
    	$model->user_id =  $user->getId();
    	$time = time();
    	
    	$model->create_at = $time;
    	$model->updated_at = $time;
    	$model->status = \app\models\Company::NORMAL;
    	if ( $model->save()) 
    	{
    		return $this->render('view',['model'=>$model]);
    	} 
    	\Yii::error(VarDumper::dumpAsString($model->getErrors()),'FILLINFO');
   		return $this->render('index',['model'=>$model_form]);
    }

    
}
