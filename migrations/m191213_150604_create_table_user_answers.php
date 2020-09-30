<?php

use yii\db\Migration;

class m191213_150604_create_table_user_answers extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_answers}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'test_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'answer_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('test_id', '{{%user_answers}}', 'test_id');
        $this->createIndex('answer_id', '{{%user_answers}}', 'answer_id');
        $this->createIndex('question_id', '{{%user_answers}}', 'question_id');
        $this->createIndex('user_id', '{{%user_answers}}', 'user_id');
        $this->addForeignKey('user_answers_ibfk_1', '{{%user_answers}}', 'question_id', '{{%questions}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_answers_ibfk_2', '{{%user_answers}}', 'test_id', '{{%test}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_answers_ibfk_3', '{{%user_answers}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_answers_ibfk_4', '{{%user_answers}}', 'answer_id', '{{%answers}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%user_answers}}');
    }
}
