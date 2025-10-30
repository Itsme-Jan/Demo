<?php
$host = "localhost";
$username = "root";         // Replace with your DB username
$password = "";         // Replace with your DB password
$database = "real_estate"; // Replace with your DB name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
