<?php $this->layout('layout', ['title' => 'Oquiz - Quiz']); ?>

<div class="container-fluid col-md-10 offset-md-1">
  <h2 class="font-weight-bold text-center"><?= $quizModel->getTitle(); ?><span id="bagde-title" class="badge badge-pill badge-info ml-3"><?= $nbrQuestions; ?> questions</span></h2>
  <h3 class="text-center"><?= $quizModel->getDescription(); ?></h3>
  <p class="text-center">by <?= $userModel->getFirst_name(). ' ' . $userModel->getLast_name() ?></p>
</div>

<div class="container-fluid col-md-10 offset-md-1">
  <?php if ($isConnected) : ?>
  <form method="post" id="responseform">
    <div class="row alert alert-primary" role="alert">
    Répondez à un maximum de questions avant de valider !
    </div>
    <div class="row justify-content-between">
      <?php foreach ($questionModel as $question) : ?>
      <div class="card border-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">
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
              <input type="radio" id="<?= $propShuffled; ?>" name="<?= $question->getId(); ?>" aria-label="Radio button for following text input" value="<?= $propShuffled; ?>" />
              <label for="<?=$propShuffled; ?>"><?= ' ' . $propShuffled; ?></label>
            </div>
            <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
      <button class="container-fluid btn btn-block btn-primary">Valider mes réponses</button>
    </form>
    <?php else : ?>
      <div class="row justify-content-between">
        <?php foreach ($questionModel as $question) : ?>
        <div class="card border-secondary mb-3" style="max-width: 18rem;">
          <div class="card-header"> 
            <?php foreach ($levelsModel as $levels) {
              $level = $levels->findQuestionLevelById($question->getId_level());
            } ?>
            <span class="badge-level badge badge-<?= $level->displayLevelColor($question->getId_level()); ?>">
              <?= $level->getName(); ?>
            </span>
            <?= $question->getQuestion(); ?>
          </div>
          <div class="column card-body">
            <ol>
              <?php $propValue = $question->shuffleProp();
              foreach ($propValue as $propShuffled) : ?>
                <li><?= $propShuffled; ?></li>
              <?php endforeach; ?>
            </ol>
          </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>