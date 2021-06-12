<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property int $id
 * @property string|null $author
 * @property string|null $content
 * @property int|null $status
 * @property string $email
 * @property string|null $url
 * @property string $create_time
 * @property int $post_id
 *
 * @property Post $post
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'post_id'], 'integer'],
            [['email', 'create_time', 'post_id'], 'required'],
            [['create_time'], 'safe'],
            [['author', 'content', 'email', 'url'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Author',
            'content' => 'Content',
            'status' => 'Status',
            'email' => 'Email',
            'url' => 'Url',
            'create_time' => 'Create Time',
            'post_id' => 'Post ID',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
