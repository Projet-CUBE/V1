<?php
    $name = $_REQUEST['txt_name']; // TextBox name "txt_name"

    $idPost = (int)$_POST['idpost']; 

    var_dump($_SESSION['pseudo']);

    var_dump($idPost);

    $query = getPdo()->prepare('INSERT INTO commentaire (id_post, commentaire, auteur, date_commentaire) 
    VALUES ((SELECT UUID_post FROM post WHERE UUID_post = '.$idPost.'), :commentaire, :auteur, NOW())');

    $query->execute([
        'commentaire' => $name,
        'auteur' => $_SESSION['pseudo'] 
    ]);

    header("refresh:3;index.php?page=accueil"); // Refresh 3 second and redirect to index.php

    ?>
