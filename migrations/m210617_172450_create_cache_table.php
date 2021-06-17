<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cache}}`.
 */
class m210617_172450_create_cache_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cache}}', [
            'id' => $this->primaryKey(),
            'expire' => $this->integer(11),
            'data' => 'BLOB'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cache}}');
    }
}
