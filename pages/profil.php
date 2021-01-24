<p>Bonjour <strong><?= $member->get('pseudo') ?></strong> !</p>
<p>Bonjour <strong><?= $member->get('id_compte') ?></strong> !</p>

<p>
Bonjour
    <?= $post->getPosts()?>
</p>

<!-- à décommenté si ont veut insert quelquechose
 
<p>
Bonjour
    <?= $post->insertPosts()?>
</p> -->