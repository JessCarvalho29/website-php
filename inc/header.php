<?php
require_once './inc/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style/stylehome.css" />
  <link rel="stylesheet" href="style/styleView.css">
  <link rel="stylesheet" href="style/styleViewImage.css">
  <link rel="stylesheet" href="style/styleLogin.css">
  <link rel="shortcut icon" href="images/favicon.webp" type="image/x-icon" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <title>Pizza delivery</title>
</head>

<?php

if (!isset($_SESSION['user_id']) || (time() > $_SESSION['timeout'])) {
  if (session_status() == PHP_SESSION_ACTIVE) {
    session_unset();
    session_destroy();
  }
?>

  <body>
    <header>
      <div class="left-side">
        <img src="images/logo2.png" class="logo" />
        <h1 class="name-site">Authentic Italian Pizza</h1>
      </div>
      <div class="middle-side">
        <nav>
          <ul>
            <li><a href="index.php">Order pizza</a></li>
            <li><a href="view.php">View your Orders</a></li>
            <li><a href="view-images.php">View Uploads</a></li>
          </ul>
        </nav>
      </div>

      <div class="right-side">
        <a href="login.php" class="send-button">Login</a>
      </div>
    </header>

  <?php
} else {
  ?>

    <body>
      <header>
        <div class="left-side">
          <img src="images/logo2.png" class="logo" />
          <h1 class="name-site">Authentic Italian Pizza</h1>
        </div>
        <div class="middle-side">
          <nav>
            <ul>
              <li><a href="index.php">Order pizza</a></li>
              <li><a href="view.php">View your Orders</a></li>
              <li><a href="view-images.php">View Uploads</a></li>
            </ul>
          </nav>
        </div>

        <div class="right-side">
          <a href="logout.php" class="send-button">Logout</a>
        </div>
      </header>

    <?php
  }
    ?>