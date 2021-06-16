<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

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
    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;

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
            [['content', 'author', 'email'], 'required'],
            [['author', 'email', 'url'], 'string', 'max' => 128],
            ['email', 'email'],
            ['url', 'url']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Name',
            'content' => 'Comment',
            'status' => 'Status',
            'email' => 'Email',
            'url' => 'Website',
            'create_time' => 'Create Time',
            'post_id' => 'Post',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->create_time = time();
            }
            return true;
        }
        return false;
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

    public function getUrl($post = null)
    {
        if ($post === null) {
            $post = $this->post;
        }
        return $post->url . '#c' . $this->id;
    }

    public function getAuthorLink()
    {
        if (!empty($this->url)) {
            return Html::a(Html::encode($this->author), $this->url);
        } else {
            return Html::encode($this->author);
        }
    }

    public static function getPendingCommentCount()
    {
        return self::find()->where(['status' => self::STATUS_PENDING])->count();
    }
}
