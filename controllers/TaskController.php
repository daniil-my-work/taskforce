<?php

namespace app\controllers;

use app\models\Category;
use app\models\Task;
use app\models\User;
use app\src\classes\logic\action\CancelTaskAction;
use app\src\classes\logic\action\CompleteTaskAction;
use app\src\classes\logic\action\DenyTaskAction;
use app\src\classes\logic\action\ResponseTaskAction;
use app\src\classes\logic\AvailableActions;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
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
                        'actions' => ['create'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            // Проверяем поле user_role в identity пользователя
                            return Yii::$app->user->identity && Yii::$app->user->identity->user_role === 'user';
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'change-status'], // Доступ для других действий для всех пользователей
                        'roles' => ['@'], // Для авторизованных пользователей
                    ],
                    [
                        'allow' => false,
                        'roles' => ['*'], // Запрещено для гостей (неавторизованных пользователей)
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
        $userId = Yii::$app->user->getId();
        $user = User::findOne($userId);

        $strategy = new AvailableActions(AvailableActions::STATUS_NEW, $user->id, 1);
        $actions = $strategy->getAvailableActions($user->user_role, 1);
        var_dump($actions);

        $task = Task::find()
            ->with('cities')         // Используем with для загрузки связанных данных
            ->with('category')      // Загрузите один город и одну категорию
            ->with('response')      // Загрузите множество откликов
            ->with(['response.performer'])
            ->where(['tasks.id' => $id])
            ->one();

        if (!$task) {
            throw new \yii\web\NotFoundHttpException('Задача не найдена');
        }

        return $this->render('view', ['task' => $task, 'actions' => $actions]);
    }

    public function actionCreate()
    {
        $task = new Task();

        // Все категории
        $categories = Category::find()->all();
        $categoryArray = ArrayHelper::map($categories, 'id', 'name_category');

        if (Yii::$app->request->getIsPost()) {
            // дальше
            $task->load(Yii::$app->request->post());

            if ($task->validate()) {
                $task->save(false);

                return $this->redirect(['task/view', 'id' => $task->id]);
            }
        }

        return $this->render('create', ['model' => $task, 'categoryArray' => $categoryArray]);
    }

    public function actionChangeStatus($taskId, $status)
    {
        // Таска
        $taskId = Yii::$app->request->get('taskId');
        $task = Task::findOne($taskId);

        // Юзер
        $userId = Yii::$app->user->getId();
        $user = User::findOne($userId);

        $strategy = new AvailableActions($task->task_status, $user->id);
        $actions = $strategy->getAvailableActions($user->user_role, $userId);

        // Создаем экземпляр класса
        $task->task_status = $status;

        return $this->render('view', ['task' => $task, 'actions' => $actions]);
    }
}
