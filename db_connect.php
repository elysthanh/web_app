<?php
$servername = "localhost";  // Your database server (usually localhost)
$username = "root";         // Your database username
$password = "";             // Your database password
$dbname = "web_app";        // Your database name

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
