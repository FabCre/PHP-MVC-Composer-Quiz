<?php

namespace Oquiz\Controllers;

use Oquiz\Models\QuizzesModel;
use Oquiz\Models\QuestionsModel;
use Oquiz\Models\UsersModel;
use Oquiz\Models\LevelsModel;

class QuizController extends BaseController
{
    public function oneQuiz($urlParams)
    {
        $quizModel = QuizzesModel::find($urlParams['id']);

        $quizModelId = $quizModel->getId();

        $userModelId = $quizModel->getId_author();

        $userModel = UsersModel::find($userModelId);

        $questionModel = QuestionsModel::findAllQuestionsByQuizId($quizModelId);

        $nbrQuestions = QuestionsModel::countAllQuestions($quizModelId);

        $levelsModel = LevelsModel::findAll();

        $this->displayHTML('quiz/quiz', [
            'quizModel' => $quizModel,
            'userModel' => $userModel,
            'questionModel' => $questionModel,
            'levelsModel' => $levelsModel,
            'nbrQuestions' => $nbrQuestions['COUNT(*)']
            ]);
    }
        
    public function responseQuiz($urlParams)
    {
        $quizModel = QuizzesModel::find($urlParams['id']);

        $quizModelId = $quizModel->getId();

        $userModelId = $quizModel->getId_author();

        $userModel = UsersModel::find($userModelId);

        $questionModel = QuestionsModel::findAllQuestionsByQuizId($quizModelId);

        $nbrQuestions = QuestionsModel::countAllQuestions($quizModelId);

        $levelsModel = LevelsModel::findAll();

        $answers = [
            'goodAwnserCount' => 0,
            'class' => '',
            'anecdote' => '',
            'wiki' => '',
            'value' => ''
        ];
        
        if (!empty($_POST)) {

            foreach ($questionModel as $idQuestions => $response) {

                $answerId = $response->getId();

                if (!isset($_POST[$answerId])) {
                    $_POST[$answerId] = '';
                }

                $goodAnswer[$answerId] = $response->getProp1();

                if ($_POST[$answerId] == $goodAnswer[$answerId]) 
                {
                    $answers['class'][$answerId] = 'alert-success';
                    $answers['goodAwnserCount']++;
                    $answers['anecdote'][$answerId] = $response->getAnecdote();
                    $answers['wiki'][$answerId] = $response->getWiki();
                    $answers['value'][$answerId] = $_POST[$answerId];
                }
                else if ($_POST[$answerId] !== $goodAnswer[$answerId] && $_POST[$answerId] !== '')
                {
                    $answers['class'][$answerId] = 'alert-warning';
                    $answers['anecdote'][$answerId] = $response->getAnecdote();
                    $answers['wiki'][$answerId] = $response->getWiki();
                    $answers['value'][$answerId] = $_POST[$answerId];
                }
                else
                {
                    $answers['class'][$answerId] = '';
                    $answers['anecdote'][$answerId] = '';
                    $answers['wiki'][$answerId] = '';
                    $answers['value'][$answerId] = '';
                }
            }     
        }

        $this->displayHTML('quiz/quiz-form', [
            'quizModel' => $quizModel,
            'userModel' => $userModel,
            'questionModel' => $questionModel,
            'levelsModel' => $levelsModel,
            'nbrQuestions' => $nbrQuestions['COUNT(*)'],
            'answers' => $answers
        ]);
    }
}
