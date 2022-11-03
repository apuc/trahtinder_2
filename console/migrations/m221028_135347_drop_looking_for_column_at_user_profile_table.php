<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%looking_for_column_at_user_profile}}`.
 */
class m221028_135347_drop_looking_for_column_at_user_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user_profile', 'looking_for');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('user_profile','looking_for', $this->integer(2));
    }
}
