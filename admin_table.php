<?php

$servername = "localhost";
$username = "ladiesin_b1";
$password = "b1@2019";
$dbname = "ladiesin_batch1";
// Create connection
$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE admin_login(
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255),
password VARCHAR(20)
)";

if ($db->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $db->error;
}

$db->close();
?>
