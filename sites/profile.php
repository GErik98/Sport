<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION["user"])) {
    header("Location: index.php"); // Redirect to the main page if not logged in as an admin
    exit();
}

if ($_SESSION["user"]["role"]==='admin'){
    require('../menus/profile/admin_profile.php');
}elseif($_SESSION["user"]["role"]==='user'){
    require('../menus/profile/user_profile.php');
}elseif($_SESSION["user"]["role"]==='szervezo'){
    require('../menus/profile/organiser_profile.php');
}else{
    require('../index.php');
}
?>

