<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" href="../res/css/style.css">
</head>

<body>
    <?php
    include 'navigation.php';
    include 'db.php';
    session_start();
    $tableName = 'news';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $uploaddir = '../uploads/news/';
        $photoName = basename($_FILES['userfile']['name']);//basename() function in PHP is used to return the trailing name component of a path
        $uploadfile = $uploaddir . $photoName;//full path by concatenating the directory and file name.
        $uploadedFilePath = '';
        $imageFileType = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION)); //strtolower() function in PHP is used to convert all characters in a string to lowercase
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
        $sql = " SELECT id FROM `news`  ORDER BY ID DESC LIMIT 1";
        $result = $db_obj->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $newsCounter = $row['id'] + 1;
        $sql = "INSERT INTO `news` (`id`, `text`, `photoname`, `photodir`, `date`)
        VALUES ('$newsCounter', '$submittedText', '$smallName', '$thumbnailPath', '$currentDate')";
        $result = $db_obj->query($sql);
    }
    $sql_all = "SELECT * FROM $tableName ORDER BY id DESC";
    $result_all = $db_obj->query($sql_all);

    if (!empty($result_all)) {
        echo '<div class="divUL">';
        echo "<h2 style='text-align: center;'>News</h2>";
        echo "<ul>";
        // mysqli_fetch_array — Fetch the next row of a result set
        // the parameter mode allows us to choose between associative, numberic or both arrays
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
        <h1 style='text-align: center;'>Upload Text and Image</h1>

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