<?php

use Oquiz\App;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

/* Activation du système de session sur tout le site */
session_start();

/* Instanciation du FrontController */
$app = new App();
$app->run();
