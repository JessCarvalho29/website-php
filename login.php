<?php
require_once './inc/session.php';
require_once('./inc/database.php');
// Sign Up
if (isset($_POST['signup'])) {
  $firstName = strtolower($_POST['first_name']);
  $lastName = strtolower($_POST['last_name']);
  $username = strtolower($_POST['username']);
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm'];

  $validateInformations = true;

  if (empty($firstName)) {
    echo '<p>First name is a required information to sign up</p>';
    $validateInformations = false;
  }
  if (empty($lastName)) {
    echo '<p>Last name is a required information to sign up</p>';
    $validateInformations = false;
  }
  if (empty($username)) {
    echo '<p>Username is a required information to sign up</p>';
    $validateInformations = false;
  }
  if ((empty($password)) || ($password != $confirmPassword)) {
    echo '<p>Passwords does not match</p>';
    $validateInformations = false;
  }

  $validationUsername = $database->validateUsername($username);
  $row = mysqli_fetch_assoc($validationUsername);

  if (isset($row['COUNT(username)']) && !empty($row['COUNT(username)'])) {
    echo '<p>' . $username . ' username already exists. Please try another one.</p>';
    $validateInformations = false;
  }

  if ($validateInformations) {

    $password = hash('sha512', $password);

    $database->executeSignin($firstName, $lastName, $username, $password);

    echo '<p>Successfully Registred! Please, Sign In</p>';
  }
}

// Sign In
if (isset($_POST['signin'])) {
  $username = strtolower($_POST['username']);
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

  if ($validateInformations) {
    $DBreturn = $database->getLoginInfo($username, $password);

    $result = mysqli_fetch_assoc($DBreturn);

    if (isset($result['username']) && !empty($result['username'])) {

      // if (session_status() == PHP_SESSION_NONE) {
      //   session_start();
      // }

      $_SESSION['timeout'] = time() + 30 * 60;
      $_SESSION['user_id'] = $result['user_id'];

      $firstName = $result['firstName'];
      $lastName = $result['lastName'];

      setcookie('firstName', $firstName, time() + 30 * 60, '/');
      setcookie('lastName', $lastName, time() + 30 * 60, '/');
      header('Location: view.php?msg3=signin', true);
      exit();
    } else {
      echo '<p>Invalid Login</p>';
    }
  }
}

require_once './inc/header.php';
?>

<main>
  <div class="row">
    <div class="column">
      <h3>Sign up</h3>
      <form class="form-sign" method="post" action="">
        <input class="text-input" name="first_name" type="text" placeholder="First Name" required />
        <input class="" name="last_name" type="text" placeholder="Last Name" required />
        <input class="" name="username" type="text" placeholder="Username" required />
        <input class="" name="password" type="password" placeholder="Password" required />
        <input class="" name="confirm" type="password" placeholder="Confirm Password" required />
        <input class="btn btn-light" type="submit" name="signup" value="Register" />
      </form>
    </div>

    <div class="column">
      <h3>Sign in</h3>
      <form class="form-sign" method="post" action="">
        <input class="" name="username" type="text" placeholder="Username" required />
        <input class="" name="password" type="password" placeholder="Password" required />
        <input class="" type="submit" name="signin" value="Login" />
      </form>
    </div>
  </div>

</main>

<?php require './inc/footer.php'; ?>