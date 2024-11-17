<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../res/css/style.css"> 
</head>
<body>

<?php 
session_start(); 

// Hardcoded user data for demonstration
$hardcodedEmail = "user@example.com";
$hardcodedPassword = "password123";
$hardcodedFirstName = "John";
$hardcodedLastName = "Doe";

// Check if the user is already logged in
if (!isset($_SESSION['logged_in_user'])) {
    echo "<h2>Please log in to view your profile.</h2>";
    echo '<a href="login.php">Login</a>'; // Link to the login page
    exit();
}

// Display welcome message
echo "<h2>Welcome, " . htmlspecialchars($_SESSION['logged_in_user']) . "!</h2>";

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_profile'])) {
        // Update profile data
        $newFirstName = trim($_POST['first_name']);
        $newLastName = trim($_POST['last_name']);
        // Here you would typically update the session or database with new values
        // For demonstration, we will just echo the new values
        echo "<p>Profile updated: $newFirstName $newLastName</p>";
    } elseif (isset($_POST['change_password'])) {
        // Change password
        $oldPassword = trim($_POST['old_password']);
        $newPassword = trim($_POST['new_password']);
        $repeatNewPassword = trim($_POST['repeat_new_password']);
        
        // Check if the old password is correct
        if ($oldPassword !== $hardcodedPassword) {
            echo "<p class='error'>Error: Old password is incorrect.</p>";
        } elseif ($newPassword !== $repeatNewPassword) {
            echo "<p class='error'>Error: New passwords do not match.</p>";
        } else {
            // Update the password (in a real application, you would hash it)
            // For demonstration, we will just echo a success message
            echo "<p>Password changed successfully!</p>";
            // Update the hardcoded password (for demonstration purposes)
            $hardcodedPassword = $newPassword; // This won't persist across requests
        }
    }
}
?>

<h3>Your Profile</h3>
<form method="post">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($hardcodedFirstName); ?>" required>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($hardcodedLastName); ?>" required>

    <input type="submit" name="update_profile" value="Update Profile">
</form>

<h3>Change Password</h3>
<form method="post">
    <label for="old_password">Old Password:</label>
    <input type="password" id="old_password" name="old_password" required>

    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required>

    <label for="repeat_new_password">Repeat New Password:</label>
    <input type="password" id="repeat_new_password" name="repeat_new_password" required>

    <input type="submit" name="change_password" value="Change Password">
</form>

</body>
</html>
