<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string|null $profile
 *
 * @property Post[] $posts
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'salt', 'email'], 'required'],
            [['username', 'password', 'salt', 'email', 'profile'], 'string', 'max' => 255],
            [['password'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Name',
            'password' => 'Password',
            'salt' => 'Salt',
            'email' => 'Email',
            'profile' => 'Profile',
        ];
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    public function validateUsername($username)
    {
        $username = strtolower($username);
        $sql = 'SELECT * FROM tbl_user WHERE LOWER(username)=:username';
        $user = User::findBySql($sql, [':username' => $username])->one();
        return $user == true;
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function authenticate($username, $password)
    {
        if ($this->validateUsername($username) && $this->validatePassword($password)) {
            return true;
        } else {
            return false;
        }
    }

    public static function findByUsername($username) {
        return User::findOne(['username' => $username]);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {
    }
}
