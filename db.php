<?php
$servername = "localhost"; // Database server name
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "eventRegistration"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8
$conn->set_charset("utf8");
?>
