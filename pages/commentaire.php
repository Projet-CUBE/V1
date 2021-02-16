<?php 

// echo $_POST['commentaire']; 


$commentaire->getPoste((int)$_POST['commentaire']);

$commentaire->getCommentaires((int)$_POST['commentaire']);


// header("refresh:3;index.php?page=accueil"); // Refresh 3 second and redirect to index.php
?>

