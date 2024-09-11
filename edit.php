<?php
require_once('./inc/database.php');

if (!empty($_GET['editID'])) {
  $editId = $_GET['editID'];
  $result = $database->displayRecordById($editId);
}

if (!empty($_POST)) {

  $quantity = $_POST['quantity'];
  $size = $_POST['pizza-size'];
  $shape = $_POST['shape-pizza'];
  $topping = $_POST['toppings'];
  $crust = $_POST['crust'];
  $takeoutOrDelivery = $_POST['takeout-delivery'];
  $name = $_POST['name'];
  $phone = $_POST['phone'];

  $id = $result['order_id'];
  $result = $database->updateRecord($quantity, $size, $shape, $topping, $crust, $takeoutOrDelivery, $name, $phone, $id);
  header("Location: view.php?msg1=update");
  exit();
}

require_once './inc/header.php';

?>

<main class="home-container">
  <div class="home-image">  
  </div>

  <div class="home-form">
    <form method="POST" class="form-pizza">
      <div class="first-column">
        <label for="quantity">Number of Pizzas</label>
        <select name="quantity" id="quantity" style="font-size: 15px">
          <option value="1" <?php if ($result['quantity'] == 1) echo 'selected'; ?>>1</option>
          <option value="2" <?php if ($result['quantity'] == 2) echo 'selected'; ?>>2</option>
          <option value="3" <?php if ($result['quantity'] == 3) echo 'selected'; ?>>3</option>
          <option value="4" <?php if ($result['quantity'] == 4) echo 'selected'; ?>>4</option>
        </select>
        <br ><br >
        <label for="size-pizza">Size of the Pizza</label><br >
        <input type="radio" id="small-pizza" name="pizza-size" value="small" <?php if ($result['size_pizza'] == 'small') echo 'checked'; ?> required >
        <label for="small-pizza">Small Size</label><br >
        <input type="radio" id="medium-pizza" name="pizza-size" value="medium" <?php if ($result['size_pizza'] == 'medium') echo 'checked'; ?> required >
        <label for="medium-pizza">Medium Size</label><br >
        <input type="radio" id="large-pizza" name="pizza-size" value="large" <?php if ($result['size_pizza'] == 'large') echo 'checked'; ?> required >
        <label for="large-pizza">Large Size</label><br >
        <br ><br >
        <label for="shape-pizza">Shape of the Pizza</label><br >
        <input type="radio" id="round" name="shape-pizza" value="round" <?php if ($result['shape'] == 'round') echo 'checked'; ?> required >
        <label for="round">Round pizza</label><br >
        <input type="radio" id="square" name="shape-pizza" value="square" <?php if ($result['shape'] == 'square') echo 'checked'; ?> required >
        <label for="square">Square pizza</label><br >
        <br ><br >
        <label for="toppings">Choose your Toppings</label><br >
        <input type="radio" id="pepperoni" name="toppings" value="pepperoni" <?php if ($result['topping'] == 'pepperoni') echo 'checked'; ?> required >
        <label for="pepperoni">Pepperoni</label><br >
        <input type="radio" id="mushrooms" name="toppings" value="mushrooms" <?php if ($result['topping'] == 'mushrooms') echo 'checked'; ?> required >
        <label for="mushrooms">Mushrooms</label><br >
        <input type="radio" id="onions" name="toppings" value="onions" <?php if ($result['topping'] == 'onions') echo 'checked'; ?> required >
        <label for="onions">Onions</label><br >
        <input type="radio" id="bacon" name="toppings" value="bacon" <?php if ($result['topping'] == 'bacon') echo 'checked'; ?> required >
        <label for="bacon">Bacon</label><br >
        <input type="radio" id="ham" name="toppings" value="ham" <?php if ($result['topping'] == 'ham') echo 'checked'; ?> required >
        <label for="ham">Ham</label><br >
        <input type="radio" id="tomatoes" name="toppings" value="tomatoes" <?php if ($result['topping'] == 'tomatoes') echo 'checked'; ?> required >
        <label for="tomatoes">Tomatoes</label><br >
      </div>
      <div class="second-column">
        <label for="crust">Crust of your Pizza</label><br >
        <input type="radio" id="thin" name="crust" value="thin" <?php if ($result['crust'] == 'thin') echo 'checked'; ?> required >
        <label for="thin">Thin</label><br >
        <input type="radio" id="thick" name="crust" value="thick" <?php if ($result['crust'] == 'thick') echo 'checked'; ?> required >
        <label for="thick">Thick</label><br >
        <input type="radio" id="stuffed" name="crust" value="stuffed" <?php if ($result['crust'] == 'stuffed') echo 'checked'; ?> required >
        <label for="stuffed">Stuffed</label><br >
        <br ><br >
        <label for="takeout-delivery">Choose one option:</label><br >
        <input type="radio" id="takeout" name="takeout-delivery" value="takeout" <?php if ($result['delivery_takeout'] == 'takeout') echo 'checked'; ?> required >
        <label for="takeout">Take out</label><br >
        <input type="radio" id="delivery" name="takeout-delivery" value="delivery" <?php if ($result['delivery_takeout'] == 'delivery') echo 'checked'; ?> required >
        <label for="delivery">Delivery</label><br >

        <div id="takeoutForm">
          <br >
          <grid class="delivery-takeout-grid-css">
            <div class="right">
              <label for="name">Full name:</label><br >
              <label for="phone">Phone number:</label>
            </div>
            <div class="left">
              <input type="text" id="nameTakeout" name="name" value="<?php echo $result['client_name']; ?>" required ><br >
              <input type="tel" id="phoneTakeout" name="phone" value="<?php echo $result['phone']; ?>" required ><br >
            </div>
          </grid>
        </div>
        <br>
        <button class="send-button" type="submit" name="submitForm" id="submitButton">
          Send order
        </button>
      </div>
    </form>

  </div>
</main>

<?php require './inc/footer.php'; ?>
