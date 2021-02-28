<?php
    $name = $_REQUEST['txt_name']; // TextBox name "txt_name"

    $idPost = (int)$_POST['idpost']; 

    $query = getPdo()->prepare('INSERT INTO commentaire (id_post, commentaire, auteur, date_commentaire) 
    VALUES ((SELECT UUID_post FROM post WHERE UUID_post = '.$idPost.'), :commentaire, :auteur, NOW())');

    $query->execute([
        'commentaire' => $name,
        'auteur' => $_SESSION['pseudo'] 
    ]);

    header("refresh:3;index.php?page=accueil"); // Refresh 3 second and redirect to index.php

    ?>


<div class="alert alert-info">Vous avez inserer un commentaire, redirection en cours.</div>
