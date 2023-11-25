<?php
session_start();
$error = "";
$msg = "";
require_once("dbconnect.php");

if(isset($_POST["submitContact"]) && !empty($connDB)){
    try {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $message = $_POST["message"];

        $stmt = $connDB->prepare("INSERT INTO contacts (name, email, message, submission_date) VALUES (:name, :email, :message, NOW())");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        
        $stmt->execute();        
    } catch (PDOException $e) {
        $error = "Adatbázis mentési hiba: ". $e->getMessage();
    } finally {
        $connDB = null;
        header("location:index.php#contact");
    }
}
?>