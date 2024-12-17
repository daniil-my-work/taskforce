<?php

namespace app\controllers;

use yii\db\Expression;
use yii\web\Controller;

class QueryController extends Controller
{
    public function actionTestActiveQuery()
    {
        // 1
        $users = User::find()
            ->where(['name' => 'Иван'])
            ->orderBy('dt_create DESC')
            ->all();

        // 2
        // $orders = Orders::find()
        //     ->where('>', 'dt_send', 'NOW()');

        // foreach ($orders as $order) {
        //     $order->status = 'Просрочено';
        // }

        $orders = Order::find()
            ->where(['<', 'dt_send', new Expression('NOW()')]);

        foreach ($orders as $order) {
            $order->status = 'Просрочено';
            $order->save();
        }

        // 3
        // $products = new Products();
        // $new_product = [
        //     'name' => 'Вино',
        //     'price' => 100,
        //     'category' => 'vine',
        // ];
        // $products->attribute($new_product);
        // $products->save();

        $products = new Products();
        $new_product = [
            'name' => 'Вино',
            'price' => 100,
            'category' => 'vine',
        ];
        $products->setAttributes($new_product);
        $products->save();

        // 4
        // $sessions = Sessons::findAll([
        //     '>',
        //     'active_time',
        //     'NOW() - 3600'
        // ]);

        // foreach ($sessions as $session) {
        //     $session->delete();
        // }

        $sessions = Sessons::find()
            ->where(['<', 'active_time', new Expression('NOW() - INTERVAL 1 MONTH')])
            ->all();

        foreach ($sessions as $session) {
            $session->delete();
        }

        // 5
        // $users = Users::find()->joinWith('orders');

        $users = Users::find()
            ->joinWith('orders', true, 'LEFT JOIN')
            ->all();

        // 6
        // $orders = Orders::findAll()->count();
        // $orders_count = $orders->count();

        // $orders_sum = 0;
        // foreach ($orders as $order) {
        //     $orders_sum += $order->price;
        // }

        $orders_count = Orders::find()->count();
        $orders_sum = Orders::find()->sum('price');

        // 7
        $activeUsers = Users::find()
            ->joinWith('orders')
            ->where(['status' => 'active'])
            ->groupBy('user.id')
            ->having(['>', 'COUNT(orders.id)', 5])
            ->all();


        // 8
        $categories = Products::find()
            ->select(['category', 'COUNT(*) AS count'])
            ->groupBy('category')
            ->asArray()
            ->all();

        // 9
        $products = Products::find()
            ->where(['id' => Orders::find()->select('product_id')])
            ->all();

        // 10
        $users = Users::find()
            ->joinWith('enrollments')
            ->where(['enrollments.course_name' => 'Программирование'])
            ->all();
    }
}
