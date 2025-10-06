<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']);
    $repassword = md5($_POST['repassword']);

    // check if username already exists
    $check = $conn->prepare("SELECT id FROM users WHERE username=?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['signup_error'] = "Username already exists!";
        header("Location: admin_signup.php");
        exit;
    } else {
        if ($password === $repassword) {
            // insert as admin role
            $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')");
            $stmt->bind_param("ss", $username, $password);

            if ($stmt->execute()) {
                $_SESSION['signup_success'] = "Admin account created successfully! Please login.";
                header("Location: login.php");
                exit;
            } else {
                $_SESSION['signup_error'] = "Something went wrong. Please try again.";
                header("Location: admin_signup.php");
                exit;
            }
        } else {
            $_SESSION['signup_error'] = "Passwords do not match!";
            header("Location: admin_signup.php");
            exit;
        }
    }
}
?>
