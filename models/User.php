<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $date_registration
 * @property string|null $user_name
 * @property string $email
 * @property string|null $user_password
 * @property string|null $city
 * @property string|null $user_role
 * @property int|null $is_available
 *
 * @property Profile[] $profiles
 * @property Response[] $responses
 * @property Reviews[] $reviews
 * @property Tasks[] $tasks
 * @property Tasks[] $tasks0
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password_repeat_user;
    public $is_active;

    // Добавьте свойство auth_key
    public $auth_key;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'email', 'city', 'user_password', 'password_repeat_user'], 'safe'],
            [['user_name', 'email', 'user_password', 'password_repeat_user'], 'required'],
            [['date_registration'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['user_name', 'email', 'city', 'user_role'], 'string', 'max' => 128],
            [['email'], 'unique'],
            [['email'], 'required'],
            // [['user_password'], 'string', 'max' => 12],
            // ['password_repeat_user', 'compare', 'compareAttribute' => 'user_password', 'message' => 'Пароли не совпадают'],
            [['is_available'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_registration' => 'Date Registration',
            'user_name' => 'User Name',
            'email' => 'Email',
            'user_password' => 'User Password',
            'city' => 'City',
            'user_role' => 'User Role',
            'is_available' => 'Is Available',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::class, ['performer' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::class, ['reviewer' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerformedTasks()
    {
        return $this->hasMany(Task::class, ['performer_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientTasks()
    {
        return $this->hasMany(Task::class, ['client_id' => 'id']);
    }
}
