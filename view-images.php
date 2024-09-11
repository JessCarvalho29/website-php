<?php
require_once('./inc/database.php');

if (isset($_GET['msg1']) == "delete") {
  echo "<div>
        Image deleted successfully!
      </div>";
}

if (!empty($_GET['deleteID'])) {
  $deleteId = $_GET['deleteID'];
  $database->deleteImage($deleteId);
  header("Location:view-images.php?msg1=delete");
  exit();
}

require_once './inc/header.php';

if (session_status() == PHP_SESSION_NONE || (session_status() == PHP_SESSION_ACTIVE && !isset($_SESSION['user_id']))) {

?>

  <main>
    <div class="title-view-images">
      <h1>View Images</h1>
    </div>
    <div class="conteiner-images">
      <?php

      $DBreturn = $database->getDataImage();

      if ($DBreturn != null) {
        while ($result = mysqli_fetch_assoc($DBreturn)) {
      ?>
          <div class="uploaded-image-container">
            <img src="<?= $result['path'] ?>" alt="<?= $result['name'] ?>"></img>
            <p><?php echo $result["name"]; ?></p>
          </div>
        <?php
        }
      } else {
        ?>
        <tr>
          <td>No Records Found</td>
        </tr>
      <?php
      }
      ?>
    </div>
    <div class="button-div">
      <a href='view-images.php'><button class="refresh-button">Refresh Page</button></a>
    </div>

  </main>

<?php
} else {
?>
  <main>
    <div class="title-view-images">
      <h1>View Images</h1>
    </div>
    <div class="conteiner-images">
      <?php

      $DBreturn = $database->getDataImage();

      if ($DBreturn != null) {
        while ($result = mysqli_fetch_assoc($DBreturn)) {
      ?>
          <div class="uploaded-image-container">
            <img src="<?= $result['path'] ?>" alt="<?= $result['name'] ?>"></img>
            <p><?php echo $result["name"]; ?></p>
            <button><a class="action-button" href="view-images.php?deleteID=<?php echo $result['id'] ?>" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a></button>
          </div>
        <?php
        }
      } else {
        ?>
        <tr>
          <td>No Records Found</td>
        </tr>
      <?php
      }
      ?>
    </div>
    <div class="button-div button-div-image">
      <a href='view-images.php'><button class="refresh-button">Refresh Page</button></a>
    </div>

  </main>

<?php
}
require './inc/footer.php'; ?>
