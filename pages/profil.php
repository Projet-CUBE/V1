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

<!-- à décommenté si ont veut insert un droit à un membre
<p>
Bonjour
    < ?=$droit->insertDroit()?>
</p> -->

<!-- à décommenté si ont veut Update un droit à un membre
<p>
Bonjour
    < ?=$droit->updateDroit()?>
</p> -->