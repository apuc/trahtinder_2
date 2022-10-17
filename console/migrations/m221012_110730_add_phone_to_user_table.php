<?php

use yii\db\Migration;

/**
 * Class m221012_110730_add_phone_to_user_table
 */
class m221012_110730_add_phone_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'phone', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221012_110730_add_phone_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
