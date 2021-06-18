<?php

use yii\db\Migration;

/**
 * Class m210618_075420_add_lookup_data
 */
class m210618_075420_add_lookup_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert(
            '{{%lookup}}',
            ['name', 'code', 'type'],
            [
                ['Черновик', 1, 'PostStatus'],
                ['Опубликован', 2, 'PostStatus'],
                ['Истёк срок действия', 3, 'PostStatus'],
            ]
        )->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('{{%lookup}}')->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210618_075420_add_lookup_data cannot be reverted.\n";

        return false;
    }
    */
}
