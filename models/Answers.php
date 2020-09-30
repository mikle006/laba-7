<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property int $id
 * @property string $name
 * @property int $isCorrect
 * @property int $question_id
 *
 * @property Questions $question
 * @property Questions[] $questions
 * @property UserAnswers[] $userAnswers
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'question_id'], 'required'],
            [['isCorrect', 'question_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ответ',
            'isCorrect' => 'Is Correct',
            'question_id' => 'Question ID',
        ];
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
    public function getQuestions()
    {
        return $this->hasMany(Questions::className(), ['answer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAnswers()
    {
        return $this->hasMany(UserAnswers::className(), ['answer_id' => 'id']);
    }
}
