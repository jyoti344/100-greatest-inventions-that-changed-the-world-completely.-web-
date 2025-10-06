<?php include_once "navbar.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="auth-container">
    <h2>Create Account</h2>

    <?php if(isset($_SESSION['signup_error'])): ?>
      <div class="alert alert-danger"><?php echo $_SESSION['signup_error']; unset($_SESSION['signup_error']); ?></div>
    <?php endif; ?>

    <form method="post" action="process_signup.php">
      <input type="email" name="username" class="form-control mb-3" placeholder="Enter your email" required>
      <input type="password" name="password" class="form-control mb-3" placeholder="Choose a Password" required>
      <input type="password" name="repassword" class="form-control mb-3" placeholder="Re-enter the password" required>
      <button type="submit" class="btn btn-primary w-100">Sign Up</button>
    </form>

    <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
  </div>
</div>
</body>
</html>
