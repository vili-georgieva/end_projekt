<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" href="../res/css/style.css">
</head>

<body>

    <?php
    session_start();
    $tableName = 'reg';
    require_once('../config/dbaccess.php'); //to retrieve connection details
    $db_obj = new mysqli($host, $user, $password, $database);
    include 'navigation.php';

    //
    if (!isset($_SESSION['user_logged_in']) && !isset($_SESSION['isAdmin'])) {
        echo "<h2>Please log in to view your profile.</h2>";
        echo '<a href="login.php">Login</a>';
        exit();
    }

    if ($_SESSION['isAdmin']) {
        echo "<h2>Welcome, " . htmlspecialchars($_SESSION['admin_email']) . "!</h2>";
    } else {
        echo "<h2>Welcome, " . htmlspecialchars($_SESSION['user_logged_in']) . "!</h2>";
    }
    if ($_SESSION['isAdmin']) {
        $email = $_SESSION['admin_email'];
    } else {
        $email = $_SESSION['user_logged_in'];
    }

    $sqlName = "SELECT firstname,lastname FROM $tableName WHERE email='$email'";
    $result = $db_obj->query($sqlName);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $firstName = $row['firstname'];
    $lastName = $row['lastname'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['update_profile'])) {
            $newFirstName = trim($_POST['first_name']);
            $newLastName = trim($_POST['last_name']);
            echo "<p>Profile updated: $newFirstName $newLastName</p>";
            $sql = "UPDATE `reg` SET firstname='$newFirstName', lastname ='$newLastName' WHERE email='$email'";
            $result = $db_obj->query($sql);
        } elseif (isset($_POST['change_password'])) {
            // trim is used to remove whitespace (or other specified characters) from beginning and end
            $oldPassword = trim($_POST['old_password']);
            $newPassword = trim($_POST['new_password']);
            $repeatNewPassword = trim($_POST['repeat_new_password']);
            // SQL query for selecting the password for specific email
            $sq = "SELECT passwort FROM `reg` WHERE email='$email'";
            // run the query
            $result = $db_obj->query($sq);
            // convert the result variable to associative array
            // key - value pair instead of int index
            $row = $result->fetch_array(MYSQLI_ASSOC);
            // php function which verifies that a password matches a hash
            // returns true if password matches
            $isPasswordCorrect = password_verify($oldPassword, $row['passwort']);
            if (!$isPasswordCorrect) {
                echo "<p class='error'>Error: Old password is incorrect.</p>";
            } elseif ($newPassword !== $repeatNewPassword) {
                echo "<p class='error'>Error: New passwords do not match.</p>";
            } else {
                echo "<p>Password changed successfully!</p>";
                $hashToStoreInDb = password_hash($newPassword, PASSWORD_DEFAULT);
                $sql = "UPDATE `reg` SET passwort='$hashToStoreInDb' WHERE email='$email'";
                $result = $db_obj->query($sql);
            }
        }
    }
    ?>

    <h3>Your Profile</h3>
    <form method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($newFirstName); ?>"
            required>
        <br>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($newLastName); ?>"
            required>
        <br>
        <br>
        <br>
        <input type="submit" name="update_profile" value="Update Profile">
    </form>

    <h3>Change Password</h3>
    <form method="post">
        <label for="old_password">Old Password:</label>
        <input type="password" id="old_password" name="old_password" required>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>

        <label for="repeat_new_password">Repeat New Password:</label>
        <input type="password" id="repeat_new_password" name="repeat_new_password" required>

        <input type="submit" name="change_password" value="Change Password">
    </form>

</body>

</html>