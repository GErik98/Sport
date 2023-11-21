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
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                <fieldset>
                    <legend>Beállítások</legend>
                    <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                    <label for="username">Felhasználónév megváltoztatása</label>
                    <input type="text" id="username" name="username"><br>
                    <label for="username">Jelszó megváltoztatása</label>
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
                header('location:admin.php');
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
        
    
     
} elseif ($action === 'delete') {
    // Your code for the 'delete' action
    echo '<h3>Delete User Form</h3>';
    // Add form elements and processing logic
} else {
    // Handle unknown action or provide an error message
    echo '<p>Error: Unknown action.</p>';
}
?>