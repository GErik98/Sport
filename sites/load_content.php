<?php
// load_content.php
require_once("../dbconnect.php");

// Retrieve users
$sqlUsers = "SELECT id, username FROM felhasznalo";
$queryUsers = $connDB->query($sqlUsers);
$users = $queryUsers->fetchAll(PDO::FETCH_ASSOC);

// Retrieve events
$sqlEvents = "SELECT id, nev, sportag, datetime FROM rendezveny";
$queryEvents = $connDB->query($sqlEvents);
$events = $queryEvents->fetchAll(PDO::FETCH_ASSOC);
$action = $_GET['action'];

if ($action === 'user_management') {
    // Simulate loading user management content
    ob_start(); // Start output buffering
    ?>
    <h2>Users:</h2>
    <ul>
        <?php foreach ($users as $user) : ?>
            <li>
    <?php echo $user["username"]; ?>
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
} //elseif ($action === 'contact_management'){}

// Return the content
echo $loadedContent;
?>
