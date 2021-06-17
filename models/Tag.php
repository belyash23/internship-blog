<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property int $id
 * @property string $name
 * @property int $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'frequency'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'frequency' => 'Frequency',
        ];
    }

    public static function stringToArray($tags)
    {
        return preg_split('/\s*,\s*/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function arrayToString($tags)
    {
        return implode(', ', $tags);
    }

    public static function updateFrequency($oldTags, $newTags)
    {
        $oldTags = self::stringToArray($oldTags);
        $newTags = self::stringToArray($newTags);
        self::addTags(array_values(array_diff($newTags, $oldTags)));
        self::removeTags(array_values(array_diff($oldTags, $newTags)));
    }

    public static function addTags($tags)
    {
        $data = self::find()->where(['name' => $tags])->all();
        foreach ($data as $tag) {
            $tag->updateCounters(['frequency' => 1]);
        }
        foreach ($tags as $name) {
            $data = Tag::find()->where(['name' => $name]);
            if (!$data->exists()) {
                $tag = new Tag;
                $tag->name = $name;
                $tag->frequency = 1;
                $tag->save();
            }
        }
    }

    public static function removeTags($tags)
    {
        if (empty($tags)) {
            return;
        }
        $data = self::find()->where(['name' => $tags])->all();
        foreach ($data as $tag) {
            $tag->updateCounters(['frequency' => -1]);
        }
        self::deleteAll('frequency <= 0');
    }

    public static function findTagWeights($limit = 20)
    {
        $models = self::find()->orderBy(['frequency' => SORT_DESC])->limit($limit)->all();

        $total = 0;
        foreach ($models as $model) {
            $total += $model->frequency;
        }

        $tags = array();
        if ($total > 0) {
            foreach ($models as $model) {
                $tags[$model->name] = 8 + (int)(16 * $model->frequency / ($total + 10));
            }
            ksort($tags);
        }
        return $tags;
    }
}
