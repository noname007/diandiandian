<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160229_094501_add_company_member_table extends Migration
{
    public function up()
    {
		$this->createTable('{{%cpy_member_relateions}}', [
				'mem_id'=>Schema::TYPE_PK,
				'cpy_id'=>Schema::TYPE_INTEGER,
		]);
		$this->createIndex('index_cpy_id', '{{%cpy_member_relateions}}', 'cpy_id');
    }

    public function down()
    {
        echo "m160229_094501_add_company_member_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
