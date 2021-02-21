<?php 
    echo $_POST['delete']; 

    $post->deletePosts((int)$_POST['delete']);

    header("refresh:3;index.php?page=accueil"); // Refresh 3 second and redirect to index.php

?>

<div class="alert alert-info">Vous avez supprimer le post, redirection en cours.</div>
