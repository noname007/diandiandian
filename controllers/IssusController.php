<?php
namespace  app\controllers;

use yii\web\Controller as WebController;
use app\models\FillIssusInfo;
use yii\helpers\VarDumper;
use app\models\IssusMember;

class IssusController extends WebController
{
	public $defaultAction = 'create'; 
	
	public function actionIndex()
	{
		return 'hello world';
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
		
		if (!$model_form->save())
		{
		    \Yii::error(VarDumper::dumpAsString($model_form->getErrors()),'FILLINFO');
		    return $this->render('form',['model'=>$model_form]);
		}
		
		$record = new IssusMember();
		$record->user_id = $model_form->user_id;
		$record->issus_id = $model_form->id;
		
		if(!$record->save())
		{
		    \Yii::error(VarDumper::dumpAsString($record->getErrors()),'FILLINFO');
		    return $this->render('form',['model'=>$model_form]);
		}
		
		return $this->render('view',['model'=>$model_form]);
		
	}
	
	
	function  actionDisplay()
	{
		return 'display meme/memu';
	}
	
}