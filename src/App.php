<?php

namespace Oquiz;

use AltoRouter;
use Oquiz\Controllers\BaseController;

/* Class qui sert de FrontController */
class App extends AltoRouter
{   
    /**
     * Propriété statique contenant le array de la conf.
     *
     * @var array
     */
    private static $config;

    /* Surchage/Override du constructeur du parent */
    public function __construct()
    {
        /* Exécute le constructeur du parent (AltoRouter) */
        parent::__construct();

        $this->setBasePath($_SERVER['BASE_URI']);

        /* Appelle de la méthode defineRoutes qui se charge de remplir */
        $this->defineRoutes();

        /* Définissions d'une constante pour le dossier app = APP_PATH*/
        // define définit constante
        define('APP_PATH', __DIR__);
    }

    public function run()
    {
        $match = $this->match();

        if ($match === false) {
            BaseController::sendHttpError('404', 'Page 404 not found');
        } else {
            list($controllerName, $methodName) = explode('#', $match['target']);

            /* Complétion du nom du controller */
            $controllerName = '\\Oquiz\\Controllers\\'.$controllerName.'Controller';

            /* Nouvelle instance du controller */
            $controller = new $controllerName();

            /* Définissions de la valeur de la propriété app du Controller avec la méthode de BaseController*/
            $controller->setApp($this);

            /* Appel de la méthode qui est après le # */
            $controller->$methodName($match['params']);
        }
    }

    private function defineRoutes()
    {
        /* Route => Home - Accueil */
        
        /* / home : la liste des quiz disponibles
            | _ /quiz/8 page d'un quiz (consulter ou jouer)
            |_  /signup/    inscription
            |_  /signin/    connection
            |_  /compte/    profil user (accessible seulement à l' user connecté) 
        */

        // (GET/POST , url , Controller#Méthode , alias)
        $this->map('GET', '/', 'Main#home', 'main_home');

        $this->map('GET', '/quiz/[i:id]', 'Quiz#oneQuiz', 'quiz_onequiz');
        $this->map('POST', '/quiz/[i:id]', 'Quiz#responseQuiz', 'quiz_responsequiz');
        
        $this->map('GET|POST', '/signup', 'User#signUp', 'user_signup');

        $this->map('GET', '/signin', 'User#signIn', 'user_signin');
        $this->map('POST', '/signin', 'User#signInPost', 'user_signin_post');

        $this->map('GET', '/signout', 'User#signOut', 'user_signout');

        $this->map('GET', '/account', 'User#account', 'user_account');
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function getRouter() : AltoRouter
    {
        return $this;
    }
}
