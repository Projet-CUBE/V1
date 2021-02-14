<?php 

$droit->updateDroit($_POST['pseudo'], $_POST['statut']); 

echo "Vous avez passé " . $_POST['pseudo'] . " au statut de " . $_POST['statut'];
?>
