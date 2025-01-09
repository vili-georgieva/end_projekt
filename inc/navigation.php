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
$isLoggedIn = isset($_SESSION['user_logged_in']);
$isAdmin = isset($_SESSION['isAdmin']) === true;
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


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $cssPath; ?>index.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $menuPath; ?>impressum_new.php">Impressum</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $menuPath; ?>help.php">Help</a>
                </li>
                <?php if (!$isLoggedIn && !$isAdmin): ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo $menuPath; ?>login.php">Login</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo $menuPath; ?>register.php">Register</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $menuPath; ?>news.php">News</a>
                </li>
                <?php if ($isLoggedIn || $isAdmin): ?>
                    <li class="nav-item active"><a class="nav-link" href="<?php echo $menuPath; ?>profile.php">Profile</a>
                    </li>
                    <li class="nav-item active"><a class="nav-link" href="<?php echo $menuPath; ?>room_reg.php">Room
                            Register</a></li>
                    <li class="nav-item active"><a class="nav-link" href="<?php echo $menuPath; ?>view_room.php">Room
                            view</a></li>
                    <li class="nav-item active"><a class="nav-link" href="<?php echo $menuPath; ?>logout.php">Logout</a>
                    </li>
                <?php endif; ?>


            </ul>
        </div>
    </nav>
</body>

</html>