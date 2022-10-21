<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user_profile}}`.
 */
class m221021_115843_add_datetime_and_birthday_columns_to_user_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_profile', 'birthday', $this->dateTime());
        $this->addColumn('user_profile', 'created_at', $this->dateTime());
        $this->addColumn('user_profile', 'updated_at', $this->dateTime()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_profile', 'birthday');
        $this->dropColumn('user_profile', 'created_at');
        $this->dropColumn('user_profile', 'updated_at');
    }
}
