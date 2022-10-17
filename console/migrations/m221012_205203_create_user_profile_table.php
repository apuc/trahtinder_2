<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_profile}}`.
 */
class m221012_205203_create_user_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_profile}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64),
            'gender' => $this->integer(2),
            'looking_for' => $this->integer(2),
            'photo' => $this->string()->defaultValue(null),

            'user_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'user_profile_user',
            'user_profile',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'user_profile_city',
            'user_profile',
            'city_id',
            'city',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_profile_user', 'user_profile');
        $this->dropForeignKey('user_profile_city', 'user_profile');
        $this->dropTable('{{%user_profile}}');
    }
}
