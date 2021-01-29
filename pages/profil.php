<p>Bonjour <strong><?= $member->get('pseudo') ?></strong> !</p>
<p>Bonjour <strong><?= $member->get('id_compte') ?></strong> !</p>

<p>
Bonjour
    <?= $post->getPosts()?>
</p>

<!-- à décommenté si ont veut insert quelquechose
<p>
Bonjour
    < ?= $post->insertPosts()?>
</p> -->


<!-- à décommenté si ont veut update quelquechose
<p>
Bonjour
    < ?= $post->updatePosts()?>
</p> -->


<!-- à décommenté si ont veut delete quelquechose
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