<?php
session_start();
$currentDir = dirname($_SERVER['SCRIPT_FILENAME']);
if (strpos($currentDir, 'inc') !== false) {
    $cssPath = '../';
    $menuPath = '';
} else {
    $cssPath = '';
    $menuPath = 'inc/';
}
$isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
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
    <div— class="jumbotron text-center">


        <nav>
            <ul>
                <li><a href="<?php echo $cssPath; ?>index.php">Home</a></li>
                <li><a href="<?php echo $menuPath; ?>impressum.php">Impressum</a></li>
                <li><a href="<?php echo $menuPath; ?>help.php">Help</a></li>
                <li><a href="<?php echo $menuPath; ?>login.php">Login</a></li>
                <li><a href="<?php echo $menuPath; ?>register.php">Register</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="<?php echo $menuPath; ?>profile.php">Profile</a></li>
                    <li><a href="<?php echo $menuPath; ?>room_reg.php">Room Register</a></li>
                    <li><a href="<?php echo $menuPath; ?>view_room.php">Room view</a></li>
                <?php endif; ?>

            </ul>
        </nav>
        </div>
</body>

</html>