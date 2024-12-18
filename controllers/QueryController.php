<?php

namespace app\controllers;

use yii\db\Expression;
use yii\web\Controller;

class QueryController extends Controller
{
    public function actionIndex() {}


    // public function actionTestActiveQuery1()
    // {
    //     // 1
    //     $users = User::find()
    //         ->where(['name' => 'Иван'])
    //         ->orderBy('dt_create DESC')
    //         ->all();

    //     // 2
    //     // $orders = Orders::find()
    //     //     ->where('>', 'dt_send', 'NOW()');

    //     // foreach ($orders as $order) {
    //     //     $order->status = 'Просрочено';
    //     // }

    //     $orders = Order::find()
    //         ->where(['<', 'dt_send', new Expression('NOW()')]);

    //     foreach ($orders as $order) {
    //         $order->status = 'Просрочено';
    //         $order->save();
    //     }

    //     // 3
    //     // $products = new Products();
    //     // $new_product = [
    //     //     'name' => 'Вино',
    //     //     'price' => 100,
    //     //     'category' => 'vine',
    //     // ];
    //     // $products->attribute($new_product);
    //     // $products->save();

    //     $products = new Products();
    //     $new_product = [
    //         'name' => 'Вино',
    //         'price' => 100,
    //         'category' => 'vine',
    //     ];
    //     $products->setAttributes($new_product);
    //     $products->save();

    //     // 4
    //     // $sessions = Sessons::findAll([
    //     //     '>',
    //     //     'active_time',
    //     //     'NOW() - 3600'
    //     // ]);

    //     // foreach ($sessions as $session) {
    //     //     $session->delete();
    //     // }

    //     $sessions = Sessons::find()
    //         ->where(['<', 'active_time', new Expression('NOW() - INTERVAL 1 MONTH')])
    //         ->all();

    //     foreach ($sessions as $session) {
    //         $session->delete();
    //     }

    //     // 5
    //     // $users = Users::find()->joinWith('orders');

    //     $users = Users::find()
    //         ->joinWith('orders', true, 'LEFT JOIN')
    //         ->all();

    //     // 6
    //     // $orders = Orders::findAll()->count();
    //     // $orders_count = $orders->count();

    //     // $orders_sum = 0;
    //     // foreach ($orders as $order) {
    //     //     $orders_sum += $order->price;
    //     // }

    //     $orders_count = Orders::find()->count();
    //     $orders_sum = Orders::find()->sum('price');

    //     // 7
    //     $activeUsers = Users::find()
    //         ->joinWith('orders')
    //         ->where(['status' => 'active'])
    //         ->groupBy('user.id')
    //         ->having(['>', 'COUNT(orders.id)', 5])
    //         ->all();


    //     // 8
    //     $categories = Products::find()
    //         ->select(['category', 'COUNT(*) AS count'])
    //         ->groupBy('category')
    //         ->asArray()
    //         ->all();

    //     // 9
    //     $products = Products::find()
    //         ->where(['id' => Orders::find()->select('product_id')])
    //         ->all();

    //     // 10
    //     $users = Users::find()
    //         ->joinWith('enrollments')
    //         ->where(['enrollments.course_name' => 'Программирование'])
    //         ->all();
    // }

    // public function actionTestActiveQuery2() // 4/10
    // {
    //     // 1
    //     $users = Users::find()
    //         ->where(['>', 'age', 18]);

    //     // 2 – Как упростить?
    //     // $users = Users::find()
    //     //     ->andFilterWhere(['or', 'name', 'John'])
    //     //     ->andFilterWhere(['or', 'name', 'Jane']);

    //     $users = User::find()
    //         ->where(['or', ['name' => 'John'], ['name' => 'Jane']]);


    //     // 3
    //     // $orders = Orders::find()
    //     //     ->addFilterWhere(['status' => 'completed'])
    //     //     ->andFilterWhere(['<', 'dt_buy', new Expression('YEAR(2023)')]);

    //     $orders = Orders::find()
    //         ->where(['status' => 'completed'])
    //         ->andWhere(['<', 'dt_buy', '2023-01-01']);


    //     // 4
    //     $products = Products::find()
    //         ->orderBy('price DESC');

    //     // 5. Напишите запрос, который выберет количество заказов для каждого пользователя из таблицы orders.
    //     // $orders = Order::find()
    //     //     ->joinWith('users')
    //     //     ->groupBy('users.id');

    //     $orders = Order::find()
    //         ->select(['user.id', 'COUNT(order.id) as order_count'])
    //         ->joinWith('users')
    //         ->groupBy('user.id');

    //     "SELECT user.id, COUNT(order.id) as count_order FROM order JOIN user ON order.user_id = user.id GROUP BY user.id";

    //     // 6
    //     // $products = Product::find()
    //     //     ->all();

    //     // foreach ($products as $product) {
    //     //     $product->price = $product->price * 1,1;
    //     //     $product->save();
    //     // }

    //     // Product::updateAll(['price' => new Expression('price * 1.1')]);

    //     $products = Product::find()->all(); // Получаем все продукты

    //     foreach ($products as $product) {
    //         $product->price *= 1.1; // Увеличиваем цену на 10%
    //         $product->update(false, ['price']); // Обновляем только поле 'price', пропуская валидацию
    //     }

    //     // 7
    //     // $users = Users::find()
    //     //     ->where([
    //     //         'status' => 'inactive',
    //     //         'dt_reg' => new Expression('NOW() - 2 year')
    //     //     ]);

