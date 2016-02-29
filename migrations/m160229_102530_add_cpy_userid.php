<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160229_102530_add_cpy_userid extends Migration
{
   
    public function safeUp()
    {
    	$this->addColumn('{{%company}}', 'user_id',Schema::TYPE_INTEGER.' not null');
    	$this->createIndex('index_cpy_user', '{{%company}}', 'user_id');
    }
   

   
}
