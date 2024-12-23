<?php

namespace app\controllers;

use yii\db\Query as DbQuery;
use yii\web\Controller;

class BookController extends Controller
{
    public function actionIndex()
    {
        // echo "hello";

        // 1
        // $books = Book::find()
        //     ->select(['author', 'genre'])
        //     ->asArray()
        //     ->all();
        // var_dump($books);

        // 2
        // $books = Book::find()
        //     ->where(['>', 'published_year', '2000-01-01'])
        //     ->asArray()
        //     ->all();
        // var_dump($books);

        // 3
        // $books = Book::find()
        //     ->where(['genre' => 'Фантастика'])
        //     ->asArray()
        //     ->all();
        // var_dump($books);

        // 4
        // $books = Book::find()
        //     ->select(['book.*', 'publisher.name'])
        //     ->joinWith('publishers')
        //     ->limit(5)
        //     ->asArray()
        //     ->all();
        // var_dump($books);

        // 5
        // $publisher = Publisher::find()
        //     ->joinWith('books')
        //     ->where(['book.genre' => 'Детектив'])
        //     ->asArray()
        //     ->all();
        // var_dump($publisher);

        // 6
        // $books = Book::findAll(
        //     ['author' => 'Camila Lebsack']
        // );
        // $books = Book::find()
        //     ->where(['author' => 'Camila Lebsack'])
        //     ->asArray()
        //     ->all();
        // var_dump($books);

        // 7
        // $books = Book::find()
        //     ->where(['published_year' => 1986])
        //     ->asArray()
        //     ->all();
        // var_dump($books);

        // 8
        // $books = Book::find()
        //     ->orderBy('published_year DESC')
        //     ->asArray()
        //     ->all();
        // var_dump($books);

        // 9
        // $books = Book::find()
        //     ->select('COUNT(id) as total_count')
        //     ->where(['genre' => 'Роман'])
        //     ->asArray()
        //     ->all();
        // var_dump($books);

        // 10
        // $publisher = Publisher::find()
        //     ->joinWith('books')
        //     ->where(['>', 'book.published_year', 2000])
        //     ->asArray()
        //     ->all();
        // var_dump($publisher);


        // 2.1
        // $query = new DbQuery();
        // $query->select(['book.*', 'publisher.*']);
        // $query->with

        // $books = $query->all();
        // var_dump($books);
    }
}
