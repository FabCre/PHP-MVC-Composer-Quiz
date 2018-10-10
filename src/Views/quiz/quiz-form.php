<?php $this->layout('layout', ['title' => 'Oquiz - Quiz']); ?>

<div class="container-fluid col-md-10 offset-md-1">
  <h2 class="font-weight-bold text-center"><?= $quizModel->getTitle(); ?><span id="bagde-title" class="badge badge-pill badge-info ml-3"><?= $nbrQuestions; ?> questions</span></h2>
  <h3 class="text-center"><?= $quizModel->getDescription(); ?></h3>
  <p class="text-center">by <?= $userModel->getFirst_name() . ' ' . $userModel->getLast_name() ?></p>
</div>

<div class="container-fluid col-md-10 offset-md-1">
  <form method="get" id="responseform">
      <div class="row justify-content-between alert alert-success" role="alert">
      <p class="m-0">Votre score : <?= $answers['goodAwnserCount']; ?> / <?= $nbrQuestions; ?> !</p>
      <a href="<?= $router->generate('quiz_onequiz', ['id' => $quizModel->getId()]) ?>">Rejouez ?</a>
      </div>
    <div class="row justify-content-between">
      <?php foreach ($questionModel as $question) : ?>
      <div class="card border-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header <?= $answers['class'][$question->getId()] ?>">
          <?php foreach ($levelsModel as $levels) {
            $level = $levels->findQuestionLevelById($question->getId_level());
          } ?>
          <span class="badge-level badge badge-<?= $level->displayLevelColor($question->getId_level()); ?>">
          <?= $level->getName(); ?>
          </span>
          <?= $question->getQuestion(); ?>
        </div>
        <div class="column card-body">
            <?php $propValue = $question->shuffleProp();
            foreach ($propValue as $propShuffled) : ?>
            <div>
              <input type="radio" id="<?= $propShuffled; ?>" name="<?= $question->getId(); ?>" aria-label="Radio button for following text input" <?= $propShuffled == $answers['value'][$question->getId()] ? "value=" . $answers['value'][$question->getId()] . ' ' . 'checked' : "value=" . $propShuffled;  ?> />
              <label for="<?= $propShuffled; ?>"><?= ' ' . $propShuffled; ?></label>
            </div>
            <?php endforeach; ?>
          </div>
          <?php if (!empty($answers['anecdote'][$question->getId()]) && !empty($answers['wiki'][$question->getId()])) : ?>
            <div class="card-footer"><p><?= $answers['anecdote'][$question->getId()] ?></p><a href="https://fr.wikipedia.org/wiki/<?= $answers['wiki'][$question->getId()] ?>">Wikipedia(<?= $answers['wiki'][$question->getId()] ?>)</a></div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
        <button class="container-fluid btn btn-block btn-success">Rejouez ?</button>
    </form>
  </div>
</div>