<?php 

if (isset($_POST['liste']) == NULL) {
  $_POST['liste'] = "fr_fr";

} 
elseif ($_POST['liste'] == "fr_fr" || "en_us" || "es_es" || "it_it" )
{
  $_SESSION['liste'] = $_POST['liste'];

}

 ?>

<div class="topnav" id="myTopnav">
        <a class="navbar-brand" href="#">Projet CUBE</a>

        <form action="#" method="post">
        <select id="liste" name="liste" class="form-select" aria-label="Default select example">
          <option value="fr_fr">Français</option>
          <option value="en_us">Anglais</option>
          <option value="es_es">Espagnol</option>
          <option value="it_it">Italien</option>
        </select>
        <button type="submit" >Langue</button>
        </form>

              <?php if ($_SESSION['liste'] == "fr_fr"): ?>
                <?php if ($member->isLogged()): ?>
                  <a href="index.php?page=accueil" id="accueil"><?php echo "<div>".htmlentities("Accueil")."</div>";?></a>
                  <a href="index.php?page=statistique" id="statistique"><?php echo "<div>".htmlentities("Statistique")."</div>";?></a>
                  <a href="index.php?page=gestion-comptes" id="gestion-comptes"><?php echo "<div>".htmlentities("Gestion des comptes")."</div>";?></a>
                  <a href="index.php?page=evenements" id="evenements"><?php echo "<div>".htmlentities("Evènements")."</div>";?></a>
                  <a href="index.php?page=profil" id="profil"><?php echo "<div>".htmlentities("Profil")."</div>";?></a>
                  <a href="index.php?page=deconnexion" id="deconnexion"><?php echo "<div>".htmlentities("Déconnexion")."</div>";?></a>
                  <a href="index.php?page=profil" id="profil"><?= $member->get('pseudo')?></a>
                <?php else: ?>
                  <a href="index.php?page=accueil" id="accueil"><?php echo "<div>".htmlentities("Accueil")."</div>";?></a>
                  <a href="index.php?page=connexion" id="connexion"><?php echo "<div>".htmlentities("Connexion")."</div>";?></a>
                  <a href="index.php?page=inscription" id="inscription"><?php echo "<div>".htmlentities("Inscription")."</div>";?></a>
                <?php endif; ?>

              <?php elseif ($_SESSION['liste'] == "en_us"): ?>
                <?php if ($member->isLogged()): ?>
                  <a href="index.php?page=accueil" id="accueil"><?php echo "<div>".htmlentities("Home")."</div>";?></a>
                  <a href="index.php?page=statistique" id="statistique"><?php echo "<div>".htmlentities("Statistics")."</div>";?></a>
                  <a href="index.php?page=gestion-comptes" id="gestion-comptes"><?php echo "<div>".htmlentities("Account management")."</div>";?></a>
                  <a href="index.php?page=evenements" id="evenements"><?php echo "<div>".htmlentities("Events")."</div>";?></a>
                  <a href="index.php?page=profil" id="profil"><?php echo "<div>".htmlentities("Profile")."</div>";?></a>
                  <a href="index.php?page=deconnexion" id="deconnexion"><?php echo "<div>".htmlentities("Disconnection")."</div>";?></a>
                  <a href="index.php?page=profil" id="profil"><?= $member->get('pseudo')?></a>
                <?php else: ?>
                  <a href="index.php?page=accueil" id="accueil"><?php echo "<div>".htmlentities("Home")."</div>";?></a>
                  <a href="index.php?page=connexion" id="connexion"><?php echo "<div>".htmlentities("Connection")."</div>";?></a>
                  <a href="index.php?page=inscription" id="inscription"><?php echo "<div>".htmlentities("Registration")."</div>";?></a>
                <?php endif; ?>

              <?php elseif ($_SESSION['liste'] == "es_es"): ?>
                <?php if ($member->isLogged()): ?>
                  <a href="index.php?page=accueil" id="accueil"><?php echo "<div>".htmlentities("Bienvenida")."</div>";?></a>
                  <a href="index.php?page=statistique" id="statistique"><?php echo "<div>".htmlentities("Estadístico")."</div>";?></a>
                  <a href="index.php?page=gestion-comptes" id="gestion-comptes"><?php echo "<div>".htmlentities("Administración de cuentas")."</div>";?></a>
                  <a href="index.php?page=evenements" id="evenements"><?php echo "<div>".htmlentities("Eventos")."</div>";?></a>
                  <a href="index.php?page=profil" id="profil"><?php echo "<div>".htmlentities("Perfil")."</div>";?></a>
                  <a href="index.php?page=deconnexion" id="deconnexion"><?php echo "<div>".htmlentities("Desconexión")."</div>";?></a>
                  <a href="index.php?page=profil" id="profil"><?= $member->get('pseudo')?></a>
                <?php else: ?>
                  <a href="index.php?page=accueil" id="accueil"><?php echo "<div>".htmlentities("Bienvenida")."</div>";?></a>
                  <a href="index.php?page=connexion" id="connexion"><?php echo "<div>".htmlentities("Conexión")."</div>";?></a>
                  <a href="index.php?page=inscription" id="inscription"><?php echo "<div>".htmlentities("Registrando")."</div>";?></a>
                <?php endif; ?>

              <?php elseif ($_SESSION['liste'] == "it_it"): ?>
                <?php if ($member->isLogged()): ?>
                  <a href="index.php?page=accueil" id="accueil"><?php echo "<div>".htmlentities("Accoglienza")."</div>";?></a>
                  <a href="index.php?page=statistique" id="statistique"><?php echo "<div>".htmlentities("Statistica")."</div>";?></a>
                  <a href="index.php?page=gestion-comptes" id="gestion-comptes"><?php echo "<div>".htmlentities("Gestione contabile")."</div>";?></a>
                  <a href="index.php?page=evenements" id="evenements"><?php echo "<div>".htmlentities("Eventi")."</div>";?></a>
                  <a href="index.php?page=profil" id="profil"><?php echo "<div>".htmlentities("Profilo")."</div>";?></a>
                  <a href="index.php?page=deconnexion" id="deconnexion"><?php echo "<div>".htmlentities("Disconnessione")."</div>";?></a>
                  <a href="index.php?page=profil" id="profil"><?= $member->get('pseudo')?></a>
                <?php else: ?>
                  <a href="index.php?page=accueil" id="accueil"><?php echo "<div>".htmlentities("Accoglienza")."</div>";?></a>
                  <a href="index.php?page=connexion" id="connexion"><?php echo "<div>".htmlentities("Connessione")."</div>";?></a>
                  <a href="index.php?page=inscription" id="inscription"><?php echo "<div>".htmlentities("Iscrizione")."</div>";?></a>
                <?php endif; ?>

              <?php endif; ?>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>    

