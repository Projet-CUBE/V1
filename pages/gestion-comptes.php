
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
      <?= 
            $max = sizeof($droit->getDroit());
            for($i = 0; $i < $max;$i++)
            {
                ?>
                <option value="<?= $droit->getDroit()[$i]?>"> 
                <?= $droit->getDroit()[$i] ?> 
                </option>
                <?php } ?>
      </select>
   </p>
   
   <p>
   <button type="submit" >Update des droits</button>
   </p>

</form>