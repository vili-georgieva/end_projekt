<?php
session_start();
include 'navigation.php';

echo "<h2>Your Reservations</h2>";

if (isset($_SESSION['reservations']) && !empty($_SESSION['reservations'])) {
    foreach ($_SESSION['reservations'] as $index => $reservation) {
        echo "<p>Reservation ID: " . ($index + 1) . " - Status: {$reservation['status']}<br>";
        echo "Details: Check-in: {$reservation['check_in_date']}, Check-out: {$reservation['check_out_date']}, Breakfast: {$reservation['breakfast']}, Parking: {$reservation['parking']}, Pets: {$reservation['pets']}</p>";
    }
} else {
    echo "<p>No reservations found.</p>";
}
?>