<?php

use yii\db\Migration;

class m160301_080508_issus_ai extends Migration
{
    public function up()
    {
		$this->alterColumn('{{%issus}}', 'id', 'INT(11) NOT NULL AUTO_INCREMENT');
    }

    public function down()
    {
        echo "m160301_080508_issus_ai cannot be reverted.\n";

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
