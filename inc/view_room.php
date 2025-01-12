<head>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" href="../res/css/style.css">
</head>

<body>
    <?php
    session_start();
    $tableName = 'rooms';
    include 'navigation.php';
    include 'db.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_SESSION['isAdmin'] && isset($_POST['reservation_id']) && isset($_POST['new_status'])) {
            $reservation_id = $_POST['reservation_id'];
            $new_status = $_POST['new_status'];
            $sql = "UPDATE `rooms` SET status='$new_status' WHERE id='$reservation_id'";
            $result = $db_obj->query($sql);
            echo "<p class='text-center'>Status successfully changed.</p>";
        }
    }

    echo "<h2 style='text-align: center;'>Your Reservations</h2>";
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
            echo "<p>Reservation ID: " . $row['id'] . " - Status: {$row['status']}";
            if ($_SESSION['isAdmin']) {
                echo " - User: " . $row['email'];
            }
            echo "<br>";
            echo "Details: Booking data: {$row['date']}, Check-in: {$row['checkin']}, Check-out: {$row['checkout']}, Breakfast: {$row['breakfast']}, Parking: {$row['parking']}, Pets: {$row['pets']}<br>";
            //user==admin, display a form to change the reservation status
            if ($_SESSION['isAdmin']) {
                echo "<form method='POST' action=''>";
                echo "<input type='hidden' name='reservation_id' value='" . $row['id'] . "'>";
                echo "<select name='new_status'>";
                echo "<option value='new'" . ($row['status'] == 'new' ? ' selected' : '') . ">New</option>";
                echo "<option value='in progress'" . ($row['status'] == 'in progress' ? ' selected' : '') . ">In Progress</option>";
                echo "<option value='done'" . ($row['status'] == 'done' ? ' selected' : '') . ">Done</option>";
                echo "</select>";
                echo "<input type='submit' value='Change Status'>";
                echo "</form>";
            }
            echo "</p>";
        }
    } else {
        echo "<p>No reservations found.</p>";
    }
    ?>
</body>