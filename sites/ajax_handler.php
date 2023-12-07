<?php
session_start();
$error = "";
$msg = "";
include("../dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : null;

    if ($action === 'modify') {
        echo '<h3>Modify User Form</h3>';
        $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
        // Your code to load modification form or perform modifications
?>
        <div class="admin_panels">
            <form id="modifyForm" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                <fieldset>
                    <legend>Beállítások</legend>
                    <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                    <label for="username">Felhasználónév megváltoztatása</label>
                    <input type="text" id="username" name="username"><br>
                    <label for="password">Jelszó megváltoztatása</label>
                    <input type="text" id="password" name="password"><br>
                    <label for="username">Szerep megváltoztatása</label>
                    <select id="roleSelect" name="roleSelect">
                        <option value="user">Játékos</option>
                        <option value="szervezo">Szervező</option>
                    </select><br>
                    <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                    <button type="submit" id="submitSet" name="submitSet" value="submitSet">Rendben</button>
                </fieldset>
            </form>
        </div>
    <?php
    }
    if (isset($_POST['submitSet'])) {
        echo '<h3>asdasd</h3>';
        try {
            $userId = isset($_POST['userId']) ? $_POST['userId'] : null;

            $updateFields = array();

            if (isset($_POST["username"])) {
                $newUsername = $_POST["username"];
                $updateFields[] = "username = :newUsername";
            }

            if (isset($_POST["password"])) {
                $newPassword = $_POST["password"];
                $updateFields[] = "password = :newPassword";
            }

            if (isset($_POST["roleSelect"])) {
                $newRole = $_POST["roleSelect"];
                $updateFields[] = "role = :newRole";
            }

            // Construct the SQL query dynamically
            $updateQuery = $connDB->prepare("UPDATE felhasznalo SET " . implode(", ", $updateFields) . " WHERE id = :userId");

            // Bind parameters based on the fields present in the form
            if (isset($newUsername)) {
                $updateQuery->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
            }

            if (isset($newPassword)) {
                $pwHashed = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateQuery->bindParam(':newPassword', $pwHashed, PDO::PARAM_STR);
            }

            if (isset($newRole)) {
                $updateQuery->bindParam(':newRole', $newRole, PDO::PARAM_STR);
            }

            $updateQuery->bindParam(':userId', $userId, PDO::PARAM_INT);

            $updateQuery->execute();

            if ($updateQuery->rowCount() > 0) {
                echo '<p>User information updated successfully for User ID: ' . $userId . '</p>';
                header('location:profile.php');
            } else {
                echo '<p>User information update failed for User ID: ' . $userId . '</p>';
            }
        } catch (PDOException $e) {
            $error = "Database update error: " . $e->getMessage();
        }
    }


    if ($action === 'ban') {
        $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
        echo '<h3>Ban User Form</h3>';
        try {
            $role = "tiltva";
            $updateQuery = $connDB->prepare("UPDATE felhasznalo SET role = :role WHERE id = :userId");
            $updateQuery->bindParam(':role', $role, PDO::PARAM_STR);
            $updateQuery->bindParam(':userId', $userId, PDO::PARAM_INT);
            $updateQuery->execute();

            if ($updateQuery->rowCount() > 0) {
                echo '<p>User information updated successfully for User ID: ' . $userId . '</p>';
                echo '<script>window.location.reload();</script>';
            } else {
                echo '<p>User information update failed for User ID: ' . $userId . '</p>';
            }
        } catch (PDOException $e) {
            $error = "Adatbázis módosítás hiba: " . $e->getMessage();
        }
    }
    if ($action === 'delete') {
        $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
        echo '<h3>Delete User Form</h3>';
        try {
            $deleteQuery = $connDB->prepare("DELETE FROM felhasznalo WHERE id = :userId");
            $deleteQuery->bindParam(':userId', $userId, PDO::PARAM_INT);
            $deleteQuery->execute();

            if ($deleteQuery->rowCount() > 0) {
                echo '<p>User deleted successfully for User ID: ' . $userId . '</p>';
            } else {
                echo '<p>User deletion failed for User ID: ' . $userId . '</p>';
            }
        } catch (PDOException $e) {
            $error = "Adatbázis törlési hiba: " . $e->getMessage();
        }
    }

    if ($action === 'addEvent') {
    ?>
        <div class="admin_panels">
            <form id="eventForm" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                <fieldset>
                    <legend>Esemény hozzáadása</legend>
                    <label for="eventName">Esemény neve</label>
                    <input type="text" id="eventName" name="eventName" required><br>
                    <label for="sportAg">Sportág</label>
                    <select id="eventSelect" name="eventSelect" required>
                        <option value="" disabled selected>-Válasszon-</option>
                        <option value="foci">Labdarúgás</option>
                        <option value="tenisz">Futás</option>
                        <option value="f1">Forma 1</option>
                    </select><br>
                    <label for="tipus">Mérzkőzés típusa</label>
                    <select id="typeSelect" name="typeSelect" required>
                        <option value="" disabled selected>-Válasszon-</option>
                        <option value="merkozes">Mérkőzéses</option>
                        <option value="futam">Futam</option>
                    </select><br>
                    <label for="date">Dátum</label>
                    <input type="datetime-local" id="dateTime" name="dateTime" required>
                    <button type="submit" id="submitEvent" name="submitEvent" value="submitEvent">Rendben</button>
                </fieldset>
            </form>
        </div>
    <?php
    }
    if ($action === 'enter') {
        $userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
        $eventId = isset($_POST['eventId']) ? $_POST['eventId'] : null;
        echo "ID:" . $userId; ?>
        <br> <?php
                echo "EventId:" . $eventId;
            }
            if (isset($_POST['submitEvent'])) {
                try {
                    $eventName = $_POST['eventName'];
                    $sportAg = $_POST['eventSelect'];
                    $merkozes = $_POST['typeSelect'];
                    $datum = $_POST['dateTime'];

                    $stmt = "INSERT INTO esemeny (nev, sportag, tipus, datetime) VALUES (:eventName, :sportAg, :merkozes, :datum)";
                    $eventInsert = $connDB->prepare($stmt);
                    $eventInsert->bindParam(":eventName", $eventName, PDO::PARAM_STR);
                    $eventInsert->bindParam(":sportAg", $sportAg, PDO::PARAM_STR);
                    $eventInsert->bindParam(":merkozes", $merkozes, PDO::PARAM_STR);
                    $eventInsert->bindParam(":datum", $datum, PDO::PARAM_STR);

                    $eventInsert->execute();

                    if ($eventInsert->rowCount() > 0) {
                        echo '<script>window.location.href = "profile.php?message=Event added successfully!";</script>';
                    } else {
                        echo '<p>Failed attempt.</p>';
                    }
                } catch (PDOException $e) {
                    $error = 'Adatbázis hiba: ' . $e->getMessage();
                }
            }
        }

                ?>