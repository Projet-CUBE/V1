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
   $month = new month($_GET['month'] ?? null, $_GET['year'] ?? null);
   $start = $month->getStartingDay();
   $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
   $weeks = $month->getWeeks();
   $end = (clone $start)->modify('+' . (6 + 7 * ($weeks - 1)) . 'days');
   $events = $events->getEventsBetweenByDay($start, $end);
   $event = $start->format('d/m/Y');
   ?>


   <div class="calendar">

      <?php if (isset($_GET['success'])) : ?>
            <div class="container">
               <div class="alert alert-success">
                  L'évènement a bien été ajouté au <?= (new DateTime($_GET['event']))->format('d/m/Y'); ?>
               </div>
            </div>
      <?php endif; ?>

      <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
         <h1><?= $month->toString(); ?></h1>
         <div>
            <a href="index.php?page=evenements&month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt;</a>
            <a href="index.php?page=evenements&month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-primary">&gt;</a>
         </div>
      </div>



      <table class="calendar__table calendar__table--<?= $weeks ?>weeks">
         <?php for ($i = 0; $i < $weeks; $i++) : ?>
            <tr>
               <?php
               foreach ($month->days as $k => $day) :
                  $date = (clone $start)->modify("+" . ($k + $i * 7) . "days");
                  $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                  $isToday = date('Y-m-d') === $date ->format('Y-m-d');
               ?>
                  <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth', $isToday ? 'is-today' : ''; ?>">
                     <?php if ($i === 0) : ?>
                        <div class="calendar__weekday"><?= $day; ?></div>
                     <?php endif; ?>
                     <a class="calendar__day" href="index.php?page=add_event&date=<?= $date->format('Y-m-d'); ?>"><?= $date->format('d'); ?></a>
                     <?php foreach ($eventsForDay as $event) : ?>
                        <div class="calendar__event">
                           <?= (new Datetime($event['start']))->format('H:i')  ?> - <a href="index.php?page=edit_event&id=<?= $event['id']; ?>"><?= h($event['name']); ?></a>
                        </div>
                     <?php endforeach; ?>
                  </td>
               <?php endforeach; ?>
            </tr>
         <?php endfor; ?>
      </table>


      <a href="index.php?page=add_event" class="calendar__button">+</a>
   </div>
</body>

</html>