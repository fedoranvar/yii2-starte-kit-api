<?php

use yii\db\Migration;

/**
 * Class m201108_133934_create_demo_chat_user
 */
class m201108_133934_create_demo_chat_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('chat_user', [
            'chat_id'    => 1,
            'user_id'    => 1,
        ]);
        $this->insert('chat_user', [
            'chat_id'    => 1,
            'user_id'    => 2,
        ]);
        $this->insert('chat_user', [
            'chat_id'    => 1,
            'user_id'    => 3,
        ]);
        $this->insert('chat_user', [
            'chat_id'    => 2,
            'user_id'    => 1,
        ]);
        $this->insert('chat_user', [
            'chat_id'    => 2,
            'user_id'    => 3,
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201108_133934_create_demo_chat_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201108_133934_create_demo_chat_user cannot be reverted.\n";

        return false;
    }
    */
}
