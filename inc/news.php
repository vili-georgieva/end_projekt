<!DOCTYPE html>
t<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Text and Image</title>
    <link rel="stylesheet" href="../res/css/style.css">
</head>

<body>
    <?php

    include 'navigation.php';
    session_start();
    $tableName = 'news';
    require_once('../config/dbaccess.php'); //to retrieve connection details
    $db_obj = new mysqli($host, $user, $password, $database);

    if (!isset($_SESSION['submitted_texts'])) {
        $_SESSION['submitted_texts'] = [];

        // Hardcoded information for discounts and images
        $_SESSION['submitted_texts'][] = [
            'text' => '20% Discount on Weekday Bookings!',
            'image' => '../uploads/news/20.jpg',
            'date' => '01-01-2024'
        ];
        $_SESSION['submitted_texts'][] = [
            'text' => 'Special Offer: Stay 3 Nights, Get 1 Free!',
            'image' => '../uploads/news/3nights.webp',
            'date' => '01-04-2024'
        ];
        $_SESSION['submitted_texts'][] = [
            'text' => 'Family Package: 15% Off for Families!',
            'image' => '../uploads/news/15.jpg',
            'date' => '01-06-2024'
        ];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newsCounter = $_SESSION['newsCounter'];
        $uploaddir = '../uploads/';
        $photoName = basename($_FILES['userfile']['name']);
        $uploadfile = $uploaddir . $photoName;
        $uploadedFilePath = '';
        $imageFileType = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));

        echo "<p>type :" . $imageFileType . ".</p>";

        if (
            $_FILES['userfile']['type'] != "image/png" &&
            $imageFileType != "jpg" &&
            $imageFileType != "jpeg" &&
            $imageFileType != "gif"
        ) {
            echo "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
            exit();
        }

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo "<p>File is valid, and was successfully uploaded.\n</p>";
            $uploadedFilePath = $uploadfile;
        } else {
            echo "<p>Possible file upload attack!\n</p>";
        }
        $submittedText = htmlspecialchars($_POST['text']);
        $currentDate = date("Y-m-d");
        $_SESSION['submitted_texts'][] = [
            'text' => $submittedText,
            'date' => $currentDate,
            'image' => $uploadedFilePath
        ];
        $sql = "INSERT INTO `news` (`id`, `text`, `photoname`, `photodir`, `date`)
        VALUES ('$newsCounter', '$submittedText', '$photoName', '$uploadedFilePath', '$currentDate')";
        $result = $db_obj->query($sql);
        $_SESSION['newsCounter']++;
    }

    if (!empty($_SESSION['submitted_texts'])) {
        echo '<div class="divUL">';
        echo "<h2>All Submitted Texts:</h2>";
        echo "<ul>";

        foreach (array_reverse($_SESSION['submitted_texts']) as $entry) {
            echo "<li>";
            echo "<p>" . $entry['text'] . "</p>";
            echo "<p>" . $entry['date'] . "</p>";

            if (!empty($entry['image'])) {
                echo "<div class='image-container'>";
                echo "<img class='small-image' src='" . $entry['image'] . "' alt='Uploaded Image' />";
                echo "</div>";
            }
            echo "</li>";
        }
        $sql_all = "SELECT * FROM $tableName";
        $result_all = $db_obj->query($sql_all);
        while ($row = $result_all->fetch_array(MYSQLI_ASSOC)) {
            echo "<li>";
            echo "<p>" . $row['text'] . "</p>";
            echo "<p>" . $row['date'] . "</p>";
            if (!empty($row['photodir'])) {
                echo "<div class='image-container'>";
                echo "<img class='small-image' src='" . $row['photodir'] . "' alt='Uploaded Image' />";
                echo "</div>";
            }
            echo "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
    ?>

    <?php
    if (isset($_SESSION['isAdmin'])) {
        ?>
        <h1>Upload Text and Image</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="text">Enter your text:</label><br>
            <textarea id="text" name="text" rows="4" cols="50" required></textarea><br><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            Send this file: <input name="userfile" type="file" />
            <input type="submit" value="Send File" />
        </form>
        <?php
    }
    ?>
</body>

</html>