<?php
require_once('./inc/database.php');
include './inc/header.php';

$username = $_POST['username'];
$password = hash('sha512', $_POST['password']);

$validateInformations = true;

if (empty($username)) {
  echo '<p>Username is a required information to sign in</p>';
  echo '<a href="signin.php">Come back to Login</a>';  
  $validateInformations = false;
}
if (empty($password)) {
  echo '<p>Password is a required information to sign in</p>';
  echo '<a href="signin.php">Come back to Login</a>';
  $validateInformations = false;
}

if($validateInformations){
  $DBreturn = $database->getLoginInfo($username, $password);

  $result = mysqli_fetch_assoc($DBreturn);

  echo $result;

  if(isset($result['username']) && !empty($result['username'])){

    session_start();
    $_SESSION['timeout'] = time() + 30*60;

    $_SESSION['user_id'] = $result['user_id'];
    $firstName = $result['firstName'];
    $lastName = $result['lastName'];

    setcookie('firstName', $firstName, time() + 30*60, '/');
    setcookie('lastName', $lastName, time() + 30*60, '/');

    header('Location: view.php');

  } else {
    echo '<p>Invalid Login</p>';
    echo '<a href="signin.php">Come back to Login</a>';
  }

}

require './inc/footer.php'; 

?>
