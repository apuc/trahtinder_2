<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%watched_profiles}}`.
 */
class m221024_092439_create_watched_profiles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%watched_profiles}}', [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'user_profile_id' => $this->integer()->notNull(),
            'candidate_profile_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'user_profile_watched_profiles',
            'watched_profiles',
            'user_profile_id',
            'user_profile',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'candidate_profile_watched_profiles',
            'watched_profiles',
            'candidate_profile_id',
            'user_profile',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_profile_watched_profiles', 'watched_profiles');
        $this->dropForeignKey('candidate_profile_watched_profiles', 'watched_profiles');
        $this->dropTable('{{%watched_profiles}}');
    }
}
