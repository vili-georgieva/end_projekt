<?php
session_start();
include 'navigation.php';

$reservations = [
    ['id' => 1, 'status' => 'new', 'details' => 'Check-in: 2024-11-20, Check-out: 2024-11-22, Breakfast: Yes, Parking: No'],
    ['id' => 2, 'status' => 'confirmed', 'details' => 'Check-in: 2024-12-01, Check-out: 2024-12-05, Breakfast: No, Parking: Yes']
];

echo "<h2>Your Reservations</h2>";
foreach ($reservations as $reservation) {
    echo "<p>Reservation ID: {$reservation['id']} - Status: {$reservation['status']}<br>";
    echo "Details: {$reservation['details']}</p>";
}
?>
