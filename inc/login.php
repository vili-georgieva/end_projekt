<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/end_projekt/res/css/style.css"> <!-- Link to your CSS file -->
</head>
<body>

<?php include 'navigation.php'; ?>

<div class="login-container">
    <h1>Login</h1>
    
    <?php 
    session_start(); 
    // Display error messages if any
    if (isset($_SESSION['login_errors'])) {
        echo '<div class="error-messages">';
        foreach ($_SESSION['login_errors'] as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo '</div>';
        unset($_SESSION['login_errors']); // Clear errors after displaying
    }
    ?>

    <form action="process_login.php" method="post"> <!-- Change action to your processing script -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>
