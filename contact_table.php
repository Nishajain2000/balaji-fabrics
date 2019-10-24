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
$sql = "CREATE TABLE contact(
client_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
client_name VARCHAR(255),
email VARCHAR(20),
contact INT(11),
message TEXT,
date TIMESTAMP
)";

if ($db->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $db->error;
}

$db->close();
?>