<script>    

//  function remplissageAuto()
// {
//   var texte = document.getElementById('liste').value;

//   //---------------------------------Accueil--------------------------------------------
//   var en_us = {
//     accueil: "Home"
//   }

//   var fr_fr = {
//     accueil: "Accueil"
//   }

//   var es_es = {
//     accueil: "Bienvenida"
//   }

//   var it_it = {
//     accueil: "Accoglienza"
//   }
//   //-------------------------------------Tests de la langue---------------------------------------------------------
//   if(texte == "en_us")
//   {
//     var lang = en_us;
//   }
//   else if(texte == "fr_fr")
//   {
//     var lang = fr_fr;
//   }
//   else if(texte  == "es_es")
//   {
//     var lang = es_es;
//   }
//   else if(texte == "it_it")
//   {
//     var lang = it_it;
//   }
//   //---------------------------------Statistique--------------------------------------------
//   var en_us = {
//     statistique: "Statistics"
//   }

//   var fr_fr = {
//     statistique: "Statistique"
//   }

//   var es_es = {
//     statistique: "Estadístico"
//   }

//   var it_it = {
//     statistique: "Statistica"
//   }
//   //-------------------------------------Tests de la langue---------------------------------------------------------
//   if(texte == "en_us")
//   {
//     var stat = en_us;
//   }
//   else if(texte == "fr_fr")
//   {
//     var stat = fr_fr;
//   }
//   else if(texte == "es_es")
//   {
//     var stat = es_es;
//   }
//   else if(texte == "it_it")
//   {
//     var stat = it_it;
//   }
//   //-----------------------------Gestion des comptes------------------------------------------------
//   var en_us = {
//     gestioncomptes: "Account management"
//   }

//   var fr_fr = {
//     gestioncomptes: "Gestion des comptes"
//   }

//   var es_es = {
//     gestioncomptes: "Administración de cuentas"
//   }

//   var it_it = {
//     gestioncomptes: "Gestione contabile"
//   }
//   //-------------------------------------Tests de la langue---------------------------------------------------------
//   if(texte == "en_us")
//   {
//     var gestcomp = en_us;
//   }
//   else if(texte == "fr_fr")
//   {
//     var gestcomp = fr_fr;
//   }
//   else if(texte == "es_es")
//   {
//     var gestcomp = es_es;
//   }
//   else if(texte == "it_it")
//   {
//     var gestcomp = it_it;
//   }
//   //-----------------------------Evénements------------------------------------------------
//   var en_us = {
//     evenements: "Events"
//   }

