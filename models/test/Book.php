<?php

namespace app\models;

use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    const MY_ENUM_VALUE1 = "Фантастика";
    const MY_ENUM_VALUE2 = "Детектив";
    const MY_ENUM_VALUE3 = "Роман";
    const MY_ENUM_VALUE4 = "Поэзия";

    public static function tableName()
    {
        return 'book';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID книги',
            'title' => 'Название книги',
            'author' => 'Автор книги',
            'published_year' => 'Год публикации',
            'genre' => 'Жанр книги',
            'created_at' => 'Дата и время создания записи',
            'updated_at' => 'Дата и время последнего обновления записи',
        ];
    }

    public static function getEnumArray()
    {
        return [
            self::MY_ENUM_VALUE1,
            self::MY_ENUM_VALUE2,
            self::MY_ENUM_VALUE3,
            self::MY_ENUM_VALUE4
        ];
    }

    public function rules()
    {
        return [
            [['title', 'author', 'published_year', 'genre'], 'required'],
            ['published_year', 'integer', 'min' => 1500, 'max' => 2024],
            ['genre', 'in', 'range' => self::getEnumArray()]
        ];
    }

    public function getPublishers()
    {
        return $this->hasMany(Publisher::class, ['id' => 'publisher_id'])
            ->viaTable('book_publisher', ['book_id' => 'id']);
    }
}
