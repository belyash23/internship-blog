<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_lookup}}`.
 */
class m210612_061627_create_lookup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lookup}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'code' => $this->integer(),
            'type' => $this->string(),
            'position' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lookup}}');
    }
}
