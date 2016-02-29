<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160229_045655_supplys_migrates extends Migration
{
//     public function up()
//     {

//     }

//     public function down()
//     {
//         echo "m160229_045655_supplys_migrates cannot be reverted.\n";

//         return false;
//     }

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    	$this->createTable('{{%restaurant}}', [
    			'id'=>Schema::TYPE_PK,
    			'name'=>Schema::TYPE_STRING . '(255) not null',
    			'desc'=>Schema::TYPE_TEXT,
    			'create_at'=>  Schema::TYPE_INTEGER . ' NOT NULL',
    			'updated_at'=> Schema::TYPE_INTEGER . ' NOT NULL',
    			'address'=>Schema::TYPE_TEXT . '(255) not null',
    			'status'=>Schema::TYPE_INTEGER . ' NOT NULL default 0',
    	]);
    	
    	$this->createIndex('rst_name', '{{%restaurant}}', 'name',true);
    	
    	$this->createTable('{{%restaurant_menu}}', [
    			'id'=>Schema::TYPE_PK,
    			'name'=>Schema::TYPE_STRING . '(255) not null',
    			'create_at'=>Schema::TYPE_INTEGER . ' NOT NULL',
    			'updated_at'=> Schema::TYPE_INTEGER . ' NOT NULL',
    			'restaurant_id'=>Schema::TYPE_INTEGER.' not null',
    			'money' => Schema::TYPE_INTEGER. ' not null',//分为单位
    			'desc'=>Schema::TYPE_TEXT,
    			'status'=>Schema::TYPE_INTEGER . ' NOT NULL default 0',
    	]);
    	
    	$this->createIndex('rst_menu_name', '{{%restaurant_menu}}', 'name');
    	$this->createIndex('rst_menu_rest', '{{%restaurant_menu}}', 'restaurant_id');
    	
    	$this->createTable('{{%company}}', [
    			'id'   => Schema::TYPE_PK,
    			'name' => Schema::TYPE_STRING . '(255) not null',
    			'create_at'=>  Schema::TYPE_INTEGER . ' NOT NULL',
    			'updated_at'=> Schema::TYPE_INTEGER . ' NOT NULL',
    			'desc'=>Schema::TYPE_TEXT,
    			'address'=>Schema::TYPE_TEXT . '(255) not null',
    			'status'=>Schema::TYPE_INTEGER . ' NOT NULL default 0',
    	]);
    	
    	$this->createIndex('cpy_name', '{{%company}}', 'name');
    	
    	$this->createTable('{{%order}}',[
    			'id'   	  => Schema::TYPE_PK,
    			'cpy_id'  =>Schema::TYPE_INTEGER. ' NOT NULL',
    			'memu_id' =>Schema::TYPE_INTEGER. ' NOT NULL',
    			'restaurant_id' => Schema::TYPE_INTEGER. ' NOT NULL',
    			'create_at' =>  Schema::TYPE_INTEGER . ' NOT NULL',
    			'money' => Schema::TYPE_INTEGER. ' not null',//分为单位
    			'updated_at'=> Schema::TYPE_INTEGER . ' NOT NULL',
    			'status'=>Schema::TYPE_INTEGER . ' NOT NULL default 0',
    			'desc'=>Schema::TYPE_TEXT,
    			
    	]);
    	
    	$this->createIndex('order_cpy', '{{%order}}', 'cpy_id');
    	$this->createIndex('order_menu', '{{%order}}', 'memu_id');
    	$this->createIndex('order_restaurant', '{{%order}}', 'restaurant_id');
    	
    	
    	
    	
//     	$this->createTable($table, $columns)
//     	$this->addForeignKey('fk_restaurant_id', $table, $columns, $refTable, $refColumns)
    }

    public function safeDown()
    {
    }
}
