<?php
session_start();
$images = [
    "res/img/hotel1.webp",
    "res/img/hotel2.jpg",
    "res/img/hotel3.jpg",
    "res/img/hotel4.jpg",
    "res/img/hotel5.jpg",
];

$currentIndex = isset($_GET['index']) ? (int) $_GET['index'] : 0;

if ($currentIndex >= count($images)) {
    $currentIndex = 0;
}

if ($currentIndex < 0) {
    $currentIndex = count($images) - 1;
}

$currentImage = $images[$currentIndex];
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="res/css/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
</head>

<body>
    <?php include './inc/navigation.php'; ?>

    <div class="gallery">
        <img id="galleryImage" src="<?php echo $currentImage; ?>" alt="Gallery Image">
        <div class="nav left">
            <a href="?index=<?php echo $currentIndex - 1; ?>">&#10094;</a>
        </div>
        <div class="nav right">
            <a href="?index=<?php echo $currentIndex + 1; ?>">&#10095;</a>
        </div>
    </div>
</body>

</html>