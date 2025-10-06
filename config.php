<?php
$host = "localhost";
$user = "root";
$pass = "R12#$5si";
$db   = "world_inovation";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>