<?php

namespace app\models;

use yii\db\ActiveRecord;

class Contact extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            "name" => "Имя",
            "phone" => "Телефон",
            "email" => "Е-майл",
            "position" => "Должность",
        ];
    }

    public function rules() {
        return [
            [['name', 'phone', 'email', 'position'], 'safe']  
        ];
    }
}
