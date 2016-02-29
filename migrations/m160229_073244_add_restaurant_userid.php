<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160229_073244_add_restaurant_userid extends Migration
{
//     public function up()
//     {

//     }

//     public function down()
//     {
//         echo "m160229_073244_add_restaurant_userid cannot be reverted.\n";

//         return false;
//     }

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    	$this->addColumn('{{%restaurant}}', 'user_id',Schema::TYPE_INTEGER.' not null');
    	$this->createIndex('index_rst_user', '{{%restaurant}}', 'user_id');
    }

    public function safeDown()
    {
    }
}
