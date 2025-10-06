<?php 
session_start();
include "navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>World Government</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="page-container text-center text-white py-5">
  <h1 class="display-3 mb-4"><i class="fas fa-lightbulb"></i> 100 Greatest Inventions</h1>
  <p class="lead">Discover the innovations that shaped human civilization</p>
  <?php

  // Decide where the button should go
  $inventionsLink = "login.php"; // default
  if (isset($_SESSION['role']) && ($_SESSION['role'] === 'user' || $_SESSION['role'] === 'admin')) {
      $inventionsLink = "inventions.php";
  }
  ?>
  <a href="<?php echo $inventionsLink; ?>" class="btn btn-light btn-lg mt-3">Explore Inventions</a>

  <div class="row mt-5">
    <div class="col-md-4 mb-4"><div class="stats-card text-center text-white bg-light p-4 rounded"><h2>100</h2><p>Revolutionary Inventions</p></div></div>
    <div class="col-md-4 mb-4"><div class="stats-card text-center text-white bg-light p-4 rounded"><h2>50+</h2><p>Countries Represented</p></div></div>
    <div class="col-md-4 mb-4"><div class="stats-card text-center text-white bg-light p-4 rounded"><h2>2000+</h2><p>Years of Innovation</p></div></div>
  </div>
</div>
</body>
</html>