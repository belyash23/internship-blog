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
    private static $items = [];

    public static function items($type)
    {
        if (!isset(self::$items[$type])) {
            self::loadItems($type);
        }
        return self::$items[$type];
    }

    public static function item($type, $code)
    {
        if (!isset(self::$items[$type])) {
            self::loadItems($type);
        }
        return self::$items[$type][$code] ?? false;
    }

    private static function loadItems($type)
    {
        self::$items[$type] = array();
        $models = self::findAll(
            array(
                'condition' => 'type=:type',
                'params' => array(':type' => $type),
                'order' => 'position',
            )
        );
        foreach ($models as $model) {
            self::$items[$type][$model->code] = $model->name;
        }
    }

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
