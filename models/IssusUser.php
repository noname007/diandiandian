<?php
namespace  app\models;

use dektrium\user\models\User as BaseUser;
use yii\base\Event;
use yii\helpers\VarDumper;

class IssusUser extends BaseUser
{
    function  init()
    {
        parent::init();
        $this->on(self::AFTER_CREATE,[$this,'callbackAfterCreate']);
    }

    function callbackAfterCreate(Event $e)
    {
        $master_id = \Yii::$app->user->getId(  );
        $member_id = $this->getId();
        
        $issu = Issus::find()->select('id')->where(['user_id'=>$master_id])->asArray()->one();
        
        if(empty($issu))
        {
            echo '没有找到组织';
            exit;
        }
        
        $record = new IssusMember();
        $record->user_id = $master_id;
        $record->issus_id = $issu['id'];
        
        if(!$record->save()){
            echo '服务器错误';
        }
        
//   \Yii::error(\Yii::$app->user->getId(  ).' '.$this->getId());
    }
    
   
     
}