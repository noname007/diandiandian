<?php
namespace  app\controllers;

use yii\web\Controller as WebController;
use app\models\FillIssusInfo;
use yii\helpers\VarDumper;

class IssusController extends WebController
{
	public $defaultAction = 'create'; 
// 	public  function  beforeAction($action)
// 	{
// 		if (!parent::beforeAction($action)) {
// 			return false;
// 		}

// 		return true;
// 	}
	
	public function actionIndex()
	{
		return 'hello world';
// 		return $this->render('index',['model'=>new Fillrestaurantinfo()]);
	}
	
	
	public function actions()
	{
		return [
				'captcha' => [
						'class' => 'yii\captcha\CaptchaAction',
						'minLength' => 4,
						'maxLength' => 4,
				],
		];
	}
	
	public function actionCreate()
	{
		$model_form = new FillIssusInfo();
		if(!$model_form->load(\Yii::$app->request->post()) || !$model_form->validate())
		{
			\Yii::error(VarDumper::dumpAsString($model_form->getErrors()),'FILLINFO');
			return $this->render('form',['model'=>$model_form]);
		}
		

		if ($model_form->type != 0 && $model_form->type != 1)
		{
		
			return $this->render('form',['model'=>$model_form]);
		}
		 
		 
		$user = \Yii::$app->user;
		$model_form->user_id =  $user->getId();
		
		$time = time(); 
		$model_form->create_at = $time;
		$model_form->updated_at = $time;
		
		$model_form->status = FillIssusInfo::NORMAL;
		
		if ( $model_form->save())
		{
			return $this->render('view',['model'=>$model_form]);
		}
		\Yii::error(VarDumper::dumpAsString($model_form->getErrors()),'FILLINFO');
		return $this->render('form',['model'=>$model_form]);
	}
	
	
	function  actionDisplay()
	{
		return 'display meme/memu';
	}
	
}