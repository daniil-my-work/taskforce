<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "response".
 *
 * @property int $id
 * @property string|null $date_response
 * @property string|null $response_description
 * @property int|null $price
 * @property int|null $performer
 * @property int|null $response_mark
 *
 * @property Users $performer0
 */
class Response extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'response';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_response'], 'safe'],
            [['date_response'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['response_description'], 'string'],
            [['price', 'performer', 'response_mark'], 'integer'],
            [['performer'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['performer' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_response' => 'Date Response',
            'response_description' => 'Response Description',
            'price' => 'Price',
            'performer' => 'Performer',
            'response_mark' => 'Response Mark',
        ];
    }

    /**
     * Gets query for [[Performer0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerformer()
    {
        return $this->hasOne(User::class, ['id' => 'performer']);
    }
}
