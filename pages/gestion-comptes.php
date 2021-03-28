<?php

if (array_key_exists('BanHammer', $_POST)) {
   // $events->delete($event, $member);
   $droit = new droit();
   $droit->banHammer($_POST['pseudo']);
   header('Location: index.php?page=accueil');
}

?>


<form action="index.php?page=comptes-changer" method="post">
   <p>
      <label for="pseudo">pseudo</label>
      <select name="pseudo" id="pseudo">
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
    </p>

    <p>
    <label for="statut">statut</label>
      <select name="statut" id="statut">
      <?php 
            foreach ($droit->getDroit() as $id) :
                ?>
                <option value="<?= $id['id_droits']?>"> 
                <?= $id['statut']?> 
                </option>
                <?php endforeach; ?>
      </select>
   </p>
   
   <p>
   <button class="btn btn-primary" type="submit" >Update des droits</button>
   </p>

</form>
<div>
<form action="" method="post">

      <label for="pseudo">pseudo à banir</label>
      <select name="pseudo" id="pseudo">
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
    </p>   

   <button class="btn btn-danger" type="submit" name="BanHammer" >Ban Hammer</button>
   </p>

</form>
</div>