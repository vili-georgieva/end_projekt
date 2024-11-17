<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../res/css/style.css"> 
</head>
<body>

<?php include 'navigation.php'; ?>

<div class="login-container">
    <h1>Login</h1>
    
    <?php 
    session_start(); 

    $hardcodedEmail = "u@a";
    $hardcodedPassword = "a";

    if (isset($_SESSION['logged_in_user'])) {
        echo "<h2>Welcome, " . htmlspecialchars($_SESSION['logged_in_user']) . "!</h2>";
    } else {
        if (isset($_SESSION['login_errors'])) {
            echo '<div class="error-messages">';
            foreach ($_SESSION['login_errors'] as $error) {
                echo "<p class='error'>$error</p>";
            }
            echo '</div>';
            unset($_SESSION['login_errors']);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $errors = [];

            if ($email !== $hardcodedEmail || $password !== $hardcodedPassword) {
                $errors[] = "Invalid email or password.";
                $_SESSION['login_errors'] = "Invalid emaiil or password.";
                header("Location: " . $_SERVER['PHP_SELF']); 
                exit();
            } else {
   
                $_SESSION['user_logged_in'] = true;
                $_SESSION['logged_in_user'] = $hardcodedEmail; 
                header("Location: " . $_SERVER['PHP_SELF']); 
                exit();
            }
        }
    }
    ?>

    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>
