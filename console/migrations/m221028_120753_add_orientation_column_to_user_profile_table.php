<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user_profile}}`.
 */
class m221028_120753_add_orientation_column_to_user_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_profile', 'orientation', $this->integer(2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_profile', 'orientation');
    }
}
