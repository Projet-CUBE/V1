<?php

$data = [
    'date' => $_GET['date'] ?? date('Y-m-d'),
    'start' => date('H:i'),
    'end' => date('H:i')
];
$validator = new eventValidator($data);
if(!$validator->validate('date', 'date')){
    $data['date'] = date('Y-m-d');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $errors = [];
    $validator = new eventValidator();
    $errors = $validator->validates($_POST);


    if (empty($errors)) {
        $event = $events->hydrate(new Event(), $data);
        $events = new events(getPdo());
        $events->create($event);
        header('Location: index.php?page=evenements&success=1&event=' . $data['date']);
        exit();
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../webroot/css/calendar.css">
    <title></title>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary mb-3">
        <a href="" class="navbar-brand">Mon calendrier</a>
    </nav>

    <div class="container">

        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                Merci de corriger vos erreurs
            </div>
        <?php endif; ?>

        <form action="" method="post" class="form">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Titre</label>
                        <input id="name" type="text" class="form-control" name="name" required value="<?= isset($data['name']) ? h($data['name']) : ''; ?>">

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input id="date" type="date" class="form-control" name="date" required value="<?= isset($data['date']) ? h($data['date']) : ''; ?>">

                    </div>
                </div>
            </div>

            <div class="row">


                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="start">Démarrage</label>
                        <input id="start" type="time" class="form-control" name="start" placeholder="HH:MM" value="<?= isset($data['start']) ? h($data['start']) : ''; ?>" required>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="end">Fin</label>
                        <input id="end" type="time" class="form-control" name="end" placeholder="HH:MM" value="<?= isset($data['end']) ? h($data['end']) : ''; ?>" required>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"><?= isset($data['description']) ? h($data['description']) : ''; ?></textarea>
            </div>
            <div class="form-goup">
                <button class="btn btn-primary">Ajouter l'évènement</button>
            </div>
        </form>
    </div>
</body>

</html>