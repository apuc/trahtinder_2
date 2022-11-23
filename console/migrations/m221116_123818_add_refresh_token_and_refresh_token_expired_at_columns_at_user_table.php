<?php

use yii\db\Migration;

/**
 * Class m221116_123818_add_refresh_token_and_refresh_token_expired_at_columns_at_user_table
 */
class m221116_123818_add_refresh_token_and_refresh_token_expired_at_columns_at_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'refresh_token', $this->string()->defaultValue(null));
        $this->addColumn('user', 'refresh_token_expired_at', $this->dateTime()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'refresh_token');
        $this->dropColumn('user', 'refresh_token_expired_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221116_123818_add_refresh_token_and_refresh_token_expired_at_columns_at_user_table cannot be reverted.\n";

        return false;
    }
    */
}
