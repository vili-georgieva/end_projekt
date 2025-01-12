<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" href="../res/css/style.css">
</head>

<body>

    <?php
    session_start();
    include 'navigation.php';
    include 'db.php';
    $tableName = 'reg';
    function isEmailUnique($newEmail, $registeredUsers)
    {
        return !in_array($newEmail, $registeredUsers);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username']);
        $firstName = trim($_POST['first_name']);
        $lastName = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $salutation = trim($_POST['salutation']);
        $errors = [];
        // the function password_hash() returns a cryptographically secure hash (one-way hashing)
        // first parameter is clear text password, second parameter is hashing algorithm
        // PASSWORD_DEFAULT -> bcrypt algorithm
        $hashToStoreInDb = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // password_hash() returns the algorithm, cost and salt as part of the returned hash
        $sq = "select email from " . $tableName . ";";
        $result = $db_obj->query($sq);
        $existingEmails = $result->fetch_array(MYSQLI_ASSOC);
        $existingEmails = $existingEmails['email'];
        if (!isEmailUnique($email, $existingEmails)) {
            $errors[] = "Error: Email '$email' is already taken.";
        }

        if (empty($errors)) {
            $sq = "INSERT INTO $tableName 
            (`salutation`, `firstname`, `lastname`,
             `usernme`, `email`, `passwort`, `isAdmin`) VALUES 
             ('$salutation', '$firstName', '$lastName', '$username', 
             '$email', '$hashToStoreInDb', '0')";
            $result = $db_obj->query($sq);
            echo "<p>User '$username' registered successfully!</p>";
            header("Location: login.php");
            exit();
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

    <h1 style='text-align: center;'>Register</h1>
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