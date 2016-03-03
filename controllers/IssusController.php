<?php
namespace  app\controllers;

use yii\web\Controller as WebController;
use app\models\FillIssusInfo;
use yii\helpers\VarDumper;
use app\models\IssusMember;
use yii\db\Query;
use app\models\IssusUser;

class IssusController extends WebController
{
	public $defaultAction = 'member'; 
	
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
	
	
	
	function actionMember()
	{
	    $user_id = \Yii::$app->user->getId();
	    
	    $tableName = IssusMember::tableName();
	    $subsql1 = 'select issus_id from '. $tableName.' where user_id=:user_id';
	    
	    $subsql2 = "select t1.user_id  from  $tableName t1, ($subsql1) as t2 where t1.issus_id = t2.issus_id";
	    
	    $sql = "select username from ($subsql2) t3 , user t4 where t4.id = t3.user_id and t4.flags = 0";
	    
	    $bindValues =[
	        ':user_id'=>$user_id
	    ];
	    $res = \Yii::$app->db->createCommand($sql,$bindValues)->queryAll();
	   
	    
	    //TODO 具体显示
	    var_dump($res);
	}
	
	
}