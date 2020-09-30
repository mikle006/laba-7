<?php

use yii\db\Migration;

class m191213_150557_create_table_answers extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%answers}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'question_id' => $this->integer()->notNull(),
            'isCorrect' => $this->tinyInteger(1)->notNull()->defaultValue('0'),
        ], $tableOptions);

        $this->createIndex('question_id', '{{%answers}}', 'question_id');
        $this->addForeignKey('answers_ibfk_1', '{{%answers}}', 'question_id', '{{%questions}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%answers}}');
    }
}
