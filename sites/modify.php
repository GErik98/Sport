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
session_start();
$error = "";
$msg = "";
require_once("../dbconnect.php");

if (isset($_POST['submitSet'])) {
    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
    if (isset($_POST["username"])) {
        try {
            $newUsername = $_POST["username"];
            $newnameQuery = $connDB->prepare("UPDATE felhasznalo SET username = :newUsername WHERE id = :userId");
            $newnameQuery->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
            $newnameQuery->bindParam(':userId', $userId, PDO::PARAM_INT);
            $newnameQuery->execute();

            if ($newnameQuery->rowCount() > 0) {
                echo '<p>Username updated successfully for User ID: ' . $userId . '</p>';
            } else {
                echo '<p>Username update failed for User ID: ' . $userId . '</p>';
            }
        } catch (PDOException $e) {
            $error = "Adatbázis mentési hiba: " . $e->getMessage();
        }
   
}
}?>