<?php

use yii\db\Migration;

/**
 * Class m201107_175324_create_demo_chat_messages
 */
class m201107_175324_create_demo_chat_messages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('chat_message', [
            'chat_id'    => 1,
            'user_id'    => 1,
            'content'    => 'Privet Mir! Dva plus dva?',
            'created_at' => new \yii\db\Expression('NOW()'),
        ]);

        $this->insert('chat_message', [
            'chat_id'    => 1,
            'user_id'    => 1,
            'content'    => 'Privet Mir! C chego nachinaetsya Rodina?',
            'created_at' => new \yii\db\Expression('NOW()'),
        ]);

        $this->insert('chat_message', [
            'chat_id'    => 2,
            'user_id'    => 1,
            'content'    => 'Privet Mir! Have you heard about the bird?',
            'created_at' => new \yii\db\Expression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201107_175324_create_demo_chat_messages cannot be reverted.\n";

        return false;
    }
    */
}
