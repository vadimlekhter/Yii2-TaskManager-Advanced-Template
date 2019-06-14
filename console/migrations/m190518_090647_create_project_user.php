<?php

use yii\db\Migration;

/**
 * Class m190518_090647_create_project_user
 */
class m190518_090647_create_project_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project_user', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'role' => "ENUM('manager', 'developer', 'tester')"
        ]);

        $this->addForeignKey('fx_project_user_user', 'project_user', ['user_id'], 'user', ['id']);
        $this->addForeignKey('fx_project_user_project', 'project_user', ['project_id'], 'project', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fx_project_user_user', 'project_user');
        $this->dropForeignKey('fx_project_user_project', 'project_user');

        $this->dropTable('project_user');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190518_090647_create_project_user cannot be reverted.\n";

        return false;
    }
    */
}
