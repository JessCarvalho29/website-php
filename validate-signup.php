<?php
require_once('./inc/database.php');
require './inc/header.php';

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm'];

$validateInformations = true;

if (empty($firstName)) {
  echo '<p>First name is a required information to sign up</p>';
  // echo '<a href="login.php">Come back to register</a>';  
  $validateInformations = false;
}
if (empty($lastName)) {
  echo '<p>Last name is a required information to sign up</p>';
  // echo '<a href="login.php">Come back to register</a>';
  $validateInformations = false;
}
if (empty($username)) {
  echo '<p>Username is a required information to sign up</p>';
  // echo '<a href="login.php">Come back to register</a>';
  $validateInformations = false;
}
if ((empty($password)) || ($password != $confirmPassword)) {
  echo '<p>Passwords does not match</p>';
  // echo '<a href="login.php">Come back to register</a>';
  $validateInformations = false;
}

$validationUsername = $database->validateUsername($username);
$row = mysqli_fetch_assoc($validationUsername);

if(isset($row['COUNT(username)']) && !empty($row['COUNT(username)'])){
  echo '<p>'.$username.' username already exists. Please try another one.</p>';
  // echo '<a href="login.php">Come back to register</a>';
  $validateInformations = false;
} 

if($validateInformations){

  $password = hash('sha512', $password);

  $database->executeSignin($firstName, $lastName, $username, $password);

  header("Location: signin.php"); 	
} else {
  echo '<a href="login.php">Come back to register</a>';
}

require './inc/footer.php'; 

?>
