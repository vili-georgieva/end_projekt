<?php
// Start the session
session_start();

// Initialize an array to hold error messages
$errors = [];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $salutation = $_POST['salutation'];
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    // Validate the inputs
    if (empty($first_name)) {
        $errors[] = "First name is required.";
    }
    if (empty($last_name)) {
        $errors[] = "Last name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password !== $repeat_password) {
        $errors[] = "Passwords do not match.";
    }

    // If there are no errors, proceed with registration (e.g., save to database)
    if (empty($errors)) {
        // Here you would typically save the user data to a database
        // For demonstration, we'll just set a success message
        $_SESSION['success'] = "Registration successful!";
        header("Location: index.php"); // Redirect to the homepage or another page
        exit();
    } else {
        // Store errors in session to display on the form
        $_SESSION['errors'] = $errors;
        header("Location: register.php"); // Redirect back to the registration form
        exit();
    }
}
?>