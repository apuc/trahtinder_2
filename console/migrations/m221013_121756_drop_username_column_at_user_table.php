<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%username_column_at_user}}`.
 */
class m221013_121756_drop_username_column_at_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('user', 'username', $this->string()->null()->unique());
    }
}
