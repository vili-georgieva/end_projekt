<?php
session_start(); // Start the session

// Hardcoded username and password
$hardcodedUsername = 'user';
$hardcodedPassword = 'password';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check credentials
    if ($username === $hardcodedUsername && $password === $hardcodedPassword) {
        $_SESSION['loggedin'] = true; // Set session variable
        $_SESSION['username'] = $username; // Store username in session
    } else {
        $error = "Invalid username or password.";
    }
}

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];

$currentDir = dirname($_SERVER['SCRIPT_FILENAME']);
if (strpos($currentDir, 'inc') !== false) {
    $cssPath = '../';
    $menuPath = '';
} else {
    $cssPath = '';
    $menuPath = 'inc/';
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Navigation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo $cssPath; ?>res/css/navigation.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="jumbotron text-center">
        <nav>
            <ul>
                <li><a href="<?php echo $cssPath; ?>index.php">Home</a></li>
                <li><a href="<?php echo $menuPath; ?>impressum.php">Impressum</a></li>
                <li><a href="<?php echo $menuPath; ?>help.php">Help</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="<?php echo $menuPath; ?>profile.php">Profile</a></li>
                    <li><a href="<?php echo $menuPath; ?>logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?php echo $menuPath; ?>login.php">Login</a></li>
                    <li><a href="<?php echo $menuPath; ?>register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <!-- Login Form (for demonstration purposes) -->
    <?php if (!$isLoggedIn): ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>