    //     // $users = Users::find()
    //     //     ->where(
    //     //         ['status' => 'inactive'],
    //     //         '<', 'dt_reg', new Expression('DATE_SUB(NOW() - INTERVAL 2 YEAR)')
    //     //     );

    //     // foreach ($users as $user) {
    //     //     $user->delete();
    //     // }

    //     User::deleteAll(
    //         ['status' => 'inactive'],
    //         ['<', 'dt_reg', new Expression('DATE_SUB(NOW() - INTERVAL 2 YEAR)')]
    //     );

    //     // 8
    //     $products = Product::find()
    //         ->where(['category' => NULL]);

    //     // 9
    //     // $products = Product::find()
    //     //     ->sortBy('price DESC')
    //     //     ->limit(10);

    //     $products = Product::find()
    //         ->orderBy('price DESC')
    //         ->limit(10);

    //     // 10
    //     // $orders = Order::find()
    //     //     ->where([
    //     //         'and',
    //     //         ['>', 'dt_send', new Expression('NOW()')],
    //     //         ['<', 'dt_send', new Expression('NOW() - 3600')]
    //     //     ]);

    //     $orders = Order::find()
    //         ->where([
    //             'and',
    //             ['>', 'dt_send', new Expression('NOW() - INTERVAL 1 YEAR')],
    //             ['<', 'dt_send', new Expression('NOW()')]
    //         ]);
    // }

    // public function actionTestActiveQuery3() // 4/10
    // {
    //     // 1
    //     // $users = User::findAll([
    //     //     'is_active' => true,
    //     //     '<',
    //     //     'dt_reg',
    //     //     new Expression('NOW() - INTERVAL 1 YEAR')
    //     // ]);

    //     // $users = User::find()
    //     //     ->where([
    //     //         'and',
    //     //         ['is_active' => true],
    //     //         [
    //     //             '<',
    //     //             'dt_reg',
    //     //             new Expression('NOW() - INTERVAL 1 YEAR')
    //     //         ]
    //     //     ]);

    //     $user = User::find()
    //         ->where(['is_active' => true])
    //         ->andWhere(['<', 'dt_reg', new Expression('NOW() - INTERVAL 1 YEAR')])
    //         ->all();

    //     // 2
    //     // $orders = Order::findAll([
    //     //     '>',
    //     //     'price',
    //     //     '10000'
    //     // ])->orderBy('dt_act DESC');

    //     $orders = Order::find()
    //         ->where([
    //             '>',
    //             'price',
    //             '10000'
    //         ])
    //         ->orderBy('dt_act DESC')
    //         ->all();

    //     // 3
    //     $products = Product::find()
    //         ->where([
    //             'and',
    //             ['category' => 'electronics'],
    //             ['in_stock' => false],
    //             ['>', 'price', 500],
    //         ])->all();

    //     // 4
    //     $users = User::find()
    //         ->where(
    //             [
    //                 'or',
    //                 ['like', 'surname', 'S%'],
    //                 ['like', 'surname', 'M%']
    //             ]
    //         )->all();

    //     // 5
    //     // $products = Product::findAll([
    //     //     'and',
    //     //     ['category' => 'sale'],
    //     //     ['discount' => NULL]
    //     // ]);

    //     $products = Product::find()
    //         ->where([
    //             'and',
    //             ['category' => 'sale'],
    //             ['discount' => NULL]
    //         ])
    //         ->all();

    //     // 6
    //     Order::updateAll(
    //         ['status' => 'overdue'],
    //         ['>', 'delivery_date', '2024-08-07']
    //     );

    //     // 7
    //     // $comments = User::findOne(123)
    //     // ->joinWith('comments')
    //     // ->where(['>', 'dt_add', new Expression('NOW() - INTERVAL 1 WEEK')]);

    //     $comments = User::find()
    //         ->joinWith('comments')
    //         ->where(['user.id' => 123])
    //         ->andWhere(['>', 'dt_add', new Expression('NOW() - INTERVAL 1 WEEK')])
    //         ->all();

    //     // 8
    //     $products = Product::find()
    //         ->where(['category' => 'clothing'])
    //         ->orderBy('price DESC')
    //         ->limit(5)
    //         ->all();

    //     // 9
    //     // User::deleteAll([
    //     //     'and',
    //     //     ['is_active' => false],
    //     //     ['>', 'dt_reg', new Expression('NOW() - INTERVAL 1 YEAR')],
    //     // ]);

    //     $usersToDelete = User::find()
    //         ->where(['is_active' => false])
    //         ->andWhere(['<', 'dt_reg', new Expression('NOW() - INTERVAL 1 YEAR')])
    //         ->all();

    //     foreach ($usersToDelete as $user) {
    //         $user->delete();
    //     }

    //     // 10
    //     // $orders = Order::find()
    //     //     ->where([
    //     //         'order.product_id' => 456
    //     //     ])
    //     //     ->orderBy('order_total ASC');

    //     $orders = Order::find()
    //         ->joinWith('product')
    //         ->where(['product.id' => 456])
    //         ->orderBy(['order_total' => SORT_ASC])
    //         ->all();
    // }

    public function actionTestActiveQuery4() {

    }


    public function actionTestActiveQueryLast() {}



    // Работа с Expression.
    // Не используйте Expression в методах deleteAll и updateAll.
}
