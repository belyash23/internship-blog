<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_user}}`.
 */
class m210612_061510_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'password' => $this->string()->notNull()->unique(),
            'salt' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'profile' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
