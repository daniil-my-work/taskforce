<?php

namespace app\controllers;

use app\models\Category;
use app\models\Task;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class TaskController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['add'],
                        'roles' => ['user'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'], // Доступ для других действий для всех пользователей
                        'roles' => ['@'], // Для авторизованных пользователей
                    ],
                    [
                        'allow' => false,
                        'roles' => ['?'], // Запрещено для гостей (неавторизованных пользователей)
                    ],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'name_category');
        $model = new Task();

        $tasksQuery = Task::find();

        if (Yii::$app->request->getIsPost()) {
            // Загружаем данные из POST в модель
            $model->load(Yii::$app->request->post());
            // var_dump(Yii::$app->request->post());

            if ($model->validate()) {
                // Фильтрация по категориям
                if (!empty($model->name_category)) {
                    $tasksQuery->andWhere(['IN', 'category_id', $model->name_category]);
                }

                if ($model->without_performer) {
                    $tasksQuery->andWhere(['performer_id' => null]);
                }

                if ($model->period_value) {
                    $currentTime = time();

                    if ($model->period_value == '1') {
                        $tasksQuery->andWhere(['>', 'date_public', date('Y-m-d H:i:s', $currentTime - 3600)]);
                    } else if ($model->period_value == '12') {
                        $tasksQuery->andWhere(['>', 'date_public', date('Y-m-d H:i:s', $currentTime - 43200)]);
                    } else if ($model->period_value == '24') {
                        $tasksQuery->andWhere(['>', 'date_public', date('Y-m-d H:i:s', $currentTime - 86400)]);
                    }
                }
            }
        }

        $tasks = $tasksQuery->joinWith('cities')->joinWith('category')->orderBy("date_public DESC")->all();

        return $this->render('index', ['model' => $model, 'tasks' => $tasks, 'categories' => $categories]);
    }

    public function actionView($id)
    {
        $task = Task::find()
            ->where(['tasks.id' => $id])
            ->joinWith('cities')
            ->joinWith('category')
            ->one();

        if (!$task) {
            throw new \yii\web\NotFoundHttpException('Задача не найдена');
        }

        return $this->render('view', ['task' => $task]);
    }

    public function actionAdd()
    {
        return $this->render('add');
    }
}
