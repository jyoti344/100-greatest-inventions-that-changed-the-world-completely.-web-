<?php
session_start();
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']); // for now, later use password_hash()
    $repassword =  md5($_POST['repassword']);

    // check if username already exists
    $check = $conn->prepare("SELECT id FROM users WHERE username=?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        // username exists → back to signup with error
        $_SESSION['signup_error'] = "Username already exists!";
        header("Location: signup.php");
        exit;
    } else {
        if($password == $repassword){
            // create new account
            $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
            $stmt->bind_param("ss", $username, $password);

            if ($stmt->execute()) {
                // success → redirect to login page
                $_SESSION['signup_success'] = "Account created successfully! Please login.";
                header("Location: login.php");
                exit;
            } else {
                // error → back to signup
                $_SESSION['signup_error'] = "Something went wrong. Please try again.";
                header("Location: signup.php");
                exit;
            }
        }
        else{
            $_SESSION['signup_error'] = "Both password must be same";
                header("Location: signup.php");
                exit;
        }
    }
}
?>
