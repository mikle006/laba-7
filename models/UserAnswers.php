<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_answers".
 *
 * @property int $id
 * @property int $user_id
 * @property int $test_id
 * @property int $question_id
 * @property int $answer_id
 *
 * @property Test $test
 * @property User $user
 * @property Questions $question
 * @property Answers $answer
 */
class UserAnswers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'test_id', 'question_id', 'answer_id'], 'required'],
            [['user_id', 'test_id', 'question_id', 'answer_id'], 'integer'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answers::className(), 'targetAttribute' => ['answer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'test_id' => 'Test ID',
            'question_id' => 'Question ID',
            'answer_id' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(Answers::className(), ['id' => 'answer_id']);
    }
}
