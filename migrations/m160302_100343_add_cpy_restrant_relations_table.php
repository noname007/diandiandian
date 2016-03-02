<?php

use yii\db\Migration;
use yii\db\Schema;

class m160302_100343_add_cpy_restrant_relations_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%cpy_rest}}', [
            'cpy_id'=>Schema::TYPE_INTEGER,
            'rest_id'=>Schema::TYPE_INTEGER,
            'primary key(cpy_id,rest_id)',
        ]);

    }

    public function down()
    {
        echo "m160302_100343_add_cpy_restrant_relations_table cannot be reverted.\n";

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
