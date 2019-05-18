<?php

use yii\db\Migration;

/**
 * Class m190518_090431_create_task
 */
class m190518_090431_create_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'project_id' => $this->integer(),
            'executor_id' => $this->integer(),
            'started_at' => $this->integer(),
            'completed_at' => $this->integer(),
            'creator_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey('fx_task_user_1', 'task', ['executor_id'], 'user', ['id']);
        $this->addForeignKey('fx_task_user_2', 'task', ['creator_id'], 'user', ['id']);
        $this->addForeignKey('fx_task_user_3', 'task', ['updater_id'], 'user', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fx_task_user_1', 'task');
        $this->dropForeignKey('fx_task_user_2', 'task');
        $this->dropForeignKey('fx_task_user_3', 'task');

        $this->dropTable('task');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190518_090431_create_task cannot be reverted.\n";

        return false;
    }
    */
}
