<?php

if(array_key_exists('prenom', $_POST)) { 
    // $events->delete($event, $member); 
    $categorie->insertCategorie($_POST['prenom']);
    $prenom = true;
    header("refresh:3;index.php?page=insertCategories"); // Refresh 3 second and redirect to index.php

} 
if(array_key_exists('categorieSuppr', $_POST)) { 
  // $events->delete($event, $member); 
  $categorie->deleteCategorie($_POST['categorieSuppr']);
  $categorieSuppr = true;
  header("refresh:3;index.php?page=insertCategories"); // Refresh 3 second and redirect to index.php

} 
?>



<?php if (false === isset($prenom)): ?>
<form class="mb-3 needs-validation" action="index.php?page=insertCategories" method="POST"novalidate>
<div class="mb-3">
    <label for="validationCustom01" class="form-label">Categorie à ajouter.</label>
    <input type="text" name="prenom" id="prenom" class="form-control" id="validationCustom01">
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
<div class="col-12">
    <button class="btn btn-primary" type="submit">Categorie à ajouter.</button>
  </div>
</form>
<?php else: ?>
  <div class="alert alert-info">Categorie ajouté</div>
<?php endif; ?>

<?php if (false === isset($categorieSuppr)): ?>
<form class="mb-3 needs-validation" action="index.php?page=insertCategories" method="POST"novalidate>
  <label for="categorieSuppr">categories</label>
      <select name="categorieSuppr" id="categorieSuppr">
      <?php 
            foreach ($categorie->selectCategorie() as $id) :
                ?>
                <option value="<?= $id['id_categorie']?>"> 
                <?= $id['nom']?> 
                </option>
                <?php endforeach; ?>
      </select>

      <div class="col-12">
    <button class="btn btn-primary" type="submit">Categorie à Supprimer.</button>
  </div>
</form>
<?php else: ?>
  <div class="alert alert-info">Categorie Supprimé.</div>
<?php endif; ?>