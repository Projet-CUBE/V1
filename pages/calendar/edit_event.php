<?php

$pdo = getPdo();
$events = new events();
$errors = [];
if (!isset($_GET['id'])) {
    e404();
}
try {
    $event = $events->find($_GET['id'] ?? null);
} catch (Exception $e) {
    e404();
} catch (Error $e) {
    e404();
}

$data = [
    'name' => $event->getName(),
    'date' => $event->convertDateTime(0)->format('Y-m-d'),
    'start' => $event->convertDateTime(0)->format('H:i'),
    'end' => $event->convertDateTime(1)->format('H:i'),
    'description' => $event->getDescription()
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $errors = [];
    $validator = new eventValidator();
    $errors = $validator->validates($data);

    if (empty($errors)) {
        $events->hydrate($event, $data, $member);
        $events->update($event, $member);
        header('Location: index.php?page=evenements&success=1&event=' . $data['date']);
        exit();
    }
}
echo ('On regarde ce qu\'on a dans member');
echo ('<br>');
echo ('Id du compte');
bug($member);
bug($event);

?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../webroot/css/calendar.css">
    <title><?= isset($event) ? h($event->getName()) : 'Mon Calendrier'; ?></title>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary mb-3">
        <a href="" class="navbar-brand">Mon calendrier</a>
    </nav>



    <h1>Editer l'évènement <small><?= h($event->getName()); ?></small></h1>
    <div class="container">

        <form action="" method="post" class="form">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Titre</label>
                        <input id="name" type="text" class="form-control" name="name" required value="<?= isset($data['name']) ? h($data['name']) : ''; ?>">
                        <?php if (isset($errors['name'])) : ?>
                            <small class="form-text text-muted"><?= $errors['name']; ?></small>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input id="date" type="date" class="form-control" name="date" required value="<?= isset($data['date']) ? h($data['date']) : ''; ?>">
                        <?php if (isset($errors['date'])) : ?>
                            <small class="form-text text-muted"><?= $errors['date']; ?></small>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="row">


                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="start">Démarrage</label>
                        <input id="start" type="time" class="form-control" name="start" placeholder="HH:MM" value="<?= isset($data['start']) ? h($data['start']) : ''; ?>" required>
                        <?php if (isset($errors['start'])) : ?>
                            <small class="form-text text-muted"><?= $errors['start']; ?></small>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="end">Fin</label>
                        <input id="end" type="time" class="form-control" name="end" placeholder="HH:MM" value="<?= isset($data['end']) ? h($data['end']) : ''; ?>" required>
                        <?php if (isset($errors['end'])) : ?>
                            <small class="form-text text-muted"><?= $errors['end']; ?></small>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"><?= isset($data['description']) ? h($data['description']) : ''; ?></textarea>
            </div>
            <div class="form-goup">
                <button class="btn btn-primary">Modifier l'évènement</button>
                <button class="btn btn-danger" onclick="<?php $events->delete($event, $member); ?>">Supprimer l'évènement</button>
            </div>
        </form>
    </div>
</body>

</html>