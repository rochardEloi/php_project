<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");

// Function to safely close the connection
function closeConnection() {
    global $conn;
    if ($conn) {
        $conn->close();
    }
}
?>
