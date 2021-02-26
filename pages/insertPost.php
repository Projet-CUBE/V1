<?php 


// https://www.onlyxcodes.com/2018/04/how-to-upload-insert-update-and-delete.html#New%20File%20Upload%20Codes%20Logic

$name = $_REQUEST['txt_name']; // TextBox name "txt_name"

$image_file = $_FILES['txt_file']['name'];
$type = $_FILES['txt_file']['type']; // file name "txt_file"
$size = $_FILES['txt_file']['size'];
$temp = $_FILES['txt_file']['tmp_name'];

$path = "upload/" . $image_file;

if (empty($name)) 
{
    $errorMsg = "Please enter name";
}
elseif (empty($image_file)) 
{
    $errorMsg = "Please Select Image";
}
elseif ($type == "image/jpg" || $type == "image/jpeg" || $type == "image/png" || $type == "image/gif") // Check file extention
{
    if (!file_exists($path)) // Check file not exist in your upload folder path
    {
        if ($size < 5000000) // Check file size 5MB
        {
            move_uploaded_file($temp, "C:\wamp64\www\V1\upload/" . $image_file); // move upload file temperory directory to your upload folder
        }
        else 
        {
            $errorMsg = "Your File is Too large Please Upload 5 mb Size"; // Error message file size not large than 5mb
        }
    }
    else 
    {
        $errorMsg = "Your File already exists"; // Error message file size not large than 5mb
    }
}
else 
{
    $errorMsg = "Upload JPG, JPEG, PNG & GIF Formate . . . . CHECK FILE EXTENSION"; // Error message file extension
}

$query = getPdo()->prepare('INSERT INTO post (contenu, publie, date_publication, FK_id_membre, image, name_image) 
VALUES (:contenu, :publie, NOW(), :FK_id_membre, :image, :name_image)');

if ($query->execute([
    'contenu' => $name,
    'publie' => 1,
    'FK_id_membre' => $member->get('id_compte'),
    ':image' => $image_file,
    ':name_image' => $name
    ])) 
{
    $insertMsg = "File Upload Successfully . . . . ."; // Execute query success message
    header("refresh:3;index.php?page=accueil"); // Refresh 3 second and redirect to index.php
}

?>

<div class="alert alert-info">Vous avez inserer un Post, redirection en cours.</div>
