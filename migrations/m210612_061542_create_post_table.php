<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_post}}`.
 */
class m210612_061542_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->string()->notNull(),
            'status' => $this->integer(1)->notNull(),
            'tags' => $this->string(),
            'create_time' => $this->date(),
            'update_time' => $this->date(),
            'user_id' => $this->integer()->notNull(),
            'FOREIGN KEY(user_id) REFERENCES {{%user}}(id)'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
