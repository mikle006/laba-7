<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use app\models\Test;
use app\models\Questions;
use app\models\Answers;
use yii\helpers\Url;

class AdminController extends \yii\web\Controller
{
    public function actionTests()
    {
        $tests = Test::find()
        ->orderBy('id')
        ->asArray()
        ->all();
        return $this->render('tests', compact('tests'));
    }
    public function actionAddTest()
    {
        $model = new Test;
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            Yii::$app->response->redirect(Url::to('/admin/tests'));
        }
        return $this->render('addtest', compact('model'));
    }
    public function actionAddQuestion()
    {
        $testId = Yii::$app->request->get('id');
        $testInfo = Test::find()->where(['id' => $testId])->asArray()->one();
        $model = new Questions;
        for ($i = 0; $i < 4; $i++) {
            $answers[] = new Answers();
        }
        if ($model->load(Yii::$app->request->post())) {
            $correctAnswer = $_POST['correctAnswer'];
            $model->test_id = $testId;
            $model->save(false);
            $the_id = $model->id;
            foreach ($answers as $key=>$value) {
                if ($correctAnswer == $key) {
                    $value->isCorrect = true;
                } else {
                    $value->isCorrect = false;
                }
                $value->name = $_POST['Answers'][$key]['name'];
                $value->question_id = $the_id;
                $value->save(false);
            }
            Yii::$app->response->redirect(Url::to('/admin/questions'));
        }
        return $this->render('addquestion', compact('model', 'answers', 'testInfo'));
    }
    public function actionEditTest()
    {
        $testId = Yii::$app->request->get('id');
        $test = Test::findOne($testId);
        $model = new Test;
        $model->name = $test['name'];
        $model->description = $test['description'];
        if ($model->load(Yii::$app->request->post())) {
            $test->name = $model['name'];
            $test->description = $model['description'];
            $test->update();
            Yii::$app->response->redirect(Url::to('/admin/tests'));
        }
        return $this->render('edittest', compact('model', 'test'));
    }
    public function actionEditQuestion()
    {
        $questionId = Yii::$app->request->get('id');
        $model = Questions::find()->where(['id' => $questionId])->one();
        $answers = Answers::find()->where(['question_id' => $questionId])->all();
        if ($model->load(Yii::$app->request->post())) {
            $correctAnswer = $_POST['correctAnswer'];
            $model->save(false);
            $the_id = $model->id;
            foreach ($answers as $key=>$value) {
                if ($correctAnswer == $key) {
                    $value->isCorrect = true;
                } else {
                    $value->isCorrect = false;
                }
                $value->name = $_POST['Answers'][$key]['name'];
                $value->question_id = $the_id;
                $value->save(false);
            }
            Yii::$app->response->redirect(Url::to('/admin/questions'));
        }
        return $this->render('editquestion', compact('model', 'question', 'answers'));
    }
    public function actionRemoveQuestion()
    {
        $questionId = Yii::$app->request->get('id');
        $questionInfo = Questions::find()->where(['id' => $questionId])->asArray()->one();
        if (Yii::$app->request->post()) {
            $question = Questions::find()->where(['id' => $questionId])->one();
            $question->delete();
            Yii::$app->response->redirect(Url::to('/admin/questions'));
        }
        return $this->render('removequestion', compact('questionInfo'));
    }

    public function actionRemoveTest()
    {
        $testId = Yii::$app->request->get('id');
        $tests = Test::find()
            ->where(['id' => $testId])
            ->asArray()
            ->all();
        $model = new Test;
        if (Yii::$app->request->post()) {
            $test = Test::find()->where(['id' => $testId])->one();
            $test->delete();
            Yii::$app->response->redirect(Url::to('/admin/tests'));
        }
        return $this->render('removetest', compact('tests', 'model'));
    }
    public function actionQuestions()
    {
        $tests = Test::find()->asArray()->all();
        $model = new Questions;
        return $this->render('questions', compact('model', 'tests'));
    }
    public function actionQuestionsfind()
    {
        $questions = Questions::find()->where(['test_id' => $_POST['questionfind']])->asArray()->all();
        return json_encode($questions);
    }
}
