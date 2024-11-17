<?php
session_start();
include 'navigation.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $breakfast = isset($_POST['breakfast']) ? 'Yes' : 'No';
    $parking = isset($_POST['parking']) ? 'Yes' : 'No';
    $pets = $_POST['pets'] ?? 'None';

    if (strtotime($check_out_date) > strtotime($check_in_date)) {
        echo "Reservation successfully created.";
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
