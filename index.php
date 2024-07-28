<?php
include './inc/header.php';
require_once('./inc/database.php');

if (isset($_GET['msg1']) == "register_order") {
  echo "<div> Order recorded! Please, upload the payment comprovant.</div>";
  echo '<a href="view.php">View Order</a>';
}

if (isset($_POST['submitForm'])) {

  $quantity = $_POST['quantity'];
  $size = $_POST['pizza-size'];
  $shape = $_POST['shape-pizza'];
  $topping = $_POST['toppings'];
  $crust = $_POST['crust'];
  $takeoutOrDelivery = $_POST['takeout-delivery'];
  $name = $_POST['name'];
  $phone = $_POST['phone'];

  $result = $database->executeQuery($quantity, $size, $shape, $topping, $crust, $takeoutOrDelivery, $name, $phone);
  
  header('Location: index.php?msg1=register_order');

}

$uploadSuccess = false;
$validFile = true;
if (isset($_POST['submitImage'])) {
  $totalFiles = count($_FILES['files']['name']);

  for ($i = 0; $i < $totalFiles; $i++) {
    $fileName = $_FILES['files']['name'][$i];

    date_default_timezone_set("America/Toronto");

    $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
    $fileNameExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $newFileName = $fileNameWithoutExtension . date("ymdHis") . "-" . $i . "." . $fileNameExtension;

    $pathSaveFile = './uploads/' . $newFileName;

    $validateExtension = array("png", "jpeg", "jpg");

    if (in_array($fileNameExtension, $validateExtension)) {
      if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $pathSaveFile)) {

        $database->executeImage($newFileName, $pathSaveFile);

        $uploadSuccess = true;
      } 
    } else {
      $validFile = false;
    }
  }
}
?>

<main class="home-container">
  <div class="home-image">
    <img id="body-image" src="images/the-best-pizza.png" alt="The Best Pizza" />
  </div>

  <div class="home-form">
    <form class="form-pizza" method="post">
      <div class="first-column">
        <label for="quantity">Number of Pizzas</label>
        <select name="quantity" id="quantity" style="font-size: 15px">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
        <br /><br />
        <label for="size-pizza">Size of the Pizza</label><br />
        <input type="radio" id="small-pizza" name="pizza-size" value="small" required />
        <label for="small-pizza">Small Size</label><br />
        <input type="radio" id="medium-pizza" name="pizza-size" value="medium" required />
        <label for="medium-pizza">Medium Size</label><br />
        <input type="radio" id="large-pizza" name="pizza-size" value="large" required />
        <label for="large-pizza">Large Size</label><br />
        <br /><br />
        <label for="shape-pizza">Shape of the Pizza</label><br />
        <input type="radio" id="round" name="shape-pizza" value="round" required />
        <label for="round">Round pizza</label><br />
        <input type="radio" id="square" name="shape-pizza" value="square" required />
        <label for="square">Square pizza</label><br />
        <br /><br />
        <label for="toppings">Choose your Toppings</label><br />
        <input type="radio" id="pepperoni" name="toppings" value="pepperoni" required />
        <label for="pepperoni">Pepperoni</label><br />
        <input type="radio" id="mushrooms" name="toppings" value="mushrooms" required />
        <label for="mushrooms">Mushrooms</label><br />
        <input type="radio" id="onions" name="toppings" value="onions" required />
        <label for="onions">Onions</label><br />
        <input type="radio" id="bacon" name="toppings" value="bacon" required />
        <label for="bacon">Bacon</label><br />
        <input type="radio" id="ham" name="toppings" value="ham" required />
        <label for="ham">Ham</label><br />
        <input type="radio" id="tomatoes" name="toppings" value="tomatoes" required />
        <label for="tomatoes">Tomatoes</label><br />
      </div>
      <div class="second-column">
        <label for="crust">Crust of your Pizza</label><br />
        <input type="radio" id="thin" name="crust" value="thin" required />
        <label for="thin">Thin</label><br />
        <input type="radio" id="thick" name="crust" value="thick" required />
        <label for="thick">Thick</label><br />
        <input type="radio" id="stuffed" name="crust" value="stuffed" required />
        <label for="stuffed">Stuffed</label><br />
        <br /><br />
        <label for="takeout-delivery">Choose one option:</label><br />
        <input type="radio" id="takeout" name="takeout-delivery" value="takeout" onchange="deliveryForm(this.id)" required />
        <label for="takeout">Take out</label><br />
        <input type="radio" id="delivery" name="takeout-delivery" value="delivery" onchange="deliveryForm(this.id)" required />
        <label for="delivery">Delivery</label><br />

        <div id="takeoutForm">
          <br />
          <grid class="delivery-takeout-grid-css">
            <div class="right">
              <label for="name">Full name:</label><br />
              <label for="phone">Phone number:</label>
            </div>
            <div class="left">
              <input type="text" id="nameTakeout" name="name" required /><br />
              <input type="tel" id="phoneTakeout" name="phone" required /><br />
            </div>
          </grid>
        </div>
        <br>
        <button class="send-button" type="submit" name="submitForm" id="submitForm">
          Send order
        </button>
      </div>
    </form>

    <section class="form-input-image">
      <div class="title-form-image">Upload payment comprovant</div>
      <br />
      <form class="form-pizza" method="post" class="upload-image" enctype="multipart/form-data">
        <div>
          <input class="input-button" type='file' name='files[]' multiple />
        </div>
        <div>
          <input class="send-button" type="submit" value="Submit" name="submitImage" />
        </div>
      </form>
      <?php
      if ($uploadSuccess) {
        echo "<p>File upload successfully</p>";
      }
      if (!$validFile) {
        echo "<p>Upload image files only</p>";
      } ?>
    </section>
  </div>
</main>

<?php require './inc/footer.php'; ?>