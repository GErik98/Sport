<?php
require('dbconnect.php');

$sqlEvents = "SELECT id, nev, sportag, datetime FROM esemeny";
$queryEvents = $connDB->query($sqlEvents);
$events = $queryEvents->fetchAll(PDO::FETCH_ASSOC);

$sqlEvents2 = "SELECT felhasznalo.username, esemeny.nev
FROM event_users
JOIN felhasznalo ON event_users.user_id = felhasznalo.id
JOIN esemeny ON event_users.event_id = esemeny.id
WHERE event_users.event_id = 1;";
$queryEvents2 = $connDB->query($sqlEvents2); // Fix: Use $sqlEvents2 here
$events2 = $queryEvents2->fetchAll(PDO::FETCH_ASSOC); // Fix: Use $queryEvents2 here
?>
<h4>Actual Events</h4>
<ul>
        <?php foreach ($events as $event) : ?>
                <li><?php echo $event["nev"]; ?> - <?php echo $event["datetime"]; ?></li>
        <?php endforeach; ?>
        <hr>
        <?php foreach ($events2 as $event2) : ?>
                <li><?php echo $event2["username"]; ?> - <?php echo $event2["nev"]; ?></li>
        <?php endforeach; ?>
</ul>