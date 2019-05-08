<?php

use yii\db\Migration;

/**
 * Class m190508_084053_create_apps
 */
class m190508_084053_create_apps extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apps', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'link' => $this->string()->notNull(),
            'version' => $this->string()->notNull()->defaultValue('v1.0.0'),
            'created_at' => $this->dateTime()->defaultValue(date('Y-m-d'))
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190508_084053_create_apps cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190508_084053_create_apps cannot be reverted.\n";

        return false;
    }
    */
}
