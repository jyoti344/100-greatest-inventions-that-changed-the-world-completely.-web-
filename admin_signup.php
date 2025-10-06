<?php
session_start();
include_once "navbar.php";
include "config.php";

// Only allow access if logged in AND user is admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="auth-container">
    <h2>Create New Admin Account</h2>

    <?php if(isset($_SESSION['signup_error'])): ?>
      <div class="alert alert-danger"><?php echo $_SESSION['signup_error']; unset($_SESSION['signup_error']); ?></div>
    <?php endif; ?>

    <?php if(isset($_SESSION['signup_success'])): ?>
      <div class="alert alert-success"><?php echo $_SESSION['signup_success']; unset($_SESSION['signup_success']); ?></div>
    <?php endif; ?>

    <form method="post" action="process_admin_signup.php">
      <input type="email" name="username" class="form-control mb-3" placeholder="Enter admin email" required>
      <input type="password" name="password" class="form-control mb-3" placeholder="Choose password" required>
      <input type="password" name="repassword" class="form-control mb-3" placeholder="Re-enter password" required>
      <button type="submit" class="btn btn-success w-100">Create Admin</button>
    </form>

    <p class="mt-3 text-center">
      <a href="admin.php">← Back to Admin Panel</a>
    </p>
  </div>
</div>
</body>
</html>
