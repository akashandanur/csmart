<?php
// config.php
$servername = "localhost";
$username = "root";
$password = "Cds@12345";
$dbname = "teacher_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
