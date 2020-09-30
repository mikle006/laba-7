<?php

    use kartik\select2\Select2;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;

    /* @var $model app\models\Answers */
    /* @var $form ActiveForm */
    /* @var $this yii\web\View */

    $prevButtonVar = '';
    $qArrNum = $qDisplayId - 1;
    $answers = [];

    if ($qArrNum == 0) {
        $prevButtonVar = ' disabled';
    } else {
        $prevButtonVar = null;
    }

    foreach ($answerArr as $answer) {
        $answers[$answer['id']] = $answer['name'];
    }

    echo '<p id="questionid">'.$questionArr[$qArrNum]['id'].'</p>';
    echo '<h3>'.$questionArr['0']['test']['name'].'<br/><small>Вопрос №'.$qDisplayId.'</small></h3><h1 class="testPadding">'.$questionArr[$qArrNum]['name'].'</h1>';
    $form = ActiveForm::begin();
    echo $form->field($model, 'answer_id')->input('hidden');
    echo $form->field($model, 'answer_id')->widget(Select2::classname(), [
        'data' => $answers,
        'options' => [
            'placeholder' => 'Выберите ответ...',
            'id' => 'answerButton',
            'disabled' => $answerState,
        ],
    ]);
    echo Html::submitButton('Далее', ['class' => 'btn btn-success testNavButton']);
    if ($qDisplayId !== '1') {
        echo Html::a('Назад', Url::current(['question' => $qArrNum]), ['class' => 'btn btn-primary testNavButton']);
    }
    ActiveForm::end();
?>
<script>
$(document).ready(function () {
    
    $('#answerButton').change( function () {
        var answer = $('#answerButton').val();
        var questionid = $('#questionid').html();
        $('#answerButton').prop('disabled', 'true');
        $('#useranswers-answer_id').val(answer);
         if (answer !== '' && questionid !== '') { // checking if input is not empty
            $.ajax({
                url: '/test/compare', // php file that communicate with your DB
                method: 'POST', // it could be 'POST' too
                data: {"answer":answer, "questionid":questionid},
                // code that will be used to find your product name
                // you can call it in your php file by "$_GET['code']" if you specified GET method
            })
                .done(function (response) 
                {
                    if(response == true){
                        $('body').css({"animation":"correctAnswer 1s ease-in forwards"});
                    } else {
                        $('body').css({"animation":"wrongAnswer 1s ease-in forwards"});
                    }
                })
                .fail(function (response) 
                { // on error
                });

         }
    });
});
</script>