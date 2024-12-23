<?php

namespace app\controllers;

use app\models\Task;
use Yii;
use yii\web\Controller;

class TaskController extends Controller
{
    public function actionIndex()
    {
        $model = new Task();

        $tasksQuery = Task::find();

        if (Yii::$app->request->getIsPost()) {
            $model->load(Yii::$app->request->post());

            if ($model->validate()) {
                // var_dump(Yii::$app->request->post());
                var_dump($model->attributes);

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

        $tasks = $tasksQuery->orderBy("date_public DESC")->all();

        return $this->render('@app/views/site/task', ['model' => $model, 'tasks' => $tasks]);
    }
}
