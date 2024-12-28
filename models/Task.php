<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string|null $date_public
 * @property string|null $task_status_code
 * @property string|null $task_status
 * @property string|null $title
 * @property string|null $task_description
 * @property string|null $task_file
 * @property int|null $budget
 * @property int|null $city
 * @property string|null $city_lon
 * @property string|null $city_lat
 * @property string|null $date_finish
 * @property int|null $category_id
 * @property int|null $client_id
 * @property int|null $performer_id
 *
 * @property Categories $category
 * @property Users $client
 * @property Users $performer
 */
class Task extends \yii\db\ActiveRecord
{
    public $name_category;
    public $without_performer;
    public $period_value;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_category', 'without_performer', 'period_value'], 'safe'],
            [['date_public', 'date_finish'], 'safe'],
            // [['date_public'], 'date', 'format' => 'php:Y-m-d'],
            // [['date_finish'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['task_status_code', 'task_status', 'title', 'city_lon', 'city_lat'], 'string', 'max' => 128],
            [['task_description', 'task_file'], 'string'],
            [['budget', 'city', 'category_id', 'client_id', 'performer_id'], 'integer'],
            // [['task_status_code'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['performer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['performer_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_public' => 'Date Public',
            'task_status_code' => 'Task Status Code',
            'task_status' => 'Task Status',
            'title' => 'Title',
            'task_description' => 'Task Description',
            'task_file' => 'Task File',
            'budget' => 'Budget',
            'city' => 'City',
            'city_lon' => 'City Lon',
            'city_lat' => 'City Lat',
            'date_finish' => 'Date Finish',
            'category_id' => 'Category ID',
            'client_id' => 'Client ID',
            'performer_id' => 'Performer ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasOne(City::class, ['id' => 'city']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(User::class, ['id' => 'client_id']);
    }

    /**
     * Gets query for [[Performer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerformer()
    {
        return $this->hasOne(User::class, ['id' => 'performer_id']);
    }
   
    /**
     * Gets query for [[Performer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponse()
    {
        return $this->hasMany(Response::class, ['performer' => 'performer_id']);
    }
}
