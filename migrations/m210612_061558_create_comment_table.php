<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_comment}}`.
 */
class m210612_061558_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'author' => $this->string(),
            'content' => $this->string(),
            'status' => $this->integer(),
            'email' => $this->string()->notNull(),
            'url' => $this->string()->defaultValue(null),
            'create_time' => $this->date()->notNull(),
            'post_id' => $this->integer()->notNull(),
            'FOREIGN KEY(post_id) REFERENCES {{%post}}(id)'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }
}
