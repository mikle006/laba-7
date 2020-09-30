<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */


echo '<h3 style="line-height: 72px;">Вы действительно хотите удалить вопрос "'.$questionInfo['name'].'"?<h3>';
$form = ActiveForm::begin();
echo Html::submitButton('Удалить', ['class' => 'btn btn-danger testNavButton']);
ActiveForm::end();
echo Html::a('Назад', 'questions/', ['class' => 'btn btn-primary testNavButton']);
