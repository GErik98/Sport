<?php
require('dbconnect.php');

$sqlEvents = "SELECT id, nev, sportag, datetime FROM esemeny";
$queryEvents = $connDB->query($sqlEvents);
$events = $queryEvents->fetchAll(PDO::FETCH_ASSOC);
?>
        <ul>
            <?php foreach ($events as $event) : ?>
                    <li><?php echo $event["nev"]; ?> - <?php echo $event["datetime"]; ?></li>
            <?php endforeach; ?>
        </ul>
