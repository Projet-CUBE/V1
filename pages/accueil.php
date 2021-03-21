<!-- <p>
Bonjour
    < ?= $post->getPosts()?>
</p>

<p>Favoris :
    < ?= $favoris->getFavoris()?>
    < !-- à décommenter pour update favoris)
    < ?= $post->updateFavoris()?>
    
</p>
-->
<form action="index.php?page=accueil" method="post">
   <p>
      <label for="categorie">categories</label>
      <select name="categorie" id="categorie">
      <?php 
            foreach ($categorie->selectCategorie() as $id) :
                ?>
                <option value="<?= $id['id_categorie']?>"> 
                <?= $id['nom']?> 
                </option>
                <?php endforeach; ?>
      </select>
    </p>

   <p>
   <button class="btn btn-primary" type="submit" >Categories</button>
   </p>

</form>


<?php
//var_dump($_POST['categorie']);
if (isset($_POST['categorie'])) 
{
    $post->getPostsCard((int)$_POST['categorie']);
}
else {
    $post->getPostsCard(3);
}

?>
<!-- <p>Later :
    < ?= $later->getLater()?>
    < !-- à décommenter pour update le champ à regarder à plus tard)
    < ?= $post->updateLater()?>

</p> -->

<!-- à décommenté si ont veut créer un post
<p>
Bonjour
    < ?= $post->insertPosts()?>
</p> -->


<!-- à décommenté si ont veut update un post
<p>
Bonjour
    < ?= $post->updatePosts()?>
</p> -->


<!-- à décommenté si ont veut delete un post
<p>
Bonjour
    < ?=$post->deletePosts()?>
</p> -->

<!-- à décommenté si ont veut insert un Commentaire 
<p>
Bonjour
    < ?= $commentaire->insertCommentaire(1 ,$member->get('pseudo')) ?>
</p> 
-->

<!-- à décommenté si ont veut insert categorie
<p>
Bonjour
    < ?= $categorie->insertCategorie()?>
</p> -->


<!-- à décommenté si ont veut update categorie
<p>
Bonjour
    < ?= $categorie->updateCategorie()?>
</p> -->


<!-- à décommenté si ont veut delete categorie
<p>
Bonjour
    < ?=$categorie->deleteCategorie()?>
</p> -->

<!-- à décommenté si ont veut Bannir ou unBan un membre
<p>
Bonjour
    < ?=$member->setBan()?>
</p> -->

<!-- à décommenté si ont veut ajouter un droit à un membre
<p>
Bonjour
    < ?=$droit->insertDroit()?>
</p> -->

<!-- à décommenté si ont veut ajouter un droit à un membre
<p>
Bonjour
    < ?=$droit->getDroit()?>
</p> -->

<!-- à décommenté si ont veut Update un droit à un membre
<p>
Bonjour
    < ?=$droit->updateDroit()?>
</p> -->


<!-- <form action="index.php?page=commentaire" method="post">

    <div class="input-group mb-3">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="File" name="File">
            <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
        </div>
    </div>

    <div class="form-group">
        <label for="Textarea">Text du post</label>
        <textarea class="form-control" id="Textarea" name="Textarea" rows="3"></textarea>
    </div>

    <div>
        <input name="commentaire" type="hidden"/> 
        <input type="submit" value="Poster" /> 
    </div>
</form> -->

<?php if($member->isLogged()): ?>
    <form method="post" class="form-horizontal" enctype="multipart/form-data" action="index.php?page=insertPost">

        <div class="form-group">
        <label class="col-sm-3 control-label">Text</label>
            <div class="col-sm-6">
            <textarea type="text" name="txt_name" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <!--Ajout de fichier-->
        <div class="form-group">
        <label class="col-sm-3 control-label">File</label>
            <div class="col-sm-6">
            <input type="file" name="txt_file" class="form-control">
            </div>
        </div>

        <!--Bouton radio pour le choix de protection du post-->
        <div class="form-check">
            <input class="form-check-input" type="radio" name="protection" id="publicRadio" value='public' checked="checked">
            <label class="form-check-label" for="publicRadio">
                Public
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="protection" id="privateRadio" value='private'>
            <label class="form-check-label" for="privateRadio">
                Privé
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="protection" id="protectedRadio" value='protected'>
            <label class="form-check-label" for="protectedRadio">
                Protegé
            </label>
            <label for="pseudoFriend">pseudo</label>
            <select name="pseudoFriend" id="pseudoFriend">
                <?php 
                    $max = sizeof($droit->getPseudo());
                    for($i = 0; $i < $max;$i++)
                    {
                        ?>
                        <option value="<?= $droit->getPseudo()[$i]?>"> 
                        <?= $droit->getPseudo()[$i] ?> 
                        </option>
                <?php } ?>
        </select>
        </div>

        <!--Ajout + annulé-->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </div>
        <label for="categorie">categories</label>
      <select name="categorie" id="categorie">
      <?php 
            foreach ($categorie->selectCategorie() as $id) :
                ?>
                <option value="<?= $id['id_categorie']?>"> 
                <?= $id['nom']?> 
                </option>
                <?php endforeach; ?>
      </select>
    </form>
<?php endif; ?>