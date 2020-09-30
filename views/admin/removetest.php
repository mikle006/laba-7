<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */


foreach ($tests as $test):
    echo '
        <h3 style="line-height: 72px;">Вы действительно хотите удалить тест "'.$test['name'].'"?<h3>
    ';
endforeach;
$form = ActiveForm::begin();
echo Html::submitButton('Удалить', ['class' => 'btn btn-danger testNavButton']);
echo Html::a('Назад', 'admin/', ['class' => 'btn btn-primary testNavButton']);
ActiveForm::end();
