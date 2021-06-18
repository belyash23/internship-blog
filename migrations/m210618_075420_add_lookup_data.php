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

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210618_075420_add_lookup_data cannot be reverted.\n";

        return false;
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
