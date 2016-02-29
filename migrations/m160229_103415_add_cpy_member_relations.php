<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160229_103415_add_cpy_member_relations extends Migration
{
   
	public function safeUp()
	{
		$this->addColumn('{{%cpy_member_relateions}}', 'type',Schema::TYPE_INTEGER.' not null');
		$this->createIndex('index_type', '{{%cpy_member_relateions}}', 'type');
	}
	 
}
