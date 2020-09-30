<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'Yeti';

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/web/favicon.ico" type="image/x-icon"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Тесты',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $testAdministration = '';
    $questionAdministration = '';
    if (!Yii::$app->user->isGuest) {
        $testAdministration = ['label' => 'Тесты', 'url' => ['/admin/tests']];
        $questionAdministration = ['label' => 'Вопросы', 'url' => ['/admin/questions']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            $testAdministration,
            $questionAdministration,
            Yii::$app->user->isGuest ? (
                ['label' => 'Авторизация', 'url' => ['/user/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/user/logout'], 'post')
                . Html::submitButton(
                    'Выйти из аккаунта (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Тесты <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
<script src="https://kit.fontawesome.com/e89d0078fc.js" crossorigin="anonymous"></script>
</html>
<?php $this->endPage() ?>
