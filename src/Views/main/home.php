<?php $this->layout('layout', ['title' => 'Oquiz - Home']); ?>

<div class="container-fluid p-5">
  <h2 class="font-weight-bold text-center">Bienvenue sur Quiz</h2>
  <p class="mx-auto font-weight-bold text-center col-8">Quiz est une application simple en PHP sur un model MVC avec une Base de Données MySQL. Ce projet utilise le gestionnaire de package Composer (Altorouter, leaguePlate, Symfony dumper).</p>
  <p class="mx-auto text-center col-8">En arrivant sur la page d'accueil, les visiteurs voient la liste des quiz disponibles. Un lien leur permet également de se connecter. En cliquant sur le titre d'un quiz, on consulte le détail d'un quiz. Sur la page d'un quiz s'affichent les infos du quiz et la liste de questions. Les visiteurs non connectés peuvent seulement consulter la liste des questions, alors que les visiteurs connectés peuvent jouer (grâce à un formulaire). Lorsqu'un visiteur se connecte il est redirigé vers la page d'accueil (liste des quiz).</p>
  <p class="mx-auto text-center col-8">Cliquer sur un quiz permet alors aux visiteurs connectés d'aller jouer:</p>
  <ul class="mx-auto text-center col-8">
    <li>Toutes les questions sont listées sur la page.</li>
    <li>Pour chaque questions, 4 boutons radio permettent de choisir une des 4 réponses.</li>
    <li>En bas de la page un bouton permet de soumettre ses réponses et d'afficher son résultat.</li>
  </ul>
  <p class="mx-auto text-center col-8">A l'affichage du résultat:</p>
  <ul class="mx-auto text-center col-8">
    <li>le score total est affiché (nombre de bonnes réponses / nombre total de qustions)</li>
    <li>Chaque question est colorée</li>
  </ul>
</div>
<div class="container-fluid pl-5 pr-5 col-md-10 offset-md-1">
  <div class="row justify-content-around">
    <?php foreach ($quizzesList as $one_quiz) : ?>
      <div class="col-4 pl-5 pr-5">
        <h3 class="font-weight-bold"><a href="<?= $router->generate('quiz_onequiz', ['id' => $one_quiz->getId()]) ?>"><?= $one_quiz->getTitle(); ?></a></h3>
        <h5 class="font-weight-bold"><?= $one_quiz->getDescription(); ?></h5>
        <p>by <?= $usersFirstName[$one_quiz->getId_author()] . ' ' . $usersLastName[$one_quiz->getId_author()]; ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>
