<?php
session_start();
include "config.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

// First, check if username exists
$sql = "SELECT * FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if($row = $result->fetch_assoc()) {
    // Username exists, now check password
    if($row['password'] === $password) {
        $_SESSION['role'] = $row['role'];
        $_SESSION['username'] = $row['username'];
        if($row['role'] === 'admin') {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: inventions.php");
            exit();
        }
    } else {
        // Wrong password
        $_SESSION['login_error'] = "Incorrect password!";
        header("Location: login.php");
        exit();
    }
} else {
    // Username does not exist
    $_SESSION['login_error'] = "User does not exist. Please sign up.";
    header("Location: signup.php");
    exit();
}
?>
