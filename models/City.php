<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string|null $city_name
 * @property string|null $city_lon
 * @property string|null $city_lat
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_name', 'city_lon', 'city_lat'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_name' => 'City Name',
            'city_lon' => 'City Lon',
            'city_lat' => 'City Lat',
        ];
    }
}
