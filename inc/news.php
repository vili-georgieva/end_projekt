<!DOCTYPE html>
<html lang="en">

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

    if (!isset($_SESSION['submitted_texts'])) {
        $_SESSION['submitted_texts'] = [];
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uploaddir = '../uploads/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        $uploadedFilePath = '';
        $imageFileType = strtolower(pathinfo($uploadfile,PATHINFO_EXTENSION));
        //debug_to_console("filetype ".$imageFileType);
        echo "<p>type :".$imageFileType.".</p>";
        //print_r($_FILES);
        if ($_FILES['userfile']['type'] != "image/png"
           // $imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
            //|| $imageFileType != "gif"
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

        $_SESSION['submitted_texts'][] = [
            'text' => $submittedText,
            'image' => $uploadedFilePath
        ];

    }
    if (!empty($_SESSION['submitted_texts'])) {
        echo '<div class="divUL">';
        echo "<h2>All Submitted Texts:</h2>";
        echo "<ul>";

        foreach (array_reverse($_SESSION['submitted_texts']) as $entry) {
            echo "<li>";
            echo "<p>" . $entry['text'] . "</p>";

            if (!empty($entry['image'])) {
                echo "<img src='" . $entry['image'] . "' alt='Uploaded Image' style='max-width: 100%; height: auto;' />";
            }
        }

        echo "</ul>";
        echo "</div>";
    }
    ?>

    <h1>Upload Text and Image</h1>

    <?php
    if (isset($_SESSION['isAdmin'])) {
        ?>
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