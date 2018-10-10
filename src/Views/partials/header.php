<header class="container-fluid  mb-3">
       <nav class="navbar navbar-light">
         <h1 class="font-weight-bold">Quiz</h1>
          <ul class="nav">
            <?php if ($isConnected) : ?>
              <li class="nav-item">
              <p class="nav-link text-center">Bonjour <span class="font-weight-bold"><?= $connectedUser->getFirst_name() ?></span></p>
              </li>
             <li class="nav-item ml-2">
               <a class="nav-link text-center" href="<?= $router->generate('main_home'); ?>"><i class="fas fa-home"></i>Acceuil</a>
             </li>
             <li class="nav-item ml-2">
               <a class="nav-link text-center" href="<?= $router->generate('user_account'); ?>"><i class="fas fa-user"></i> Mon Compte</a>
             </li>
             <li class="nav-item ml-2">
               <a class="nav-link text-center" href="<?= $router->generate('user_signout'); ?>"><i class="fas fa-sign-in-alt"></i> Déconnexion</a>
             </li>
           </ul>
            <?php else : ?>
             <li class="nav-item ml-2">
               <a class="nav-link text-center" href="<?= $router->generate('main_home'); ?>"><i class="fas fa-home"></i> Acceuil</a>
             </li>
             <li class="nav-item ml-2">
               <a class="nav-link text-center" href="<?= $router->generate('user_signup'); ?>"><i class="fas fa-edit"></i> Inscription</a>
               </li>
             <li class="nav-item ml-2">
               <a class="nav-link" href="<?= $router->generate('user_signin'); ?>"><i class="fas fa-sign-in-alt"></i> Se Connecter</a>
             </li>
           </ul>
        <?php endif; ?>
        </nav>
</header>

