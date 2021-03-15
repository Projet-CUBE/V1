<?php


// Le formulaire a été soumis
if (isset($_POST['pseudo']) && isset($_POST['email']))
{
    // Vérif pseudo : il n'est pas vide
    if (empty($_POST['pseudo'])) {
        $errors->set('pseudo', "Le pseudo est obligatoire");
    }
    // Vérif pseudo : il n'est pas déjà pris
    else if (Member::pseudoIsAlreadyTaken($_POST['pseudo'])) {
        $errors->set('pseudo', "Ce pseudo est déjà utilisé");
        $form->set('pseudo', $_POST['pseudo']);
    }

    // Vérif email : il n'est pas vide
    if (empty($_POST['email'])) {
        $errors->set('email', "L'email est obligatoire");
    }
    // Vérif email : il n'est pas déjà pris
    else if (Member::emailIsAlreadyTaken($_POST['email'])) {
        $errors->set('email', "Cet email est déjà utilisé");
        $form->set('email', $_POST['email']);
    }
    // Vérif email : il est au bon format
    else if (false == preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
        $errors->set('email', "L'email n'est pas au bon format");
        $form->set('email', $_POST['email']);
    }

    // Vérif password : il n'est pas vide
    if (empty($_POST['password'])) {
        $errors->set('password', "Le mot de passe est obligatoire");
    }

    // Aucune erreur dans notre formulaire,
    // on crée le membre en BDD
    $query = getPdo()->prepare('UPDATE compte 
    SET pseudo = :pseudo, prenom = :prenom, nom = :nom, password = :password, email = :email
    WHERE id_compte = :id_compte');

    $query->execute([
        'pseudo' => $_POST['pseudo'],
        'prenom' => $_POST['prenom'], 
        'nom' => $_POST['nom'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'email' => $_POST['email'],
        'id_compte' => $_SESSION['id_compte']
    ]);
}



function GetInfos($i)
{
  $query = getPdo()->prepare('SELECT * FROM compte WHERE id_compte = :id_compte LIMIT 1');
  $query->execute([
    'id_compte' => $_SESSION['id_compte']
  ]); 
 
  switch ($i) {
    case 0:
      while ($row = $query->fetch()) {
        echo $row['pseudo'];
      }
        break;
    case 1:
      while ($row = $query->fetch()) {
        echo $row['prenom'];
      }
        break;
    case 2:
      while ($row = $query->fetch()) {
        echo $row['nom'];
      }
        break;
      case 3:
      while ($row = $query->fetch()) {
        echo $row['password'];
      }
        break;
      case 4:
      while ($row = $query->fetch()) {
        echo $row['email'];
      }
        break;
  }
}

?>
<form class="mb-3 needs-validation" action="index.php?page=profil" method="POST"novalidate>

  <div class="mb-3">
    <label for="validationCustom01" class="form-label">First name</label>
    <input type="text" name="prenom" id="prenom" class="form-control" id="validationCustom01" value="<?php GetInfos(1)?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="mb-3">
    <label for="validationCustom02" class="form-label">Last name</label>
    <input type="text" name="nom" id="nom" class="form-control" id="validationCustom02" value="<?php GetInfos(2)?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="mb-3">
    <label for="validationCustomUsername" class="form-label">Username</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend">@</span>
      <input type="text" name="pseudo" id="pseudo" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php GetInfos(0)?>" required>
      <div class="invalid-feedback">
        Please choose a username.
      </div>
    </div>
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" id="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php GetInfos(4)?>">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  
  <div class="mb-3">
    <div class="form-group">
      <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control" required>
          <?php if ($errors->has('password')): ?>
              <p class="text-danger"><?= $errors->get('password') ?></p>
          <?php endif; ?>
    </div>
  </div>

  <div class="col-12">
    <button class="btn btn-primary" type="submit">Submit form</button>
  </div>
  
</form>