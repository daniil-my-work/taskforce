<?php

namespace app\models;

use yii\db\ActiveRecord;

class BookPublisher extends ActiveRecord
{
    public static function tableName()
    {
        return 'book_publisher';
    }

    public function attributeLabels()
    {
        return [
            'book_id' => 'Ссылка на таблицу book',
            'publisher_id' => 'Ссылка на таблицу publisher',
            'created_at' => 'Дата и время создания записи',
        ];
    }

    public function rules()
    {
        return [
            [['book_id', 'publisher_id'], 'required'],
            ['book_id', 'integer'],
            ['publisher_id', 'integer'],
        ];
    }
}
