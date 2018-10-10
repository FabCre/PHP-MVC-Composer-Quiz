<?php $this->layout('layout', ['title' => 'Oquiz - My Account']); ?>

<div class="container-fluid p-5">
  <h2 class="font-weight-bold text-center">Mes Quizzes</h2>
  <?php if(!empty($user)) : ?>
  <p class="mx-auto text-center col-8">Tous les quizzes dont vous êtes l'auteur :) !</p>
  <?php else : ?>
  <p class="mx-auto text-center col-8">Vous n'êtes l'auteur d'aucun Quizzes :( !</p>
  <?php endif; ?>
</div>
  <div class="container-fluid pl-5 pr-5 col-md-10 offset-md-1">
    <div class="row justify-content-around">
    <?php foreach ($user as $userAccount) : ?>
      <div class="col-4 pl-5 pr-5">
        <h3 class="font-weight-bold"><a href="<?= $router->generate('quiz_onequiz', ['id' => $userAccount['id']]) ?>"><?= $userAccount['title']; ?></a></h3>
        <h5 class="font-weight-bold"><?= $userAccount['title']; ?></h5>
        <p>by <?= $userAccount['last_name'].' '.$userAccount['first_name']; ?></p>
      </div>
    <?php endforeach; ?>
    </div>
</div>