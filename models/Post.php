<?php

namespace app\models;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $status
 * @property string|null $tags
 * @property string|null $create_time
 * @property string|null $update_time
 * @property int|null $user_id
 *
 * @property Comment[] $comments
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_ARCHIVED = 3;

    private $oldTags;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['*'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'roles' => ['*'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'status'], 'required'],
            ['title', 'string', 'max' => 128],
            ['status', 'in', 'range' => [1, 2, 3]],
            ['tags', 'match', 'pattern' => '/^[\w\s,]+$/', 'message' => 'В тегах можно использовать только буквы.'],
            ['tags', 'normalizeTags'],
            [['title', 'status'], 'safe', 'on' => 'search']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'status' => 'Status',
            'tags' => 'Tags',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }

    public function getCommentCount()
    {
        return $this->getComments()->where(['status' => Comment::STATUS_APPROVED])->count();
    }

    public function getTagLinks()
    {
        $links=array();
        foreach(Tag::stringToArray($this->tags) as $tag)
            $links[]=Html::a(Html::encode($tag), array('post/index', 'tag'=>$tag));
        return $links;
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function normalizeTags($attribute, $params)
    {
        $this->tags = Tag::arrayToString(array_unique(Tag::stringToArray($this->tags)));
    }

    public function getUrl()
    {
        return Url::to(['post/view', 'id' => $this->id, 'title' => $this->title]);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->create_time = $this->update_time = time();
                $this->user_id = Yii::$app->user->id;
            } else {
                $this->update_time = time();
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        Tag::updateFrequency($this->oldTags, $this->tags);
    }


    public function afterFind()
    {
        parent::afterFind();
        $this->oldTags = $this->tags;
    }
}
