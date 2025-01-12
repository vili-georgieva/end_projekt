<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Text and Image</title>
    <?php include 'head.php'; ?>
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

        $uploaddir = '../uploads/news/';
        $photoName = basename($_FILES['userfile']['name']);
        $uploadfile = $uploaddir . $photoName;
        $uploadedFilePath = '';
        $imageFileType = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));
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
            // get image size and type
            list($width, $height, $type) = getimagesize($uploadfile);
            // create image resource based on type
            switch ($type) {
                case IMAGETYPE_JPEG:
                    $src = imagecreatefromjpeg($uploadfile);
                    break;
                case IMAGETYPE_PNG:
                    $src = imagecreatefrompng($uploadfile);
                    break;
                case IMAGETYPE_GIF:
                    $src = imagecreatefromgif($uploadfile);
                    break;
                default:
                    die("Unsupported image type.");
            }
            // set maximum dimensions for the thumbnail
            $maxWidth = 800;
            $maxHeight = 600;
            // calculate new dimensions while maintaining aspect ratio
            if ($width > $height) {
                // landscape orientation
                $newWidth = $maxWidth;
                $newHeight = ($height / $width) * $newWidth;
            } else {
                // portrait orientation or square
                $newHeight = $maxHeight;
                $newWidth = ($width / $height) * $newHeight;
            }
            // create a new true color image
            $dst = imagecreatetruecolor($newWidth, $newHeight);
            // resize the image
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            // save the thumbnail
            $smallName = 'small_' . $photoName;
            $thumbnailPath = $uploaddir . $smallName;
            imagejpeg($dst, $thumbnailPath);
            // free memory
            imagedestroy($src);
            imagedestroy($dst);
            $uploadedFilePath = $uploadfile;
        } else {
            echo "<p>Possible file upload attack!\n</p>";
        }
        $submittedText = htmlspecialchars($_POST['text']);
        $currentDate = date("Y-m-d");
        $_SESSION['newsCounter']++;
        $newsCounter = $_SESSION['newsCounter'];
        $sql = "INSERT INTO `news` (`id`, `text`, `photoname`, `photodir`, `date`)
        VALUES ('$newsCounter', '$submittedText', '$smallName', '$thumbnailPath', '$currentDate')";
        $result = $db_obj->query($sql);
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