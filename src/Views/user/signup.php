<?php $this->layout('layout', ['title' => 'Sign Up']) ?>

<form class="col-12 col-md-6 offset-md-3 p-5" method="post">
    <h2 class="font-weight-bold text-center">Inscription</h2>
    <p class="text-center">Vous pouvez vous inscrire à Oquiz pour jouer et tester vos connaissances :) ! Le traitement de ce formulaire s'effectue en php et un message vous avertira d'une erreur éventuelle lors de la validation. Si la validation est correct, vous serez redirigé vers la page de connexion.</p>
    <?php if (!empty($errorList)) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= join('<br>', $errorList) ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="lastname">Nom *</label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $fieldValues['lastname'] ?>" aria-describedby="lastnameHelp" placeholder="Votre Nom" required>
        <small id="lastnameHelp" class="form-text text-muted">En minuscules et sans espaces ni caractères spéciaux</small>
    </div>
    <div class="form-group">
        <label for="firstname">Prénom *</label>
        <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $fieldValues['firstname'] ?>" aria-describedby="firstnameHelp" placeholder="Votre Prénom" required>
        <small id="firstnameHelp" class="form-text text-muted">En minuscules et sans espaces ni caractères spéciaux</small>
    </div>
    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $fieldValues['email'] ?>" aria-describedby="emailHelp" placeholder="Adresse email" required>
        <small id="emailHelp" class="form-text text-muted">Votre adresse email restera secrète.</small>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe *</label>
        <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Choisissez votre mot de passe" required>
        <small id="passwordHelp" class="form-text text-muted">8 caractères minimum, et avec au moins une lettre et un chiffre</small>
    </div>
    <div class="form-group">
        <label for="password2">Confirmation *</label>
        <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmation du mot de passe" required>
    </div>
    <div class="form-group">
        <small class="form-text text-muted">* Champs obligatoires</small>
    </div>
    <button class="btn btn-block btn-primary">Valider</button>
</form>
