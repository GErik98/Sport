<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles.css" />
    <title>SportLogin</title>
</head>

<body>
    <div class="section">
        <div class="login-box">
            <form>
                <legend style="padding-bottom:10px; text-transform: uppercase;"><b>Login:</b></legend>
                <label for="name">Name</label>
                <input type="text" id="name" name="name"><br>
                <label for="email">Email</label>
                <input type="email" id="email" name="email"> <br>
                <input type="submit" id="submit" value="submit">
            </form>
            <p style="margin-top: 10px;">Dont have account yet?<br> <a href="register.php">Register</a></p>
        </div>
    </div>
    <script src="loginscript.js"></script>
</body>

</html>