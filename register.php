<?php
session_start();
$error = "";
$msg = "";
require_once("dbconnect.php");

class LoginException extends Exception {}

if(isset($_POST["submitReg"]) && !empty($connDB)){
    try {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        if($password != trim($_POST["password2"])){
            throw new LoginException("Nem azonos a két jelszó");
        }

        $sqlReg = "INSERT INTO felhasznalo (username, password) values (:username, :password)";
        $queryReg = $connDB->prepare($sqlReg);
        $queryReg->bindParam(":username", $username, PDO::PARAM_STR);
        $pwHashed = password_hash($password, PASSWORD_DEFAULT);
        $queryReg->bindParam(":password", $pwHashed, PDO::PARAM_STR);
        $queryReg->execute();

        $msg = "Sikeres regisztráció";   
    }   catch(PDOException $e) {
        $error = "Adatbázis mentési hiba: ".$e->getMessage();
    }   catch(LoginException $e) {
        $error = "Regisztrációs hiba: ".$e->getMessage();
    }   finally {
        $connDB = null;
    }
}
session_write_close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles.css" />
    <title>SportReg</title>
</head>

<div class="section content login" id="login">
    <div class="login-box" data-aos="zoom-in">
      <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <legend style="padding-bottom:10px; text-transform: uppercase;"><b>Register:</b></legend>
        <label for="username">Felhasználónév:</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Jelszó:</label>
        <input style="margin-left:4px;" type="password" id="password" name="password"> <br>
        <label for="password">Jelszó megerősítése:</label>
        <input style="margin-left:4px;" type="password" id="password2" name="password2"> <br>
        <input type="submit" id="submitReg" name="submitReg" value="Register">
      </form>
      <?php
  if (!empty($error)) {
    echo $error;
  }
  if (!empty($msg)) {
    echo $msg;
  } ?>

    </div>
    <a href="index.php">
        <button>Home</button>
    </a>
  </div>
</body>

</html>