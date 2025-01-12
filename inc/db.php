<?php
session_start();
require_once('../config/dbaccess.php'); //to retrieve connection details
$db_obj = new mysqli($host, $user, $password, $database);
if ($db_obj->connect_error) {
    echo "<p>";
    echo "Connection Error: " . $db_obj->connect_error;
    echo "<p>";
    exit();
}
?>