<?php
/* @var $this yii\web\View */

echo '<div class="jumbotron">
    <p class="indexText">Редактирование тестов</p>
</div>';

echo '<div class="adminTestDiv row" style="margin-bottom: 30px;">
        <h4>Добавить тест<small>Нажмите на кнопку справа 😎</small></h4>
        <a href="/admin/add-test" class="adminTestButton">
            <button type="button" class="btn btn-success adminControlButton"><i class="fas fa-plus"></i></button>
        </a>
    </div>';

    foreach ($tests as $test):
        echo '
        <div class="adminTestDiv row">
            <h4>'.$test['name'].'<small>'.$test['description'].'</small></h4>
            <a href="/admin/remove-test?id='.$test['id'].'" class="adminTestButton">
                <button type="button" class="btn btn-danger adminControlButton"><i class="fas fa-trash"></i></button>
            </a>
            <a href="/admin/edit-test?id='.$test['id'].'" class="adminTestButton">
                <button type="button" class="btn btn-primary adminControlButton"><i class="fas fa-cog"></i></button>
            </a>
        </div>
        ';
    endforeach;
