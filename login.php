<?php include_once "navbar.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="auth-container">
    <h2>Login</h2>

    <?php if(isset($_SESSION['signup_success'])): ?>
      <div class="alert alert-success"><?php echo $_SESSION['signup_success']; unset($_SESSION['signup_success']); ?></div>
    <?php endif; ?>

    <?php if(isset($_SESSION['login_error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?></div>
    <?php endif; ?>

    <form method="post" action="process_login.php">
      <input type="text" name="username" class="form-control mb-3" placeholder="Email" required>
      <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <p class="mt-3 text-center">
      Don’t have an account? <a href="signup.php">Sign Up here</a>
    </p>
  </div>
</div>
</body>
</html>
