<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160229_125041_db extends Migration
{

    public function safeUp()
    {
     	$this->createTable('{{%issus}}', [
    			'id'=>Schema::TYPE_INTEGER,
    			'name'=>Schema::TYPE_STRING . '(255) not null',
    			'desc'=>Schema::TYPE_TEXT,
    			'create_at'=>  Schema::TYPE_INTEGER . ' NOT NULL',
    			'updated_at'=> Schema::TYPE_INTEGER . ' NOT NULL',
    			'address'=>Schema::TYPE_TEXT . '(255) not null',
    			'status'=>Schema::TYPE_INTEGER . ' NOT NULL default 0',
     			'type'=>Schema::TYPE_INTEGER,
     			'user_id'=>Schema::TYPE_INTEGER,
     			'primary key (id,type,user_id)',
    	]);
    	
    	$this->createIndex('issus_name', '{{%issus}}', 'name',true);
    	
    	$this->createTable('{{%menu}}', [
    			'id'=>Schema::TYPE_PK,
    			'name'=>Schema::TYPE_STRING . '(255) not null',
    			'create_at'=>Schema::TYPE_INTEGER . ' NOT NULL',
    			'updated_at'=> Schema::TYPE_INTEGER . ' NOT NULL',
    			'restaurant_id'=>Schema::TYPE_INTEGER.' not null',
    			'user_id'=>Schema::TYPE_INTEGER,
    			'money' => Schema::TYPE_INTEGER. ' not null',//分为单位
    			'desc'=>Schema::TYPE_TEXT,
    			'status'=>Schema::TYPE_INTEGER . ' NOT NULL default 0',
    	]);
    	
    	$this->createIndex('menu_name', '{{%menu}}', 'name,restaurant_id,user_id');
  
    	$this->createTable('{{%order}}',[
    			'id'   	  => Schema::TYPE_PK,
    			'cpy_id'  =>Schema::TYPE_INTEGER. ' NOT NULL',
    			'user_id' =>Schema::TYPE_INTEGER. ' NOT NULL',
    			'memu_id' =>Schema::TYPE_INTEGER. ' NOT NULL',
    			'restaurant_id' => Schema::TYPE_INTEGER. ' NOT NULL',
    			'create_at' =>  Schema::TYPE_INTEGER . ' NOT NULL',
    			'money' => Schema::TYPE_INTEGER. ' not null',//分为单位
    			'updated_at'=> Schema::TYPE_INTEGER . ' NOT NULL',
    			'status'=>Schema::TYPE_INTEGER . ' NOT NULL default 0',
    			'desc'=>Schema::TYPE_TEXT,
    			
    	]);
    	
    	$this->createIndex('order_cpy', '{{%order}}', 'cpy_id,memu_id,restaurant_id,user_id');
    	
    	$this->createTable('{{%issus_member}}', [
    			'issus_id'=>Schema::TYPE_INTEGER,
    			'user_id'=>Schema::TYPE_INTEGER,
    			'primary key (issus_id,user_id)',
    	]);
    }

    public function safeDown()
    {
    }
  
}
