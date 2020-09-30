<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */

$num = 0;
echo '
        <h3 style="line-height: 72px;">Редактирование вопроса</h3>
    ';
$form = ActiveForm::begin();
    echo '<div class="adminAddMain">';
    echo $form->field($model, 'name')->textInput();
    foreach ($answers as $index => $answer) {
        $num++;
        echo $form->field($answer, "[$index]name")->label('Ответ '.$num);
    }
    echo '<label class="control-label">Правильный ответ</label>';
    echo Select2::widget([
        'name' => 'correctAnswer',
        'data' => ['1', '2', '3', '4'],
        'options' => ['placeholder' => 'Выберите правильный ответ'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    echo Html::submitButton('Сохранить', ['class' => 'btn btn-success testNavButton', 'style' => 'margin: 50px auto;']);
    echo '</div>';
ActiveForm::end();
