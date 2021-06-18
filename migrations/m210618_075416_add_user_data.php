<?php

use yii\db\Migration;

/**
 * Class m210618_075416_add_user_data
 */
class m210618_075416_add_user_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert(
            '{{%user}}',
            ['username', 'password', 'salt', 'email'],
            [
                ['demo', '$2y$13$bXb5GN4Hs.j9UOWPO79kSObNL4xaFotqB.RmhT/qF9pc/E4l8p6KW', '123', '123@123.12'],
                ['admin', '$2y$13$wTPj4pNVS9lUcc/S.fFLQunN/sanPMPtDR/1GsPeA.SSPfYVzKu3q', '123', '12@123.12'],
            ]
        )->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete(
            '{{%user}}',
            ['in', 'username', ['admin', 'demo']]
        )->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210618_075416_add_user_data cannot be reverted.\n";

        return false;
    }
    */
}
