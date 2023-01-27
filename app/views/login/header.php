<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | MyZoo</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://bootswatch.com/5/minty/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MYZOO | Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <?php if(!isset($_SESSION['usersId'])) : ?>
        <!--<li class="nav-item">
          <a class="nav-link" href="./signup.php">Sign Up</a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link" href="./login.php">Login</a>
        </li>
        <?php else: ?>
            <li class="nav-item">
                <a href="../../controllers/Users.php?q=logout">Logout</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
