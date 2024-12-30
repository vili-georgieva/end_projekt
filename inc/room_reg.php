<?php
session_start();
include 'navigation.php';
$tableName = 'reg';
require_once('../config/dbaccess.php'); //to retrieve connection details
$db_obj = new mysqli($host, $user, $password, $database);
if ($db_obj->connect_error) {
    echo "Connection Error: " . $db_obj->connect_error;
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $breakfast = isset($_POST['breakfast']) ? 'Yes' : 'No';
    $parking = isset($_POST['parking']) ? 'Yes' : 'No';
    $pets = $_POST['pets'] ?? 'None';

    //$pets = $_POST['pets'];
    if (strtotime($check_out_date) > strtotime($check_in_date)) {
        $_SESSION['reservations'][] = [
            'check_in_date' => $check_in_date,
            'check_out_date' => $check_out_date,
            'breakfast' => $breakfast,
            'parking' => $parking,
            'pets' => $pets,
            'status' => 'new'
        ];
        $_SESSION['co']++;
        $counter = $_SESSION['co'];
        echo "Reservation successfully created.";
        //echo $check_in_date, $check_out_date, $breakfast, $parking, $pets;
        //$sq = "INSERT INTO `rooms` (`checkin`, `checkout`, `breakfast`, `parking`, `pets`) 
        //VALUES ('2022-10-10', '2022-11-12', 'a', '$parking' , 'a')";
        $sql = "INSERT INTO `rooms` (`checkin`, `checkout`, `breakfast`, `parking`, `pets`, `id`, `status`) 
        VALUES ('$check_in_date', '$check_out_date', 
        '$breakfast', '$parking', '$pets',  '$counter', 'new')";
        //echo $check_in_date;
        $result = $db_obj->query($sql);
        //echo "aaaa";

    } else {
        echo "Error: Check-out date must be later than check-in date.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>New Reservation</title>
    <link rel="stylesheet" href="../res/css/style.css">
</head>

<body>
    <h2>Create a New Room Reservation</h2>
    <form method="POST">
        <label for="check_in_date">Check-in Date:</label>
        <input type="date" name="check_in_date" required><br><br>

        <label for="check_out_date">Check-out Date:</label>
        <input type="date" name="check_out_date" required><br><br>

        <label for="breakfast">Include Breakfast:</label>
        <input type="checkbox" name="breakfast"><br><br>

        <label for="parking">Include Parking:</label>
        <input type="checkbox" name="parking"><br><br>

        <label for="pets">Bringing Pets:</label>
        <input type="text" name="pets" placeholder="Type of pet"><br><br>

        <input type="submit" value="Submit Reservation">
    </form>
</body>

</html>