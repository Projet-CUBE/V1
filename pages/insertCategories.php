<?php

if(array_key_exists('prenom', $_POST)) { 
    // $events->delete($event, $member); 
    $categorie->insertCategorie($_POST['prenom']);
} 
?>

<form class="mb-3 needs-validation" action="index.php?page=insertCategories" method="POST"novalidate>

<div class="mb-3">
    <label for="validationCustom01" class="form-label">Categorie à ajouter</label>
    <input type="text" name="prenom" id="prenom" class="form-control" id="validationCustom01">
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  
<div class="col-12">
    <button class="btn btn-primary" type="submit">Submit form</button>
  </div>
</form>