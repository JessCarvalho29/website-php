<?php
include './inc/header.php';
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