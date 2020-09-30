<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */


echo '
        <h3 style="line-height: 72px;">Создание нового вопроса для "'.$testInfo['name'].'"</h3>
    ';
$form = ActiveForm::begin();
    echo '<div class="adminAddMain">';
    echo $form->field($model, 'name')->textInput();
    foreach ($answers as $index => $answer) {
        echo $form->field($answer, "[$index]name")->label('Ответ');
    }
    echo Select2::widget([
        'name' => 'correctAnswer',
        'data' => ['1', '2', '3', '4'],
        'options' => ['placeholder' => 'Выберите правильный ответ'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    echo Html::submitButton('Добавить', ['class' => 'btn btn-success testNavButton', 'style' => 'margin: 50px auto;']);
    echo '</div>';
ActiveForm::end();
