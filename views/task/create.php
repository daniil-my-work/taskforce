<div class="add-task-form regular-form">
    <?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $form = ActiveForm::begin();
    ?>
    <h3 class="head-main head-main">Публикация нового задания</h3>

    <?= $form->field($model, 'title', [
        'template' => '
                <label class="control-label" for="{id}">{label}</label>
                {input}
                {error}
            ',
        'options' => ['class' => 'form-group'],
        'inputOptions' => ['id' => 'essence-work']
    ])->textInput()->label('Опишите суть работы'); ?>

    <?= $form->field($model, 'task_description', [
        'template' => '
                <label class="control-label" for="{id}">{label}</label>
                {input}
                {error}
            ',
        'options' => ['class' => 'form-group'],
        'inputOptions' => ['id' => 'essence-work']
    ])->textarea(['rows' => 4])->label('Подробности задания'); ?>

    <!-- Category_id -->
    <?= $form->field($model, 'category_id')
        ->dropDownList(
            $categoryArray,
            ['prompt' => 'Выберите категорию']
        )
        ->label('Категория'); ?>

    <?= $form->field($model, 'city', [
        'template' => '
                <label class="control-label" for="{id}">{label}</label>
                {input}
                {error}
            ',
        'options' => ['class' => 'form-group'],
        'inputOptions' => ['id' => 'location']
    ])->textInput()->label('Локация'); ?>

    <?= $form->field($model, 'title', [
        'template' => '
                <label class="control-label" for="{id}">{label}</label>
                {input}
                {error}
            ',
        'options' => ['class' => 'half-wrapper'],
        'inputOptions' => ['id' => 'essence-work']
    ])->textInput()->label('Локация'); ?>

    <div class="half-wrapper">
        <?= $form->field($model, 'title', [
            'template' => '
                <label class="control-label" for="{id}">{label}</label>
                {input}
                {error}
            ',
            'options' => ['class' => 'form-group'],
            'inputOptions' => ['id' => 'budget']
        ])->textInput()->label('Бюджет'); ?>

        <?= $form->field($model, 'title', [
            'template' => '
                <label class="control-label" for="{id}">{label}</label>
                {input}
                {error}
            ',
            'options' => ['class' => 'form-group'],
            'inputOptions' => ['id' => 'date']
        ])->input('date')->label('Срок исполнения'); ?>
    </div>

    <?= Html::submitButton('Опубликовать', ['class' => 'button button--blue']); ?>

    <?php ActiveForm::end();
    ?>
</div>