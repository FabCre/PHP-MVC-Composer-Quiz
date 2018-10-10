<?php $this->layout('layout', ['title' => 'Sign In']) ?>

<form class="col-12 col-md-6 offset-md-3 p-5" method="post" id="loginForm">
  <h2 class="font-weight-bold text-center">Connexion</h2>
    <p class="text-center">Merci de renseigner votre email et votre passe pour vous connecter. Le traitement de votre connection s'effectue avec AJAX, un message vous avertira d'une erreur ou du succès de la connexion sans rechargement de la page :) ! </p>
    <div id="alerts" class="alert alert-danger alert-dismissible" role="alert" style="display:none;">
    </div>
    
    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" class="form-control" id="email" name="email" value="" placeholder="Adresse email" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe *</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Choisissez votre mot de passe" required>
    </div>
    <div class="form-group">
        <small class="form-text text-muted">* champs obligatoires</small>
    </div>
    <button class="btn btn-block btn-primary">Valider</button>
</form>