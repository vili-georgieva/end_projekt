<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/vscode/end_projekt/res/css/login.css">
</head>

<body>

    <?php
    session_start();
    include 'navigation.php';

    // Display error messages if any
    /*if (isset($_SESSION['errors'])) {
        echo '<div class="error-messages">';
        foreach ($_SESSION['errors'] as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo '</div>';
        unset($_SESSION['errors']); // Clear errors after displaying
    }*/
    ?>


    <h1>Register</h1>
    <form action="process_registration.php" method="post">
        <label for="salutation">Salutation:</label>
        <select id="salutation" name="salutation" required>
            <option value="Mr">Mr.</option>
            <option value="Ms">Ms.</option>
            <option value="Mrs">Mrs.</option>
            <option value="Dr">Dr.</option>
        </select>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="repeat_password">Repeat Password:</label>
        <input type="password" id="repeat_password" name="repeat_password" required>

        <input type="submit" value="Register">
    </form>
    <div class="register-container">
    </div>

</body>

</html>