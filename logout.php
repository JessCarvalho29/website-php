<?php session_start(); ?>
<?php
  session_unset();
  session_destroy();
  header('location: index.php');
  exit();
  require './inc/header.php';
  require './inc/footer.php';
?>
