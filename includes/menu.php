
<div class="topnav" id="myTopnav">
        <a class="navbar-brand" href="#">Projet CUBE</a>
        <select id="liste" onchange="remplissageAuto()" class="form-select" aria-label="Default select example">
          <option value="fr_fr">Français</option>
          <option value="en_us">Anglais</option>
          <option value="es_es">Espagnole</option>
          <option value="it_it">Italien</option>
        </select>
                <?php if ($member->isLogged()): ?>
                  <a href="index.php?page=accueil" id="accueil">Accueil</a>
                  <a href="index.php?page=statistique" id="statistique">Statistique</a>
                  <a href="index.php?page=gestion-comptes" id="gestion-comptes">Gestion des comptes</a>
                  <a href="index.php?page=evenements" id="evenements">Evènements</a>
                  <a href="index.php?page=profil" id="profil">Profil</a>
                  <a href="index.php?page=deconnexion" id="deconnexion">Déconnexion</a>
                  <a href="index.php?page=profil" id="profil"><?= $member->get('pseudo')?></a>
                <?php else: ?>
                  <a href="index.php?page=accueil" id="accueil">Accueil</a>
                  <a href="index.php?page=connexion" id="connexion">Connexion</a>
                  <a href="index.php?page=inscription" id="inscription">Inscription</a>
                <?php endif; ?>

                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>    

<script>    

 function remplissageAuto()
{
  var texte = document.getElementById('liste').value;

//---------------------------------Accueil--------------------------------------------
var en_us = {
  accueil: "Home"
}

var fr_fr = {
  accueil: "Accueil"
}

var es_es = {
  accueil: "Bienvenida"
}

var it_it = {
  accueil: "Accoglienza"
}
//-------------------------------------Tests de la langue---------------------------------------------------------
if(texte == "en_us")
{
  var lang = en_us;
}
else if(texte == "fr_fr")
{
  var lang = fr_fr;
}
else if(texte  == "es_es")
{
  var lang = es_es;
}
else if(texte == "it_it")
{
  var lang = it_it;
}
//---------------------------------Statistique--------------------------------------------
var en_us = {
  statistique: "Statistics"
}

var fr_fr = {
  statistique: "Statistique"
}

var es_es = {
  statistique: "Estadístico"
}

var it_it = {
  statistique: "Statistica"
}
//-------------------------------------Tests de la langue---------------------------------------------------------
if(texte == "en_us")
{
  var stat = en_us;
}
else if(texte == "fr_fr")
{
  var stat = fr_fr;
}
else if(texte == "es_es")
{
  var stat = es_es;
}
else if(texte == "it_it")
{
  var stat = it_it;
}
//-----------------------------Gestion des comptes------------------------------------------------
var en_us = {
  gestioncomptes: "Account management"
}

var fr_fr = {
  gestioncomptes: "Gestion des comptes"
}

var es_es = {
  gestioncomptes: "Administración de cuentas"
}

var it_it = {
  gestioncomptes: "Gestione contabile"
}
//-------------------------------------Tests de la langue---------------------------------------------------------
if(texte == "en_us")
{
  var gestcomp = en_us;
}
else if(texte == "fr_fr")
{
  var gestcomp = fr_fr;
}
else if(texte == "es_es")
{
  var gestcomp = es_es;
}
else if(texte == "it_it")
{
  var gestcomp = it_it;
}
//-----------------------------Evénements------------------------------------------------
var en_us = {
  evenements: "Events"
}

var fr_fr = {
  evenements: "Evénements"
}

var es_es = {
  evenements: "Eventos"
}

var it_it = {
  evenements: "Eventi"
}
//-------------------------------------Tests de la langue---------------------------------------------------------
if(texte == "en_us")
{
  var events = en_us;
}
else if(texte == "fr_fr")
{
  var events = fr_fr;
}
else if(texte == "es_es")
{
  var events = es_es;
}
else if(texte == "it_it")
{
  var events = it_it;
}
//--------------------------Profil---------------------------------------------------
var en_us = {
  profil: "Profile"
}

var fr_fr = {
  profil: "Profil"
}

var es_es = {
  profil: "Perfil"
}

var it_it = {
  profil: "Profilo"
}
//-------------------------------------Tests de la langue---------------------------------------------------------
if(texte == "en_us")
{
  var profil = en_us;
}
else if(texte == "fr_fr")
{
  var profil = fr_fr;
}
else if(texte == "es_es")
{
  var profil = es_es;
}
else if(texte == "it_it")
{
  var profil = it_it;
}
//----------------------------Déconnexion-------------------------------------------------
var en_us = {
  deconnexion: "Disconnection"
}

var fr_fr = {
  deconnexion: "Déconnexion"
}

var es_es = {
  deconnexion: "Desconexión"
}

var it_it = {
  deconnexion: "Disconnessione"
}
//-------------------------------------Tests de la langue---------------------------------------------------------
if(texte == "en_us")
{
  var deconnexion = en_us;
}
else if(texte == "fr_fr")
{
  var deconnexion = fr_fr;
}
else if(texte == "es_es")
{
  var deconnexion = es_es;
}
else if(texte == "it_it")
{
  var deconnexion = it_it;
}
//-----------------------Connexion------------------------------------------------------
var en_us = {
  connexion: "Connection"
}

var fr_fr = {
  connexion: "Connexion"
}

var es_es = {
  connexion: "Conexión"
}

var it_it = {
  connexion: "Connessione"
}
//-------------------------------------Tests de la langue---------------------------------------------------------
if(texte == "en_us")
{
  var connexion = en_us;
}
else if(texte == "fr_fr")
{
  var connexion = fr_fr;
}
else if(texte == "es_es")
{
  var connexion = es_es;
}
else if(texte == "it_it")
{
  var connexion = it_it;
}
//-------------------------Inscription----------------------------------------------------
var en_us = {
  inscription: "Registration"
}

var fr_fr = {
  inscription: "Inscription"
}

var es_es = {
  inscription: "Registrando"
}

var it_it = {
  inscription: "Iscrizione"
}
//-------------------------------------Tests de la langue---------------------------------------------------------
if(texte == "en_us")
{
  var inscription = en_us;
}
else if(texte == "fr_fr")
{
  var inscription = fr_fr;
}
else if(texte == "es_es")
{
  var inscription = es_es;
}
else if(texte == "it_it")
{
  var inscription = it_it;
}

// set all the text
document.getElementById("accueil").innerHTML = lang.accueil;
document.getElementById("statistique").innerHTML = stat.statistique;
document.getElementById("gestion-comptes").innerHTML = gestcomp.gestioncomptes;
document.getElementById("evenements").innerHTML = events.evenements;
document.getElementById("profil").innerHTML = profil.profil;
document.getElementById("deconnexion").innerHTML = deconnexion.deconnexion;
document.getElementById("connexion").innerHTML = connexion.connexion;
document.getElementById("inscription").innerHTML = inscription.inscription;

}

</script>