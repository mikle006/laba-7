<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */

echo '<div class="jumbotron">
    <p class="indexText">Редактирование вопросов</p>
</div>';

$testArr = [];

foreach ($tests as $test):
    $testArr[$test['id']] = $test['name'];
endforeach;

$form = ActiveForm::begin();
echo $form->field($model, 'test_id')->widget(Select2::classname(), [
    'data' => $testArr,
    'options' => ['placeholder' => 'Выберите тест...', 'id' => 'adminTestPicker'],
]);
ActiveForm::end();
?>
<div class="adminTestDiv row" id="addbutton" style="margin-bottom: 30px; display: none;">
    <h4>Добавить вопрос<small>Нажмите на кнопку справа 😎</small></h4>
    <a class="adminTestButton">
        <button type="button" class="btn btn-success adminControlButton"><i class="fas fa-plus"></i></button>
    </a>
</div>
<div class='testQuestions'>

</div>
<div class="adminTestDiv row" id="questionrow" style="display: none;">
    <a class="adminTestButton">
        <button type="button" class="btn btn-danger adminControlButton"><i class="fas fa-trash"></i></button>
    </a>
    <a class="adminTestButton">
        <button type="button" class="btn btn-primary adminControlButton"><i class="fas fa-cog"></i></button>
    </a>
</div>
<script>
$(document).ready(function () {
    const questionTemplate = $('#questionrow').html();
    var questionNum = 0;
    $('#adminTestPicker').change( function () {
        var questionfind = $('#adminTestPicker').val();
         if (questionfind !== '') { // checking if input is not empty
            $('#addbutton').css('display', 'inherit');
            var currentTestLink = '/admin/add-question?id=';
            $('#addbutton > a').attr('href', currentTestLink+questionfind);
            $.ajax({
                url: '/admin/questionsfind', // php file that communicate with your DB
                method: 'POST', // it could be 'POST' too
                data: {"questionfind": questionfind},
                // code that will be used to find your product name
                // you can call it in your php file by "$_GET['code']" if you specified GET method
            })
                .done(function (response) 
                {   
                    $('.testQuestions').html('');
                    // for(i = 0; i < response.length; i++){
                    //     $('.testQuestions').append('<div class="adminTestDiv row"><h4>'+response[i].name+'</h4>'+questionTemplate+'</div>');
                    // }
                    questionNum = 0;
                    $.each(JSON.parse(response), function(key,value) {
                        questionNum++;
                        $('.testQuestions').append('<div class="adminTestDiv row" value="'+key+'"><h4>'+value.name+'</h4>'+questionTemplate+'</div>');
                        $('.adminTestDiv[value="'+key+'"] > a:eq(0)').attr('href', '/admin/remove-question?id='+value.id);
                        $('.adminTestDiv[value="'+key+'"] > a:eq(1)').attr('href', '/admin/edit-question?id='+value.id);
                    });
                    if(questionNum > 9) {
                        $('#addbutton').css('display', 'none');
                    } else {
                        $('#addbutton').css('display', 'inherit');
                    }
                })
                .fail(function (response) 
                { // on error
                });

         } else {
            $('#addbutton').css('display', 'none');
         }
    });
});
</script>