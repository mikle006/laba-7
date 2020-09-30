<?php

use yii\db\Migration;

class m191213_150611_create_table_test extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%test}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'description' => $this->string(256)->notNull(),
        ], $tableOptions);

        $this->createIndex('name', '{{%test}}', 'name', true);
    }

    public function down()
    {
        $this->dropTable('{{%test}}');
    }
}
