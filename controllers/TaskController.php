<?php

namespace app\controllers;

use app\models\Task;
use yii\web\Controller;

class TaskController extends Controller
{
    public function actionIndex()
    {
        $tasks = Task::find()
            ->where(['task_status' => 'Completed'])
            ->orderBy("date_public DESC")
            ->all();

        return $this->render('@app/views/site/task', ['tasks' => $tasks]);
    }
}
