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
$sql = "CREATE TABLE image_pattern(
img_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
pattern_id INT(11),
availability VARCHAR(50),
name_shades VARCHAR(50),
image VARCHAR(50)
)";

if ($db->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $db->error;
}

$db->close();
?>
