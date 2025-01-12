<!DOCTYPE html>
<html>

<head>
    <title>New Reservation</title>
    <link rel="stylesheet" href="../res/css/style.css">
    <?php include 'head.php'; ?>
</head>

<body>
    <?php
    session_start();
    include 'navigation.php';
    include 'db.php';
    $tableName = 'reg';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $check_in_date = $_POST['check_in_date'];
        $check_out_date = $_POST['check_out_date'];
        $breakfast = isset($_POST['breakfast']) ? 'Yes' : 'No';
        $parking = isset($_POST['parking']) ? 'Yes' : 'No';
        $pets = $_POST['pets'] ?? 'None';

        if (strtotime($check_out_date) > strtotime($check_in_date)) {
            $currentDate = date("Y-m-d H:i:s");
            $_SESSION['reservations'][] = [
                'check_in_date' => $check_in_date,
                'check_out_date' => $check_out_date,
                'breakfast' => $breakfast,
                'parking' => $parking,
                'pets' => $pets,
                'status' => 'new',
            ];
            $_SESSION['co']++;
            $counter = $_SESSION['co'];
            echo "<h2 class='text-center'>Reservation successfully created.</h2>";
            if ($_SESSION['isAdmin']) {
                $email = $_SESSION['admin_email'];
            } else {
                $email = $_SESSION['user_logged_in'];
            }
            $sql = "INSERT INTO `rooms` (`checkin`, `checkout`, `breakfast`, `parking`, `pets`, `id`, `status`, `date`, `email`) 
        VALUES ('$check_in_date', '$check_out_date', 
        '$breakfast', '$parking', '$pets',  '$counter', 'new', '$currentDate', '$email')";
            //echo $check_in_date;
            $result = $db_obj->query($sql);
        } else {
            echo '<div class="error-messages text-center border border-danger rounded p-3" style="color: red;">';
            echo "<p class='font-weight-bold'>";
            echo "Error: Check-out date must be later than check-in date.";
            echo "</p>";
            echo '</div>';
        }

    }
    ?>
    <h2 style='text-align: center;'>Create a New Room Reservation</h2>
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