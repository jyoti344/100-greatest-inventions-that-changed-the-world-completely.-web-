<?php
session_start();
include "config.php";

$username = $_POST['username'];
$password = md5($_POST['password']); 

$sql = "SELECT * FROM users WHERE username=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if($row = $result->fetch_assoc()) {
    $_SESSION['role'] = $row['role'];
    $_SESSION['username'] = $row['username'];
    if($row['role'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: inventions.php");
    }
} else {
    header("Location: = signup.php");
}
?>