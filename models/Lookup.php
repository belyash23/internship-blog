<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%lookup}}".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $code
 * @property string|null $type
 * @property int|null $position
 */
class Lookup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lookup}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'position'], 'integer'],
            [['name', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'type' => 'Type',
            'position' => 'Position',
        ];
    }
}
