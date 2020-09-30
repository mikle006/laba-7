<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property string $name
 * @property int $answer_id
 * @property int $test_id
 *
 * @property Answers[] $answers
 * @property Test $test
 * @property Answers $answer
 * @property UserAnswers[] $userAnswers
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'answer_id', 'test_id'], 'required'],
            ['test_id', 'integer'],
            [['name'], 'string', 'max' => 256],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Вопрос',
            'test_id' => 'Название теста',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['question_id' => 'id']);
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
    public function getUserAnswers()
    {
        return $this->hasMany(UserAnswers::className(), ['question_id' => 'id']);
    }
}
