<?php

namespace Oquiz\Controllers;

use Oquiz\Models\QuizzesModel;
use Oquiz\Models\UsersModel;

class MainController extends BaseController
{
    public function home()
    {
        // Retrouve toute les quizzes et tout les utilisateurs
        $quizzesList = QuizzesModel::findAll();
        $users = UsersModel::findAll();
        
        // Boucles pour retrouver les correspondances Firstname et Lastname
        foreach ($users as $usersId) {
            $usersFirstName[$usersId->getId()] = $usersId->getFirst_name();
        }
        foreach ($users as $usersId) {
            $usersLastName[$usersId->getId()] = $usersId->getLast_name();
        }
        
        // Envoi des données pour la view
        $this->displayHTML('main/home',[
            'quizzesList' => $quizzesList,
            'usersFirstName' => $usersFirstName,
            'usersLastName' => $usersLastName,
        ]);
     }
}
