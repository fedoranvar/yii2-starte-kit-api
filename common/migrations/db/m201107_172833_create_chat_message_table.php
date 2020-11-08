<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat_message}}`.
 */
class m201107_172833_create_chat_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chat_message', [
            'id'         => $this->primaryKey(),
            'chat_id'    => $this->integer()->notNull(),
            'user_id'    => $this->integer()->notNull(),
            'content'    => $this->text()->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'deleted_at' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-chat_message-chat_id',
            'chat_message',
            'chat_id'
        );

        $this->addForeignKey(
            'fk-chat_message-chat_id',
            'chat_message',
            'chat_id',
            'chat',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-chat_message-user_id',
            'chat_message',
            'user_id'
        );

        $this->addForeignKey(
            'fk-chat_message-user_id',
            'chat_message',
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
        $this->dropTable('chat_message');
    }
}
