
<div class="alert alert-primary" role="alert">
Update du post
</div>

<?php 

$update = (int)$_POST['update'];

$result = getPdo()->prepare('SELECT * FROM post 
WHERE UUID_post = :UUID_post');

$result->execute([
    'UUID_post' => $update
]);




while ($row = $result->fetch()) {

    // https://stackoverflow.com/questions/10526475/how-to-get-row-id-in-button-click
    
    $UUID_post = $row['UUID_post'];

    $post = new post; //Variable member pour la vérification de connexion


    // Utilisation de this-> Sinon Uncaught error
    $pseudo = $post->pseudoo((int)$UUID_post); 
    
    print '<div class="row">';
        print '<div class="col-sm-6">';
            print '<div class="card">';//Vérifier si le post est privé ou public
                if($row['image']){
                    print '<img class="card-img-top" src="../upload/'.$row['image'].'" alt="Card image cap">';
                }
                print '<div class="card-body">'; 
                    print '<h5 class="card-title">' . $pseudo['pseudo'] . '</h5>';  
                    print '<p class="card-text">' . $row['contenu'] . '</p>';                        
                print '</div>';                          
            print '</div>';
        print '</div>'; 
    print '</div>';
}

?>

<form method="post" class="form-horizontal" enctype="multipart/form-data" action="index.php?page=updatePost">

<div class="form-group">
<label class="col-sm-3 control-label">Text</label>
    <div class="col-sm-6">
    <textarea type="text" name="txt_name" class="form-control" rows="3"></textarea>
    </div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label">File</label>
    <div class="col-sm-6">
    <input type="file" name="txt_file" class="form-control">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9 m-t-15">
        <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
        <?php print '<input name="idpost" type="hidden" value="'.$update.'" /> ';?>
        <a href="index.php" class="btn btn-danger">Cancel</a>
    </div>
</div>

</form>

</form>