<?php 

$droit->updateDroit($_POST['pseudo'], $_POST['statut']); 

echo " " . $_POST['pseudo'] . " au statut de " . $_POST['statut'];
?>

<div class="alert alert-info">
Vous avez passé <?= $_POST['pseudo'] ?>
</div>
