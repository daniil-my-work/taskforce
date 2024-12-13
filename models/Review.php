<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property string|null $date_comment
 * @property string|null $review_description
 * @property int|null $review_mark
 * @property int|null $reviewer
 *
 * @property Profile[] $profiles
 * @property Profile[] $profiles0
 * @property Users $reviewer0
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_comment'], 'safe'],
            [['review_description'], 'string'],
            [['review_mark', 'reviewer'], 'integer'],
            [['reviewer'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['reviewer' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_comment' => 'Date Comment',
            'review_description' => 'Review Description',
            'review_mark' => 'Review Mark',
            'reviewer' => 'Reviewer',
        ];
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['mark_id' => 'id']);
    }

    /**
     * Gets query for [[Profiles0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles0()
    {
        return $this->hasMany(Profile::class, ['review_id' => 'id']);
    }

    /**
     * Gets query for [[Reviewer0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewer0()
    {
        return $this->hasOne(User::class, ['id' => 'reviewer']);
    }
}
