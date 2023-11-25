<?php
session_start();
$error = "";
$msg = "";
require_once("../dbconnect.php");

class LoginException extends Exception {}

if(isset($_POST["submitReg"]) && !empty($connDB)){
    try {
        $role = trim($_POST["roleSelect"]);
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        if($password != trim($_POST["password2"])){
            throw new LoginException("Nem azonos a két jelszó");
        }

        $sqlCheckUsername = "SELECT COUNT(*) FROM felhasznalo WHERE LOWER(username) = LOWER(:username)";
        $checkUsernameQuery = $connDB->prepare($sqlCheckUsername);
        $checkUsernameQuery->bindParam(":username",$username, PDO::PARAM_STR);
        $checkUsernameQuery->execute();
        $usernameExists = $checkUsernameQuery->fetchColumn();

        if($usernameExists){
          throw new LoginException("A felhasználónév már létezik");
        }

        $sqlReg = "INSERT INTO felhasznalo (username, password, role) values (:username, :password, :role )";
        $queryReg = $connDB->prepare($sqlReg);
        $queryReg ->bindParam(":role", $role, PDO::PARAM_STR);
        $queryReg->bindParam(":username", $username, PDO::PARAM_STR);
        $pwHashed = password_hash($password, PASSWORD_DEFAULT);
        $queryReg->bindParam(":password", $pwHashed, PDO::PARAM_STR);
        $queryReg->execute();

        $msg = "Sikeres regisztráció";
        header("Location:../login_register/login.php");  
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
    <link rel="stylesheet" href="../styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <title>SportReg</title>
</head>
<body>
<div class='header'>
    <a href='../index.php'><h1 class='nav-title' id='logo'>Sportify</h1></a>
    <ul class='horizontal-nav'>
      <a href="../index.php" class="icon"><i class="fas fa-home"></i></a>
    </ul>
    
  </div>
<div class="section" id="login">
    <div class="login-box" data-aos="zoom-in">
      <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <legend style="padding-bottom:10px; text-transform: uppercase;"><b>Register:</b></legend>
        <label for="role">Role:</label>
        <select id="roleSelect" name="roleSelect">
          <option value ="user">Játékos</option>
          <option value ="szervezo">Szervező</option>
        </select><br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label>
        <input style="margin-left:4px;" type="password" id="password" name="password"> <br>
        <label for="password">Verify Password:</label>
        <input style="margin-left:4px;" type="password" id="password2" name="password2"> <br>
        <button type="submit" id="submitReg" name="submitReg" value="Register">Register</button>
      </form>
      <?php
  if (!empty($error)) {
    echo $error;
  }
  if (!empty($msg)) {
    echo $msg;
  } ?>

    </div>
  </div>
</body>

</html>