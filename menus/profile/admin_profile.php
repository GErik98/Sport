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
    <script src=".../js/hamburgermenu.js"></script>
</head>

<body>
    <div class="vertical-nav">
        <a href="../index.php">Home</a>
        <a class="menu-option" data-action="user_management">User Management</a>
        <a class="menu-option" data-action="event_management">Event Management</a>
        <a class="menu-option" data-action="contact_management">Contact Management</a>
        <a href="../index.php?logout">Logout</a>
        <!-- Add more menu options as needed -->
    </div>
    <div class="container">
        <h1>Welcome,
            <?php echo ucfirst($_SESSION["user"]["role"]); ?>
        </h1>
        <div id="content-container">
            <?php
            if (isset($_GET['message'])) {
                echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
            }
            ?>
        </div>
        <div id="user-action-container"></div>
</body>

</html>