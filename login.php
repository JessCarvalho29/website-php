<?php
include './inc/header.php';
?>

<main>
  <div class="row" >
    <div class="column">
      <h3>Sign up</h3>
      <form class="form-sign" method="post" action="./validate-signup.php">
            <input class="text-input" name="first_name" type="text" placeholder="First Name" required />
            <input class="" name="last_name" type="text" placeholder="Last Name" required />
            <input class="" name="username" type="text" placeholder="Username" required />
            <input class="" name="password" type="password" placeholder="Password" required />
            <input class="" name="confirm" type="password" placeholder="Confirm Password" required />
            <input class="btn btn-light" type="submit" name="submit" value="Register" />
      </form>
    </div>

    <div class="column">
      <h3>Sign in</h3>
      <form class="form-sign" method="post" action="./validate-signin.php">
            <input class="" name="username" type="text" placeholder="Username" required />
            <input class="" name="password" type="password" placeholder="Password" required />
            <input class="" type="submit" value="Login" />
      </form>
    </div>
  </div>

</main>

<?php require './inc/footer.php'; ?>