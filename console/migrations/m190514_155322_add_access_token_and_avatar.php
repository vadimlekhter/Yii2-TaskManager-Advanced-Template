<?php

use yii\db\Migration;

/**
 * Class m190514_155322_add_access_token_and_avatar
 */
class m190514_155322_add_access_token_and_avatar extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'access_token', $this->string()->defaultValue(null));
        $this->addColumn('{{%user}}', 'avatar', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'access_token varchar');
        $this->dropColumn('{{%user}}', 'avatar varchar');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190514_155322_add_access_token_and_avatar cannot be reverted.\n";

        return false;
    }
    */
}
