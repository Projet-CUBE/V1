
<div class="topnav" id="myTopnav">
        <a class="navbar-brand" href="#">Projet CUBE</a>

                <?php if ($member->isLogged()): ?>
                    <a href="index.php?page=accueil">Accueil</a>
                    <a href="index.php?page=statistique">Statistique</a>
                    <a href="index.php?page=gestion-comptes">Gestion des comptes</a>
                    <a href="index.php?page=evenements">Evènements</a>
                    <a href="index.php?page=profil">Profil</a>
                    <a href="index.php?page=deconnexion">Déconnexion</a>
                <?php else: ?>
                    <a href="index.php?page=accueil">Accueil</a>
                    <a href="index.php?page=connexion">Connexion</a>
                    <a href="index.php?page=inscription">Inscription</a>
                <?php endif; ?>

                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>             
