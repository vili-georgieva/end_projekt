<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../res/css/style.css">
</head>

<body>

    <?php
    session_start();
    include 'navigation.php';

    if (!isset($_SESSION['registeredUsers'])) {
        $_SESSION['registeredUsers'] = [];
    }

    function isUsernameUnique($username, $registeredUsers) {
        return !in_array($username, $registeredUsers);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username']);
        $errors = [];

        if (!isUsernameUnique($username, $_SESSION['registeredUsers'])) {
            $errors[] = "Error: Username '$username' is already taken.";
        }

        if (empty($errors)) {
            $_SESSION['registeredUsers'][] = $username;

            echo "<p>User '$username' registered successfully!</p>";
        } else {
            $_SESSION['errors'] = $errors;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    if (isset($_SESSION['errors'])) {
        echo '<div class="error-messages">';
        foreach ($_SESSION['errors'] as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo '</div>';
        unset($_SESSION['errors']); 
    }
    ?>

    <h1>Register</h1>
    <form action="" method="post">
        <label for="salutation">Salutation:</label>
        <select id="salutation" name="salutation" required>
            <option value="Mr">Mr.</option>
            <option value="Ms">Ms.</option>
            <option value="Mrs">Mrs.</option>
            <option value="Dr">Dr.</option>
        </select>
        <br>
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
        <br>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
        <br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="repeat_password">Repeat Password:</label>
        <input type="password" id="repeat_password" name="repeat_password" required>
        <br>
        <input type="submit" value="Register">
    </form>
    <div class="register-container">
    </div>

</body>

</html>
