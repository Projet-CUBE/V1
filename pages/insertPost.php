<?php

// Changer dans php.init la limite de 2MB à plus PUIS REDEMMARRER

// https://www.onlyxcodes.com/2018/04/how-to-upload-insert-update-and-delete.html#New%20File%20Upload%20Codes%20Logic

//Récupération des valeurs des boutons radio Protection
if ($_POST['protection'] == 'private') {
    $private = 1;
    $public = 0;
    $protected = 0;
} elseif ($_POST['protection'] == 'public') {
    $private = 0;
    $public = 1;
    $protected = 0;
} else {
    $private = 0;
    $public = 0;
    $protected = 1;
}


//Image
$name = $_REQUEST['txt_name']; // TextBox name "txt_name"

$categorie = (int)$_POST['categorie']; // Selecctor de categorie

$image_file = $_FILES['txt_file']['name'];
$type = $_FILES['txt_file']['type']; // file name "txt_file"
$size = $_FILES['txt_file']['size'];
$temp = $_FILES['txt_file']['tmp_name'];

$path = "upload/" . $image_file;

if (empty($name)) {
    $errorMsg = "Please enter name";
} elseif (empty($image_file)) {
    $errorMsg = "Please Select Image";
} elseif ($type == "image/jpg" || $type == "image/jpeg" || $type == "image/png" || $type == "image/gif") // Check file extention
{
    if (!file_exists($path)) // Check file not exist in your upload folder path
    {
        if ($size < 5000000) // Check file size 5MB
        {
            move_uploaded_file($temp, "C:\wamp64\www\V1\upload/" . $image_file); // move upload file temperory directory to your upload folder
        } else {
            $errorMsg = "Your File is Too large Please Upload 5 mb Size"; // Error message file size not large than 5mb
        }
    } else {
        $errorMsg = "Your File already exists"; // Error message file size not large than 5mb
    }
} else {
    $errorMsg = "Upload JPG, JPEG, PNG & GIF Formate . . . . CHECK FILE EXTENSION"; // Error message file extension
}

$query = getPdo()->prepare('INSERT INTO post (contenu, publie, date_publication, FK_id_membre, image, name_image, private, public, protected) 
VALUES (:contenu, :publie, NOW(), :FK_id_membre, :image, :name_image, :private, :public, :protected)');


if ($query->execute([
    'contenu' => $name,
    'publie' => 1,
    'FK_id_membre' => $member->get('id_compte'),
    ':image' => $image_file,
    ':name_image' => $name,
    ':private' => $private,
    ':public' => $public,
    ':protected' => $protected
])) {

    // $friend = $_POST['pseudoFriend'];
    // $friendSelect = getPdo()->prepare('SELECT id_compte FROM compte WHERE pseudo="'.$friend.'"');
    // $friendSelect->execute();

    // $id_friend = $friendSelect->fetch();


    $querySelect = getPdo()->prepare("SELECT UUID_post from post WHERE FK_id_membre=:FK_id_membre ORDER BY UUID_post DESC LIMIT 0, 1");
    $querySelect->execute([
        'FK_id_membre' =>  $_SESSION['id_compte']
    ]);
    $id_post = $querySelect->fetch();
    $queryFav = getPdo()->prepare('INSERT INTO favoris (id_post, id_membre, favoris, plus_tard) 
    VALUES (:id_post, :id_membre, :favoris, :plus_tard)');
    $queryFav->execute([
        'id_post' => $id_post['UUID_post'],
        'id_membre' => $_SESSION['id_compte'],
        'favoris' => 0,
        'plus_tard' => 0,
    ]);
   
    $queryCate = getPdo()->prepare('INSERT INTO objet_categorie (FK_id_categorie, FK_id_post) 
VALUES (:FK_id_categorie, :FK_id_post)');
    //Requete insert pour protected_post

    //Execute l'insertion dans la table favoris
    $queryCate->execute([
        'FK_id_categorie' => $categorie,
        'FK_id_post' => $id_post['UUID_post'],

    ]);

    $insertMsg = "File Upload Successfully . . . . ."; // Execute query success message
    header("refresh:3;index.php?page=accueil"); // Refresh 3 second and redirect to index.php
}



?>

<div class="alert alert-info">Vous avez inserer un Post, redirection en cours.</div>