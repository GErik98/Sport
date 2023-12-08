<!-- load_content.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Your Page</title>
    <!-- Include jQuery on this specific page -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="dashboard.js"></script>
</head>
<?php
// load_content.php
session_start();
require_once("../dbconnect.php");
$action = $_GET['action'];
// Retrieve users
$sqlUsers = "SELECT id, username, role FROM felhasznalo WHERE role <> 'admin'";
$queryUsers = $connDB->query($sqlUsers);
$users = $queryUsers->fetchAll(PDO::FETCH_ASSOC);

// Retrieve events
$sqlEvents = "SELECT id, nev, sportag, datetime FROM esemeny";
$queryEvents = $connDB->query($sqlEvents);
$events = $queryEvents->fetchAll(PDO::FETCH_ASSOC);

// Retrive contacts
$sqlContacts = "SELECT id, name, email, message, submission_date FROM contacts";
$queryContacts = $connDB->query($sqlContacts);
$contacts = $queryContacts->fetchAll(PDO::FETCH_ASSOC);

if ($action === 'user_management') {
    // Simulate loading user management content
    ?>
    <h2>Users:</h2>
    <p><b>Változatáskor minden adatot ki kell tölteni!</b></p> <!--különben csak nulláza a ki nem töltött adatokat xd-->
    Név: | Szerep:
    <?php
    ob_start(); // Start output buffering
    ?>
    <ul>
        <?php foreach ($users as $user): ?>
            <li class="user-row">
                <div class='user-info'>
                    <?php echo ucfirst($user["username"]) . "\n";
                    echo "| " . $user["role"]; ?>
                </div>
                <div class="management-options">
                    <a href="#" class="management-option" data-action="modify" data-userid="<?php echo $user["id"]; ?>">
                        <i class="fas fa-edit"></i> Modify
                    </a>
                    <a href="#" class="management-option" data-action="ban" data-userid="<?php echo $user["id"]; ?>">
                        <i class="fas fa-ban"></i> Ban
                    </a>
                    <a href="#" class="management-option" data-action="delete" data-userid="<?php echo $user["id"]; ?>">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
    $loadedContent = "<div class='content-container'>" . ob_get_clean() . "</div>  "; // Get the output buffer and clean it

    // Now $loadedContent contains the entire HTML block with management options
} elseif ($action === 'event_management') {
    if ($_SESSION["user"]["role"] !== 'user') {
        ?>
        <a href="#" class="management-option" data-action="addEvent"><button>Add Event</button></a>
        <h2>Events:</h2>
        <input type="text" id="eventSearch" placeholder="Search events">
        <?php
        ob_start(); // Start output buffering
        ?>
        <?php
        $categories = ["foci", "f1", "tenisz"];
        foreach ($categories as $category):
            ?>
            <h4>
                <?php echo ucfirst($category); ?>:
            </h4>
            <ul>
                <?php foreach ($events as $event): ?>
                    <?php if ($event["sportag"] === $category): ?>
                        <li>
                            <?php echo $event["nev"]; ?> -
                            <?php echo $event["datetime"]; ?> <a href="#" class="management-option" data-action="remove"
                                data-userid="<?php echo $user["id"]; ?>" data-eventid="<?php echo $event['id']; ?>">
                                <i class="fas fa-trash"></i>
                            </a><a href="#" class="management-option" data-action="info" data-userid="<?php echo $user["id"]; ?>"
                                data-eventid="<?php echo $event['id']; ?>">
                                <i class="fa-solid fa-info"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

        <?php endforeach;

        $loadedContent = "<div class='content-container'>" . ob_get_clean() . "</div>  "; // Get the output buffer and clean it
    } else {
        ?>
        <h2>Events:</h2>
        <div class="searchbox" style="margin: 10px 10px 10px 0px;">
            <label for="searchEvent">Search Event</label>
            <input type="text" id="searchEvent" name="searchEvent">
            <button type="submit" id="submitSearch" name="submitSearch" value="submitSearch">Search</button>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Handle event search
            if (isset($_POST['submitSearch'])) {
                try {
                    $searchEventName = isset($_POST['searchEvent']) ? $_POST['searchEvent'] : '';

                    // Use a prepared statement to prevent SQL injection
                    $searchQuery = $connDB->prepare("SELECT * FROM esemeny WHERE nev LIKE :searchEventName");
                    $searchQuery->bindValue(':searchEventName', "%$searchEventName%", PDO::PARAM_STR);
                    $searchQuery->execute();

                    $searchResults = $searchQuery->fetchAll(PDO::FETCH_ASSOC);

                    // Display search results
                    echo "<h2>Search Results</h2>";
                    echo "<ul>";
                    foreach ($searchResults as $result) {
                        echo "<li>ID: {$result['id']} - Name: {$result['nev']} - Sport: {$result['sportag']} - Type: {$result['tipus']} - Date: {$result['datetime']}</li>";
                    }
                    echo "</ul>";
                } catch (PDOException $e) {
                    $error = 'Database error: ' . $e->getMessage();
                }
            }
        }


        ob_start(); // Start output buffering
        ?>
        <?php
        $categories = ["foci", "f1", "tenisz"];
        foreach ($categories as $category):
            ?>
            <h4>
                <?php echo ucfirst($category); ?>:
            </h4>
            <ul>
                <?php foreach ($events as $event): ?>
                    <?php if ($event["sportag"] === $category): ?>
                        <li>
                            <?php echo $event["nev"]; ?> -
                            <?php echo $event["datetime"]; ?> <a href="#" class="management-option" data-action="enter"
                                data-userid="<?php echo $user["id"]; ?>" data-eventid="<?php echo $event['id']; ?>">
                                <i class="fa-solid fa-right-to-bracket"></i> Join
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

        <?php endforeach;

        $loadedContent = "<div class='content-container'>" . ob_get_clean() . "</div>  "; // Get the output buffer and clean it
    }
} elseif ($action === 'contact_management') { ?>
    <?php ob_start(); ?>
    <div class="comments-section">
        <h2>Messages</h2>
        <?php foreach ($contacts as $contact): ?>
            <div class="comment">
                <div class="comment-header">
                    <span class="comment-author">
                        <?php echo ucfirst($contact["name"]); ?>
                    </span>
                    <span class="comment-email">
                        <?php echo $contact["email"]; ?>
                    </span>
                    <span class="comment-date">
                        <?php echo "Date: " . $contact["submission_date"]; ?>
                    </span>
                </div>
                <p class="comment-content">
                    <?php echo $contact["message"]; ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
    <?php $loadedContent = ob_get_clean();
} elseif ($action === 'profile_settings') {
    ob_start();
    $userId = $_SESSION['user']['id'];

    $queryUser = $connDB->prepare('SELECT id, username, password FROM felhasznalo WHERE id = :userId');
    $queryUser->bindParam(':userId', $userId, PDO::PARAM_INT);
    $queryUser->execute();

    $userData = $queryUser->fetch(PDO::FETCH_ASSOC);

    if ($userData) { ?>
        <?php echo ucfirst($userData["username"]) . "\n";
        echo "| " . $userData["id"]; ?>
        <span class="management-options">
            <a href="#" class="management-option" data-action="modify" data-userid="<?php echo $userData["id"]; ?>">
                <i class="fas fa-edit"></i> Modify
            </a>
            <a href="#" class="management-option" data-action="delete" data-userid="<?php echo $userData["id"]; ?>">
                <i class="fas fa-trash"></i> Delete
            </a>
        </span>
        <?php
    } else {
        echo 'User not found.';
    }

    $loadedContent = ob_get_clean();
}

// Return the content
echo $loadedContent;

?>