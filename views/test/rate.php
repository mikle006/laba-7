<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<h1><?= $test['name']?></h1>
<div class='testResults'>

    <p>Вы ответили на <?= $countAnswers.' '.$rightwordQuestions($countAnswers)?> из <?= $countQuestions?></p>
    <p>Из ваших ответов: <?= $countCorrect.' '.$rightwordAnswers($countCorrect)?> и <?= $countFailed.' не'.$rightwordAnswers($countFailed)?>.</p>

    <?php
        if (!$completeState) {
            echo Html::a('Продолжить тест', Url::current(['question' => $countAnswers+1]), ['class' => 'btn btn-success testNavButton']);
        }

    ?>

</div>