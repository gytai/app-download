<?php

use yii\db\Migration;

/**
 * Class m190508_084402_create_users
 */
class m190508_084402_create_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'account' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'created_at' => $this->dateTime()
        ]);

        $this->insert('users', [
            'account' => 'admin',
            'password' => md5('123456'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190508_084402_create_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190508_084402_create_users cannot be reverted.\n";

        return false;
    }
    */
}
