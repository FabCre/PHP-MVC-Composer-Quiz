# Quiz

 ![GitHub](https://img.shields.io/github/license/mashape/apistatus.svg?style=plastic)
 ![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg?style=plastic)
 ![Composer](https://img.shields.io/badge/dependecies-composer-blue.svg?style=plastic)
 ![Status](https://img.shields.io/badge/status-finished-red.svg?style=plastic)

**Quiz** is a simple PHP application on MVC design pattern.

## Project description

Upon arriving on the home page, visitors see the list of available quizzes.
A link also allows them to connect.
By clicking on the title of a quiz, we consult the details of a quiz.
On the quiz page, the quiz information and the list of questions are displayed.
Unconnected visitors can only view the list of questions, while connected visitors can play.

### Instructions

* create a DB and configure the config.dist.conf (/src)
* import into the DB the structure (`sql/oquiz-struct.sql`) then the data (`sql/oquiz-data.sql`).
* install Composer dependencies (AltoRouter, Plates)

### Data

* A quiz is created by a user, and is composed of several questions.
* Each question has 4 propositions, only one of which is correct. In database the correct answer is in the `prop1` field of the `questions` table.
* The questions are characterized by a difficulty level
* The database also contains the data relating to the users of the site.

#### User Test

* chuck@oclock.io - quizoclock

Ready to play?

Enjoy, it's free to use and share!

## Author

FabCre

I made this application to practice PHP on MVC design pattern with OOP.
