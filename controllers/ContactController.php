<?php

namespace app\controllers;

use app\models\Contact;
use yii\db\Query;
use yii\web\Controller;

class ContactController extends Controller
{
    public function actionIndex()
    {
        $query = new Query();

        // $query->select(['name', 'label', 'phone'])->from('contact');
        // $query->select(['name', 'label', 'phone'])->from('contact')->where(['id' => '10']);

        $query->select(['name', 'email'])
            ->from('user')
            ->where(['position' => 'super', 'name' => 'Daniil'])
            ->orderBy(['id' => SORT_ASC])
            ->limit(20);

        $contacts = $query->all();

        foreach ($contacts as $contact) {
            print($contact->name);
        }
    }
}
