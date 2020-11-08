<?php

use yii\db\Migration;

/**
 * Class m201107_175308_create_demo_chat
 */
class m201107_175308_create_demo_chat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('chat', [
            'title'      => 'Public Chat #1',
            'created_at' => new \yii\db\Expression('NOW()'),
        ]);

        $this->insert('chat', [
            'title'      => 'Public Chat #2',
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
        echo "m201107_175308_create_demo_chat cannot be reverted.\n";

        return false;
    }
    */
}
