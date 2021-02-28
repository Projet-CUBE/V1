<!DOCTYPE html>
<html lang="en">

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

    <?php
    $events = new events();
    if (!isset($_GET['id'])) {
        header('location: index.php?page=404');
    }
    try {
        $event = $events->find($_GET['id']);
    } catch (Exception $e) {
        e404();
    }

    ?>

    <h1><?= h($event->getName()); ?></h1>
    <ul>
        <li>Date: <?= $event->convertDateTime(0)->format('d/m/Y'); ?></li>
        <li>Heure de démarrage: <?= $event->convertDateTime(0)->format('H:i'); ?></li>
        <li>Heure de fin: <?= $event->convertDateTime(1)->format('H:i'); ?></li>
        <li>Description:<br>
            <?= h($event->getDescription()); ?></li>
    </ul>
</body>

</html>