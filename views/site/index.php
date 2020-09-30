<?php

/* @var $this yii\web\View */

$this->title = 'Тест';
?>
<div class="site-index">

    <div class="jumbotron">
        <p class="indexText">Тесты</p>
    </div>

    <div class="tests">
    <?php

    foreach ($tests as $test):
        echo '
        <div class="testDiv col-sm-3">
            <h3>'.$test['name'].'</h3>
            <p>'.$test['description'].'</p>
            <a href="/test/?id='.$test['id'].'">
                <button type="button" class="btn btn-success testButton">Пройти тест</button>
            </a>
        </div>
        ';
    endforeach;

    ?>
    </div>

</div>
