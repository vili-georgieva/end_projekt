<?php
session_start();
$tableName = 'rooms';
require_once('../config/dbaccess.php'); //to retrieve connection details
$db_obj = new mysqli($host, $user, $password, $database);
include 'navigation.php';

echo "<h2>Your Reservations</h2>";
$sql = "SELECT * FROM $tableName";
$result = $db_obj->query($sql);
$rows = [];
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $rows[] = $row;
}

if (!empty($rows)) {
    foreach ($rows as $row) {
        echo "<p>Reservation ID: " . $row['id'] . " - Status: {$row['status']}<br>";
        echo "Details: Check-in: {$row['checkin']}, Check-out: {$row['checkout']}, Breakfast: {$row['breakfast']}, Parking: {$row['parking']}, Pets: {$row['pets']}</p>";
    }
} else {
    echo "<p>No reservations found.</p>";
}
?>