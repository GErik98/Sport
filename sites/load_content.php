<!-- load_content.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page</title>
    <!-- Include jQuery on this specific page -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="dashboard.js"></script>
</head>
<?php
// load_content.php
require_once("../dbconnect.php");

$action = $_GET['action'];
// Retrieve users
$sqlUsers = "SELECT id, username, role FROM felhasznalo";
$queryUsers = $connDB->query($sqlUsers);
$users = $queryUsers->fetchAll(PDO::FETCH_ASSOC);

// Retrieve events
$sqlEvents = "SELECT id, nev, sportag, datetime FROM rendezveny";
$queryEvents = $connDB->query($sqlEvents);
$events = $queryEvents->fetchAll(PDO::FETCH_ASSOC);

// Retrive contacts
$sqlContacts = "SELECT id, name, email, message, submission_date FROM contacts";
$queryContacts = $connDB->query($sqlContacts);
$contacts = $queryContacts->fetchAll(PDO::FETCH_ASSOC);

if ($action === 'user_management') {
    // Simulate loading user management content
    ob_start(); // Start output buffering
    ?>
    <h2>Users:</h2>
    <ul>
        <p>Változatáskor minden adatot ki kell tölteni!</p> <!--különben csak nulláza a ki nem töltött adatokat xd-->
        <li>Név: | Szerep: </li>
        <?php foreach ($users as $user) : ?>
            <li>
    <?php echo ucfirst($user["username"])."\n"; echo "| ".$user["role"]; ?>
    <span class="management-options">
    <a href="#" class="management-option" data-action="modify" data-userid="<?php echo $user["id"]; ?>">
        <i class="fas fa-edit"></i> Modify
    </a>
        <a href="#" class="management-option" data-action="ban" data-userid="<?php echo $user["id"]; ?>">
            <i class="fas fa-ban"></i> Ban
        </a>
        <a href="#" class="management-option" data-action="delete" data-userid="<?php echo $user["id"]; ?>">
            <i class="fas fa-trash"></i> Delete
        </a>
    </span>
</li>
        <?php endforeach; ?>
    </ul>
    <?php
    $loadedContent = ob_get_clean(); // Get the output buffer and clean it

    // Now $loadedContent contains the entire HTML block with management options
} elseif ($action === 'event_management') {
    ob_start(); // Start output buffering
    ?>
    <h2>Events:</h2>
    <h3>Categories</h3>
    <?php
    $categories = ["foci", "f1", "tenisz"];
    foreach ($categories as $category) :
    ?>
        <h4><?php echo ucfirst($category); ?>:</h4>
        <ul>
            <?php foreach ($events as $event) : ?>
                <?php if ($event["sportag"] === $category) : ?>
                    <li><?php echo $event["nev"]; ?> - <?php echo $event["datetime"]; ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    <?php endforeach;

    $loadedContent = ob_get_clean(); // Get the output buffer and clean it
} elseif ($action === 'contact_management'){
    ob_start();
    ?>
    <h2>Messages</h2>
    <?php
    foreach ($contacts as $contact) :
        ?>
        <h4><?php echo ucfirst($contact["name"]); ?>:</h4>
<ul>
        <li><?php echo $contact["message"]; ?> --- <?php echo "date:".$contact["submission_date"]; ?></li>
        <?php endforeach; ?>
</ul>
<?php
$loadedContent = ob_get_clean();
}

// Return the content
echo $loadedContent;

?>
