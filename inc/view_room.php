<?php
session_start();
$tableName = 'rooms';
require_once('../config/dbaccess.php'); //to retrieve connection details
$db_obj = new mysqli($host, $user, $password, $database);
include 'navigation.php';

echo "<h2>Your Reservations</h2>";
if ($_SESSION['isAdmin']) {
    $email = $_SESSION['admin_email'];
    $sql = "SELECT * FROM $tableName";
} else {
    $email = $_SESSION['user_logged_in'];
    $sql = "SELECT * FROM $tableName WHERE email='$email'";
}

$result = $db_obj->query($sql);
$rows = [];
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $rows[] = $row;
}

if (!empty($rows)) {
    foreach ($rows as $row) {
        echo "<p>Reservation ID: " . $row['id'] . " - Status: {$row['status']}<br>";
        echo "Details: Booking data: {$row['date']}, Check-in: {$row['checkin']}, Check-out: {$row['checkout']}, Breakfast: {$row['breakfast']}, Parking: {$row['parking']}, Pets: {$row['pets']}</p>";
    }
} else {
    echo "<p>No reservations found.</p>";
}
?>