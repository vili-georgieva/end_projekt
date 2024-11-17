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

    // Initialize the registered users array in the session if it doesn't exist
    if (!isset($_SESSION['registeredUsers'])) {
        $_SESSION['registeredUsers'] = [];
    }

    // Function to check if a username is unique
    function isUsernameUnique($username, $registeredUsers) {
        return !in_array($username, $registeredUsers);
    }

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username']); // Get the username from the form input
        $errors = [];

        // Check for unique username
        if (!isUsernameUnique($username, $_SESSION['registeredUsers'])) {
            $errors[] = "Error: Username '$username' is already taken.";
        }

        // If there are no errors, register the user
        if (empty($errors)) {
            $_SESSION['registeredUsers'][] = $username; // Add the new username to the session array
            // You can also handle other form data here (e.g., first name, last name, etc.)
            // Redirect or display a success message
            echo "<p>User '$username' registered successfully!</p>";
        } else {
            // Store errors in the session to display them
            $_SESSION['errors'] = $errors;
            // Redirect to the same page to display errors
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    // Display error messages if any
    if (isset($_SESSION['errors'])) {
        echo '<div class="error-messages">';
        foreach ($_SESSION['errors'] as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo '</div>';
        unset($_SESSION['errors']); // Clear errors after displaying
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

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

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
