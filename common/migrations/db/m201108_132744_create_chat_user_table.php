<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat_user}}`.
 */
class m201108_132744_create_chat_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chat_user', [
            'id'         => $this->primaryKey(),
            'chat_id'    => $this->integer()->notNull(),
            'user_id'    => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-chat_user-chat_id',
            'chat_user',
            'chat_id'
        );

        $this->addForeignKey(
            'fk-chat_user-chat_id',
            'chat_user',
            'chat_id',
            'chat',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-chat_user-user_id',
            'chat_user',
            'user_id'
        );

        $this->addForeignKey(
            'fk-chat_user-user_id',
            'chat_user',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chat_user');
    }
}
