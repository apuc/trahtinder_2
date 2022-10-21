<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user_profile}}`.
 */
class m221021_135914_add_min_age_and_max_age_columns_to_user_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_profile', 'min_age', $this->integer(2));
        $this->addColumn('user_profile', 'max_age', $this->integer(2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_profile', 'min_age');
        $this->dropColumn('user_profile', 'max_age');
    }
}
