<?php
session_start();
$error = "";
$msg = "";
require_once("dbconnect.php");
class LoginException extends Exception
{
}


if (isset($_POST["submitLogin"]) && !empty($connDB)) {
  try {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    if (empty($username) || empty($password)) {
      throw new LoginException("Hiányzó adatok");
    }
    $sqlLogin = "SELECT id, username, password, role FROM felhasznalo WHERE username=:username";
    $queryLogin = $connDB->prepare($sqlLogin);
    $queryLogin->bindParam(":username", $username, PDO::PARAM_STR);
    $queryLogin->execute();
    if ($queryLogin->rowCount() == 0) {
      throw new LoginException("Hibás felhasználói azonosító");
    }
    $user = $queryLogin->fetch(PDO::FETCH_ASSOC);
    if (!password_verify($password, $user["password"])) {
      throw new LoginException("Hibás jelszó");
    }
    $_SESSION["user"] = array(
      "id" => $user["id"],
      "username" => $user["username"],
      "password" => $user["password"],
      "role" => $user["role"],
    );
    header("location:index.php");
  } catch (PDOException $e) {
    $error = "Adatbázis olvasási hiba: " . $e->getMessage();
  } catch (LoginException $e) {
    $error = "Bejelentkezési hiba: " . $e->getMessage();
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
    <title>SportLogin</title>
</head>
<?php
?>
<div class="section" id="login">
    <div class="login-box" data-aos="zoom-in">
      <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <legend style="padding-bottom:10px; text-transform: uppercase;"><b>Login:</b></legend>
        <label for="username">Username</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password</label>
        <input style="margin-left:4px;" type="password" id="password" name="password"> <br>
        <input type="submit" id="submitLogin" name="submitLogin" value="Login">
      </form>
      <p style="margin-top: 10px; text-decoration: none;">Dont have account yet?</p>

      <a href="register.php">
        <button>Register</button>
      </a><br>
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
</div>
</body>

</html>