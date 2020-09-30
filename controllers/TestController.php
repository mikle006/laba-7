<?php

namespace app\controllers;

use Yii;
use app\models\Questions;
use app\models\Answers;
use app\models\Test;
use app\models\UserAnswers;
use yii\helpers\Url;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $testId = Yii::$app->request->get('id');
        $qDisplayId = Yii::$app->request->get('question');
        if (isset($qDisplayId)) {
            $questionArr = Questions::find()->joinWith('test')->where(['test_id' => $testId])->orderBy('id')->asArray()->all();
            if ($qDisplayId > count($questionArr)) {
                // Yii::$app->response->redirect(Url::toRoute(['test/', 'id' => $testId]));
                return $this->redirect(['test/', 'id' => $testId]);
            }
            $qNext = $qDisplayId + 1;
            $qNumArr = $qDisplayId - 1;
            $answerArr = Answers::find()->where(['question_id' => $questionArr[$qNumArr]['id']])->asArray()->all();
            $lastAnswer = UserAnswers::find()->where(['question_id' => $questionArr[$qNumArr]['id'], 'test_id' => $testId, 'user_id' => Yii::$app->user->id])->asArray()->all();
            $answerState = isset($lastAnswer['0']);
            $model = new UserAnswers();
            if ($answerState) {
                $model->answer_id = $lastAnswer['0']['answer_id'];
                if ($model->load(Yii::$app->request->post())) {
                    Yii::$app->response->redirect(Url::current(['question' => $qNext]));
                }
            } else {
                if ($model->load(Yii::$app->request->post())) {
                    $model->user_id = Yii::$app->user->id;
                    $model->test_id = $testId;
                    $model->question_id = $questionArr[$qNumArr]['id'];
                    $model->save();
                    Yii::$app->response->redirect(Url::current(['question' => $qNext]));
                };
            };

            return $this->render('index', compact('model', 'questionArr', 'answerArr', 'qDisplayId', 'testId', 'correctAnswer', 'answerState'));
        } else {
            $test = Test::find()->where(['id' => $testId])->asArray()->one();
            $useranswers = UserAnswers::find()->joinWith('answer')->where(['test_id' => $testId])->andWhere(['user_id' => Yii::$app->user->id])->asArray()->all();
            $countAnswers = count($useranswers);
            $questions = Questions::find()->where(['test_id' => $testId])->asArray()->all();
            $countQuestions = count($questions);
            $countCorrect = 0;
            $countFailed = 0;
            $completeState = false;
            if ($countAnswers == $countQuestions) {
                $completeState = true;
            }
            foreach ($useranswers as $a) {
                if ($a['answer']['isCorrect']) {
                    $countCorrect++;
                } else {
                    $countFailed++;
                }
            }
            $rightwordAnswers = function ($count) {
                if ($count == 1) {
                    return 'верный';
                } else {
                    return 'верных';
                };
            };
            $rightwordQuestions = function ($count) {
                if ($count == 1) {
                    return 'вопрос';
                };
                if ($count == 2) {
                    return 'вопроса';
                };
                if ($count > 2) {
                    return 'вопросов';
                };
            };
            return $this->render('rate', compact('test', 'countAnswers', 'countQuestions', 'countCorrect', 'countFailed', 'useranswers', 'rightwordAnswers', 'rightwordQuestions', 'completeState'));
        };
    }
    public function actionCompare()
    {
        if (Yii::$app->request->isAjax) {
            $correctAnswer = Answers::find('id')->where(['question_id' => Yii::$app->request->post('questionid'), 'isCorrect' => true])->asArray()->one();
            if (Yii::$app->request->post('answer') == $correctAnswer['id']) {
                return true;
            } else {
                return false;
            }
        }
    }
}
