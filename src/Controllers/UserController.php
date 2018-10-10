<?php

namespace Oquiz\Controllers;

use Oquiz\Utils\Database;
use Oquiz\Models\UsersModel;
use Oquiz\Models\BaseModel;
use Oquiz\Utils\ConnectedUser;
use Oquiz\Models\QuizzesModel;
use Oquiz\App;

class UserController extends BaseController
{

    public function signIn()
    {
        $this->displayHTML('user/signin');
    }

    public function signInPost()
    {
        // LA MÉTHODE SIGNINPOST DE CONNEXION UTILISATEUR RENVOI LE TRAITEMENT EN JSON POUR AJAX => voir app.js

        // Tableau d'erreurs
        $errorList = [];
        // Récupération des données
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
    
        // Effacement des espaces avec la fonction trim() de PHP
        $email = trim($email);
        $password = trim($password);
    
        // Validation des données
        // recherche les erreurs qui vont être stocker dans $errorList
        if (empty($email)) {
            $errorList[] = 'L\'email doit être renseigné';
        // Utilisation de la fonction PHP pour vérifier correctment le mail entré
        } else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errorList[] = 'L\'email est incorrect';
        }

        if (empty($password)) {
            $errorList[] = 'Le mot de passe doit être renseigné';
        } else if (strlen($password) < 8) {
            $errorList[] = 'Le mot de passe doit contenir au moins 8 caractères';
        }

        // S'il n'y a aucune erreur
        if (empty($errorList)) {
            // Appel à la BDD pour trouver l"email de l'utilisateur et le connecter
            $userModel = UsersModel::findByEmail($email);
            // Si aucun UserModel trouvé
            if ($userModel === false) {
                $errorList[] = 'Email non reconnu';
            }
            else {
                // Si le mot de passe est correct
                if (password_verify($password, $userModel->getPassword())) {
                    // Connexion de l'utilisateur avec les méthodes static de ConnectedUser.php
                    ConnectedUser::connect($userModel);
                    // Tableau à envoyer en JSON pour la connexion réussie
                    $jsonData = [
                        'code' => 1,
                        // l'URL de la page vers laquelle le code JS doit rediriger
                        'redirect' => $this->getRouter()->generate('main_home'),
                        'errors' => []
                    ];
                    $this->displayJson($jsonData);
                }
                // Sinon, afficher erreur password invalide
                else {
                    $errorList[] = 'Mot de passe invalide';
                }
            }
        }
        // Dans tous les cas, envois les erreurs au format JSON
        $jsonData = [
            'code' => 2,
            'errors' => $errorList
        ];
        $this->displayJson($jsonData);
    }

    public function signUp()
    {
        // LA MÉTHODE SIGNUP D'INSCRIPTION UTILISATEUR TRAITE LES DONNÉES À LA SOUMISSION DU FORMULAIRE
        // La page est rechargé, AJAX n'est pas utilisé ici.

        // Tableau stockant les erreurs du formulaire
        $errorList = [];
        // Tableau stockant les valeurs de chaque champ du formulaire
        $fieldValues = [
            'firstname' => '',
            'lastname' => '',
            'email' => ''
        ];
        
        // Si le formulaire est soumis
        if (!empty($_POST)) {
            
            // Récupération des données avec des conditions TERNAIRES
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $passwordConfirm = isset($_POST['password2']) ? $_POST['password2'] : '';
            $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
            $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
                        
            // Traitement des données effacement des espaces et suppression des balises
            $email = trim($email);
            $password = trim($password);
            $passwordConfirm = trim($passwordConfirm);
            $firstname = trim(strip_tags($firstname));
            $lasttname = trim(strip_tags($lastname));
            
            // Validation des données
            // recherche les erreurs qui vont être stocker dans $errorList
            if (empty($email)) {
                $errorList[] = 'L\'email doit être renseigné';
            } else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errorList[] = 'L\'email est incorrect';
            }

            if (empty($password)) {
                $errorList[] = 'Le mot de passe doit être renseigné';
            } else if (strlen($password) < 8) {
                $errorList[] = 'Le mot de passe doit contenir au moins 8 caractères';
            } else if ($password !== $passwordConfirm) {
                $errorList[] = 'Les deux mots de passe doivent être identiques';
            }

            if (empty($firstname)) {
                $errorList[] = 'Le Prénom doit être renseigné';
            }

            if (empty($lasttname)) {
                $errorList[] = 'Le Nom doit être renseigné';
            }

            // Si il n'y a pas d'erreur
            if (empty($errorList)) {
                // Instance d'un nouveau usersmodel
                $userModel = new UsersModel();
                
                // hash le mot de passe pour la sécurité et qu'il ne soit pas en "clair" la BDD
                $hash = password_hash($password, PASSWORD_DEFAULT);
                
                // Utilisation des setter du modèle pour définir les données
                $userModel->setEmail($email);
                $userModel->setPassword($hash);
                $userModel->setFirst_name($firstname);
                $userModel->setLast_name($lastname);
                
                // Sauvergarde du Model, la méthode save() effectue un INSERT dans la BDD
                if ($userModel->save()) {
                    // Redirection vers la page de Login
                    header('Location: ' . $this->getRouter()->generate('user_signin'));
                    exit;
                } else {
                    // Si la méthode renvoi false alors affichage d'une erreur
                    $errorList[] = 'Erreur dans la sauvegarde';
                }
            }
            // Sinon il y a une erreur, les valeurs pour les champs sont renvoyer pour aider l'utilisateur
            $fieldValues['lastname'] = $lastname;
            $fieldValues['firstname'] = $firstname;
            $fieldValues['email'] = $email;
        }
        $this->displayHTML('user/signup', [
            // permet d'afficher des erreurs au dessus du formulaire
            'errorList' => $errorList, 
            // permet de pré-remplir les champs du formulaire
            'fieldValues' => $fieldValues 
            ]);
    }

    public function account()
    {   
        $user = $_SESSION['user'];
        $userId = $user->getId();

        // récupérer ID quand l'utilisateur est connecté
        $user = UsersModel::findUsers($userId);

        $this->displayHTML('user/account', [
            // envoi à la vue les données
            'user' => $user
        ]);        
    }

    public function signOut()
    {        
        // déconnecter le user
        ConnectedUser::disconnect();
        // rediriger vers la home
        $homeURL = $this->getRouter()->generate('main_home');
        // Je redirige vers la page d'accueill
        $this->redirect($homeURL);
    }
    
}