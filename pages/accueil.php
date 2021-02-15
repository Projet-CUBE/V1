<p>Bonjour <strong><?= $member->get('pseudo') ?></strong> !</p>
<p>Id compte: <strong><?= $member->get('id_compte') ?></strong> !</p>

<p>
Bonjour
    <?= $post->getPosts()?>
</p>

<p>Favoris :
    <?= $favoris->getFavoris()?>
    <!-- à décommenter pour update favoris)
    < ?= $post->updateFavoris()?>
    -->
</p>

<?= $post->getPostsCard()?>

<p>Later :
    <?= $later->getLater()?>
    <!-- à décommenter pour update le champ à regarder à plus tard)
    < ?= $post->updateLater()?>
    -->
</p>

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

<form method="post" class="form-horizontal" enctype="multipart/form-data" action="index.php?page=insertPost">

    <div class="form-group">
    <label class="col-sm-3 control-label">Text</label>
        <div class="col-sm-6">
        <!-- <input type="text" name="txt_name" class="form-control"/> -->
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
            <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
    </div>

</form>
