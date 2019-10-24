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
$sql = "CREATE TABLE pattern_des(
pattern_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
dname VARCHAR(50),
description TEXT,
mimage LONGBLOB,
weight VARCHAR(50),
width VARCHAR(50),
composition VARCHAR(100),
design VARCHAR(50),
weave VARCHAR(50),
dye VARCHAR(40),
label VARCHAR(50),
selvedge VARCHAR(100)
)";

if ($db->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $db->error;
}

$db->close();
?>
