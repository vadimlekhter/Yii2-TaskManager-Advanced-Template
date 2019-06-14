<?php

use yii\db\Migration;

/**
 * Class m190518_090629_create_project
 */
class m190518_090629_create_project extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'active' => $this->boolean()->defaultValue(false)->notNull(),
            'creator_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey('fx_project_user_1', 'project', ['creator_id'], 'user', ['id']);
        $this->addForeignKey('fx_project_user_2', 'project', ['updater_id'], 'user', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fx_project_user_1', 'project');
        $this->dropForeignKey('fx_project_user_2', 'project');

        $this->dropTable('project');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190518_090629_create_project cannot be reverted.\n";

        return false;
    }
    */
}
