<?php 

// echo $_POST['commentaire']; 


$commentaire->getPoste((int)$_POST['commentaire']);

$commentaire->getCommentaires((int)$_POST['commentaire']);


// header("refresh:3;index.php?page=accueil"); // Refresh 3 second and redirect to index.php


print '<form method="post" class="form-horizontal" enctype="multipart/form-data" action="index.php?page=insertCommentaire">';

print '<div class="form-group">';
print '<label class="col-sm-3 control-label">Commentaire</label>';
print '<div class="col-sm-6">';
print '<textarea type="text" name="txt_name" class="form-control" rows="3"></textarea>';
print '</div>';
print '</div>';

print '<div class="form-group">';
print '<div class="col-sm-offset-3 col-sm-9 m-t-15">';
print '<input name="idpost" type="hidden" value="'.$_POST['commentaire'].'" /> ';
print '<input type="submit" name="btn_insert" class="btn btn-success" value="Insert">';
print '<a href="index.php?page=accueil" class="btn btn-danger">Cancel</a>';
print '</div>';
print '</div>';

print '</form>';

?>