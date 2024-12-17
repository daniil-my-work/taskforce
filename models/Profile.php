<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string|null $img
 * @property string|null $birth_date
 * @property string|null $user_description
 * @property string|null $telephone
 * @property string|null $telegram
 * @property int|null $mark_id
 * @property int|null $user_id
 * @property int|null $review_id
 *
 * @property Reviews $mark
 * @property Reviews $review
 * @property Users $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birth_date'], 'safe'],
            [['img'], 'string', 'max' => 255],
            [['birth_date'], 'date', 'format' => 'php:Y-m-d'],
            [['user_description', 'telephone', 'telegram'], 'string', 'max' => 128],
            [['mark_id', 'user_id', 'review_id'], 'integer'],
            [['mark_id'], 'exist', 'skipOnError' => true, 'targetClass' => Review::class, 'targetAttribute' => ['mark_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['review_id'], 'exist', 'skipOnError' => true, 'targetClass' => Review::class, 'targetAttribute' => ['review_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Img',
            'birth_date' => 'Birth Date',
            'user_description' => 'User Description',
            'telephone' => 'Telephone',
            'telegram' => 'Telegram',
            'mark_id' => 'Mark ID',
            'user_id' => 'User ID',
            'review_id' => 'Review ID',
        ];
    }

    /**
     * Gets query for [[Mark]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMark()
    {
        return $this->hasOne(Review::class, ['id' => 'mark_id']);
    }

    /**
     * Gets query for [[Review]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReview()
    {
        return $this->hasOne(Review::class, ['id' => 'review_id']);
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
}
