<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" href="../res/css/style.css">
</head>

<body>

    <?php include 'navigation.php'; ?>
    <h1 class="text-center">Login</h1>
    <div class="login-container">
        <?php
        session_start();
        $tableName = 'reg';
        require_once('../config/dbaccess.php'); //to retrieve connection details
        $db_obj = new mysqli($host, $user, $password, $database);
        // fucntion for debugging purposes
        function debug_to_console($data)
        {
            $output = $data;
            if (is_array($output))
                $output = implode(',', $output);

            echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
        }
        $sql = " SELECT id FROM `rooms`  ORDER BY ID DESC LIMIT 1";
        $result = $db_obj->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION['co'] = $row['id'];
        if (isset($_SESSION['user_logged_in'])) {
            debug_to_console("user");
            echo "<h2>Welcome, " . htmlspecialchars($_SESSION['user_logged_in']) . "!</h2>";
        } else if (isset($_SESSION['isAdmin'])) {
            debug_to_console("isAdmin: " . $_SESSION['isAdmin']);
            $sql = " SELECT id FROM `news`  ORDER BY ID DESC LIMIT 1";
            $result = $db_obj->query($sqlName);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $_SESSION['newsCounter'] = $row['id'];
            echo "<h2>Welcome,admin!</h2>";
        } else {
            debug_to_console("eLSe");
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
                debug_to_console("email: " . $email);
                debug_to_console("password: " . $password);
                $errors = [];
                $sql = "SELECT email,passwort FROM $tableName";
                $sql_isAdmin = "SELECT isAdmin FROM $tableName WHERE email='$email'";
                $result = $db_obj->query($sql);
                $result_isAdmin = $db_obj->query($sql_isAdmin);
                $rows = [];
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $rows[] = $row;
                }
                echo "test";
                $emailFound = false;
                $isPasswordCorrect = false;
                // password_hash() returns the algorithm, cost and salt as part of the returned hash
                $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                debug_to_console($password_hash);
                echo $password_hash;
                echo "test";
                foreach ($rows as $row) {
                    if ($row['email'] === $email) {
                        // verifies that a password matches a hash
                        $isPasswordCorrect = password_verify($_POST['password'], $row['passwort']);
                        if ($isPasswordCorrect) {
                            $emailFound = true;
                            $isPasswordCorrect = true;
                            break;
                        }
                    }
                }
                $isAdmin = $result_isAdmin->fetch_array(MYSQLI_ASSOC);
                if ($emailFound && $isPasswordCorrect) {
                    if ($isAdmin['isAdmin']) {
                        $_SESSION['isAdmin'] = true;
                        $_SESSION['admin_email'] = $email;
                    } else {
                        $_SESSION['user_logged_in'] = $email;
                    }
                    header('Location: profile.php');
                    exit();
                } else {
                    debug_to_console("invalid credentials");
                    $errors[] = "Invalid email or password.";
                    $_SESSION['login_errors'] = "Invalid emaiil or password.";
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