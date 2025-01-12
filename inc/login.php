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
    <?php include 'db.php'; ?>
    <h1 class="text-center">Login</h1>
    <div class="login-container">
        <?php
        session_start();
        $tableName = 'reg';
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email']);//trim() remove whitespace
            $password = trim($_POST['password']);
            $errors = [];
            $sql = "SELECT email,passwort FROM $tableName";
            $sql_isAdmin = "SELECT isAdmin FROM $tableName WHERE email='$email'";
            $result = $db_obj->query($sql);
            $result_isAdmin = $db_obj->query($sql_isAdmin);
            $rows = [];
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
            $emailFound = false;
            $isPasswordCorrect = false;
            // password_hash() returns the algorithm, cost and salt as part of the returned hash
            $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
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
                echo "<p style='color: red; text-align: center; font-size: 24px;'>Wrong login credentials!</p>";
            }
        }

        if (isset($_SESSION['user_logged_in'])) {
            //htmlspecialchars() function in PHP is used to convert special characters to HTML entities
            echo "<h2>Welcome, " . htmlspecialchars($_SESSION['user_logged_in']) . "!</h2>";
        } else if (isset($_SESSION['isAdmin'])) {
            echo "<h2>Welcome,admin!</h2>";
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