//   var fr_fr = {
//     evenements: "Evénements"
//   }

//   var es_es = {
//     evenements: "Eventos"
//   }

//   var it_it = {
//     evenements: "Eventi"
//   }
//   //-------------------------------------Tests de la langue---------------------------------------------------------
//   if(texte == "en_us")
//   {
//     var events = en_us;
//   }
//   else if(texte == "fr_fr")
//   {
//     var events = fr_fr;
//   }
//   else if(texte == "es_es")
//   {
//     var events = es_es;
//   }
//   else if(texte == "it_it")
//   {
//     var events = it_it;
//   }
//   //--------------------------Profil---------------------------------------------------
//   var en_us = {
//     profil: "Profile"
//   }

//   var fr_fr = {
//     profil: "Profil"
//   }

//   var es_es = {
//     profil: "Perfil"
//   }

//   var it_it = {
//     profil: "Profilo"
//   }
//   //-------------------------------------Tests de la langue---------------------------------------------------------
//   if(texte == "en_us")
//   {
//     var profil = en_us;
//   }
//   else if(texte == "fr_fr")
//   {
//     var profil = fr_fr;
//   }
//   else if(texte == "es_es")
//   {
//     var profil = es_es;
//   }
//   else if(texte == "it_it")
//   {
//     var profil = it_it;
//   }
//   //----------------------------Déconnexion-------------------------------------------------
//   var en_us = {
//     deconnexion: "Disconnection"
//   }

//   var fr_fr = {
//     deconnexion: "Déconnexion"
//   }

//   var es_es = {
//     deconnexion: "Desconexión"
//   }

//   var it_it = {
//     deconnexion: "Disconnessione"
//   }
//   //-------------------------------------Tests de la langue---------------------------------------------------------
//   if(texte == "en_us")
//   {
//     var deconnexion = en_us;
//   }
//   else if(texte == "fr_fr")
//   {
//     var deconnexion = fr_fr;
//   }
//   else if(texte == "es_es")
//   {
//     var deconnexion = es_es;
//   }
//   else if(texte == "it_it")
//   {
//     var deconnexion = it_it;
//   }
//   //-----------------------Connexion------------------------------------------------------
//   var en_us = {
//     connexion: "Connection"
//   }

//   var fr_fr = {
//     connexion: "Connexion"
//   }

//   var es_es = {
//     connexion: "Conexión"
//   }

//   var it_it = {
//     connexion: "Connessione"
//   }
//   //-------------------------------------Tests de la langue---------------------------------------------------------
//   if(texte == "en_us")
//   {
//     var connexion = en_us;
//   }
//   else if(texte == "fr_fr")
//   {
//     var connexion = fr_fr;
//   }
//   else if(texte == "es_es")
//   {
//     var connexion = es_es;
//   }
//   else if(texte == "it_it")
//   {
//     var connexion = it_it;
//   }
//   //-------------------------Inscription----------------------------------------------------
//   var en_us = {
//     inscription: "Registration"
//   }

//   var fr_fr = {
//     inscription: "Inscription"
//   }

//   var es_es = {
//     inscription: "Registrando"
//   }

//   var it_it = {
//     inscription: "Iscrizione"
//   }
//   //-------------------------------------Tests de la langue---------------------------------------------------------
//   if(texte == "en_us")
//   {
//     var inscription = en_us;
//   }
//   else if(texte == "fr_fr")
//   {
//     var inscription = fr_fr;
//   }
//   else if(texte == "es_es")
//   {
//     var inscription = es_es;
//   }
//   else if(texte == "it_it")
//   {
//     var inscription = it_it;
//   }

//   // set all the text
//   document.getElementById("accueil").innerHTML = lang.accueil;
//   document.getElementById("statistique").innerHTML = stat.statistique;
//   document.getElementById("gestion-comptes").innerHTML = gestcomp.gestioncomptes;
//   document.getElementById("evenements").innerHTML = events.evenements;
//   document.getElementById("profil").innerHTML = profil.profil;
//   document.getElementById("deconnexion").innerHTML = deconnexion.deconnexion;
//   document.getElementById("connexion").innerHTML = connexion.connexion;
//   document.getElementById("inscription").innerHTML = inscription.inscription;

// }

</script>