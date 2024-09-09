<?php
require_once('./inc/database.php');
require './inc/header.php';

$username = $_POST['username'];
$password = hash('sha512', $_POST['password']);

$validateInformations = true;

if (empty($username)) {
  echo '<p>Username is a required information to sign in</p>'; 
  $validateInformations = false;
}
if (empty($password)) {
  echo '<p>Password is a required information to sign in</p>';
  $validateInformations = false;
}

if($validateInformations){
  $DBreturn = $database->getLoginInfo($username, $password);

  $result = mysqli_fetch_assoc($DBreturn);

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
  }

}

?>

<main>
  <div class="row">
    <div class="column">
      <h3>Please Sign in!</h3>
      <form class="form-sign signin" method="post" action="./validate-signin.php">
            <input class="" name="username" type="text" placeholder="Username" required />
            <input class="" name="password" type="password" placeholder="Password" required />
            <input class="" type="submit" value="signin" />
      </form>
    </div>
  </div>

</main>

<?php require './inc/footer.php'; ?>
