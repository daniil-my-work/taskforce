<?php

namespace app\models;

use yii\db\ActiveRecord;

class Publisher extends ActiveRecord
{
    public static function tableName()
    {
        return 'publisher';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID издателя',
            'name' => 'Название издателя',
            'address' => 'Адрес издателя',
            'created_at' => 'Дата и время создания записи',
            'updated_at' => 'Дата и время последнего обновления записи',
        ];
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 500],
        ];
    }

    public function getBooks()
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])
            ->viaTable('book_publisher', ['publisher_id' => 'id']);
    }
}
