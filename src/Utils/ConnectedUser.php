<?php

namespace Oquiz\Utils;

// On rend la class abstraite car elle n'est qu'une librairie de fonction et n'a aucun intérêt à être instanciée
abstract class ConnectedUser
{
    const SESSION_DATA_NAME = 'user';

    /**
     * Methode permettant de savoir si un utilisateur est connecté à son compte.
     *
     * @return bool
     */
    public static function isConnected(): bool
    {
        return !empty($_SESSION[self::SESSION_DATA_NAME]);
    }

    /**
     * Methode permettant de récupérer.
     *
     * @return mixed|bool
     */
    public static function getUser()
    {
        if (self::isConnected()) {
            return $_SESSION[self::SESSION_DATA_NAME];
        }

        return false;
    }

    /**
     * Méthode permettant de connecter un user
     * 
     * @return bool
     */
    public static function connect($user): bool
    {
        $_SESSION[self::SESSION_DATA_NAME] = $user;

        return true;
    }

    /**
     * Méthode permettant de déconnecter un user.
     *
     * @return bool
     */
    public static function disconnect(): bool
    {
        //session_destroy();
        unset($_SESSION[self::SESSION_DATA_NAME]);

        return true;
    }
}
