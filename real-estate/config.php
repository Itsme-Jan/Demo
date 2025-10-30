<?php
session_start();

$servername = "localhost";
$username = "root"; // XAMPP default
$password = "";     // XAMPP default
$dbname = "prairie_hills";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Helper function to sanitize input
function ($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}
?>
