<?php
session_start();
$tableName = 'reg';
require_once('../config/dbaccess.php'); //to retrieve connection details
$db_obj = new mysqli($host, $user, $password, $database);

$abc = 'adminn';
$sql = "SELECT usernme,password FROM $tableName"; // Corrected column name to 'username'
$result = $db_obj->query($sql);
$rows = [];
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $rows[] = $row;
}

$emailFound = false; // Reset the flag for each username

foreach ($rows as $row) {

    if ($row['usernme'] === $abc) {
        //echo "Username found: " . $row['usernme'] . "<br>";
        $emailFound = true; // Set the flag to true if found
        break; // Exit the inner loop since we found the username
    }

        
   
}
if ($emailFound){
    echo "found";
}else{
    echo "not found";
}
?>