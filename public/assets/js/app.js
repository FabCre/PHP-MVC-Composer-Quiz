/*
UTILISATION DE AJAX POUR LA CONNEXION D'UN UTILISATEUR
Je l'ai utilisé ici pour montrer comment traiter la connexion sans rechargement de la page grace a AJAX.
*/

var app = {
  init: function () {
    console.log('init');

    $('#loginForm').on('submit', app.submitSigninForm);
  
  },

  submitSigninForm: function (evt) {
    evt.preventDefault();
    
    console.log('loginform soumis');

    // Je récupère les données à envoyer, déjà formatées
    var dataToSend = $(this).serialize();

    $('#alerts').hide();

    $.ajax({
      url: './signin',
      method: 'POST',
      dataType: 'json',
      data: dataToSend
    }).done(function (response) {

      // On récupère le traitement effectué par le server
      // Si ok, l'utilisateur est redirigé
      if (response.code == 1) {
        
        $('#alerts').removeClass('alert-danger').addClass('alert-success').html('Connexion réussie').show();
        // La redirection s'effectue après 2 secondes, histoire de voir le message de succès de la connexion
        window.setTimeout(function () {
          location.href = response.redirect;
        }, 2000);
      }
      // Si y a une erreur, affichage des erreurs
      else {

        var $alertsDiv = $('#alerts');
        
        // Vidage de la div a chaque soumission et affichage des erreurs grace à une boucle sur le tableau
        // Puis affichage

        $alertsDiv.empty();
        $.each(response.errors, function (index, value) {
          $alertsDiv.append(value + '<br>');
        });
        $alertsDiv.show();
      }
    }).fail(function () {
      alert('Ajax failed');
    });
  },
};

$(app.init);
