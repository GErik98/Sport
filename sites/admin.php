<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin") {
    header("Location: index.php"); // Redirect to the main page if not logged in as an admin
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['no'])) {
        // Handle 'No' button click (do nothing or refresh the page)
        header("Location: admin.php");  // Redirect to the admin page or refresh as needed
        exit();
    } elseif (isset($_POST['yes'])) {
        // Handle 'Yes' button click (perform the ban operation)
        // Update the database to set the user's role to 'banned' or perform any other necessary actions
        $userId = $_POST['userId'];
        // Perform the necessary database update
        // ...

        header("Location: admin.php");  // Redirect to the admin page after processing
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <title>Admin Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="dashboard.js"></script>
</head>

<body>

<div class="vertical-nav">
<ul>
    <li class="menu-option" data-action="user_management">User Management</li>
    <li class="menu-option" data-action="event_management">Event Management</li>
    <a href="../index.php?logout">Logout</a>
    <!-- Add more menu options as needed -->
</ul>
</div>
<div class="container">
    <h1>Welcome, <?php echo $_SESSION["user"]["username"]; ?> (Admin)</h1>
    <div id="content-container"></div>
    <div id="user-action-container"></div>
</body>

</html>
