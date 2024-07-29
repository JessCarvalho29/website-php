<?php
require_once('./inc/database.php');
include './inc/header.php';

if (!empty($_GET['deleteID'])) {
  $deleteId = $_GET['deleteID'];
  $database->deleteRecord($deleteId);
  header("Location:view.php?msg2=delete");
}

if (!isset($_SESSION['user_id']) || (time() > $_SESSION['timeout'])) {
  session_unset();
  session_destroy();
?>
  <main>

    <div class="container">
      <table class="table">
        <?php


        $DBreturn = $database->getData();
        ?>
        <tr>
          <th>Quantity</th>
          <th>Size</th>
          <th>Shape</th>
          <th>Topping</th>
          <th>Crust</th>
          <th>Order Type</th>
          <th>Name</th>
          <th>Phone</th>
        </tr>
        <?php
        while ($result = mysqli_fetch_assoc($DBreturn)) {
          echo "<tr>";
          echo "<td>" . $result['quantity'] . "</td>";
          echo "<td>" . $result['size_pizza'] . "</td>";
          echo "<td>" . $result['shape'] . "</td>";
          echo "<td>" . $result['topping'] . "</td>";
          echo "<td>" . $result['crust'] . "</td>";
          echo "<td>" . $result['delivery_takeout'] . "</td>";
          echo "<td>" . $result['client_name'] . "</td>";
          echo "<td>" . $result['phone'] . "</td>";
          echo "</tr>";
        }
        ?>
      </table>
    </div>
    <div class="button-div">
      <a href='view.php'><button class="refresh-button">Refresh Page</button></a>
    </div>
  </main>
<?php
} else {

?>
  <main>
    <div class="row">
      <?php

      if (isset($_GET['msg1']) == "update") {
        echo "<div>
              Record updated successfully!
            </div>";
      }
      if (isset($_GET['msg2']) == "delete") {
        echo "<div>
              Record deleted successfully!
            </div>";
      }
      ?>
    </div>

    <div class="container">
      <table class="table">
        <?php

        require_once('./inc/database.php');

        $DBreturn = $database->getData();
        ?>
        <tr>
          <th>Quantity</th>
          <th>Size</th>
          <th>Shape</th>
          <th>Topping</th>
          <th>Crust</th>
          <th>Order Type</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Action</th>
        </tr>
        <?php
        if ($DBreturn != null) {
          while ($result = mysqli_fetch_assoc($DBreturn)) {
        ?>
            <tr>
              <td><?php echo $result['quantity'] ?> </td>
              <td><?php echo $result['size_pizza'] ?> </td>
              <td><?php echo $result['shape'] ?> </td>
              <td><?php echo $result['topping'] ?> </td>
              <td><?php echo $result['crust'] ?> </td>
              <td><?php echo $result['delivery_takeout'] ?> </td>
              <td><?php echo $result['client_name'] ?> </td>
              <td><?php echo $result['phone'] ?> </td>
              <td>
              <button class="action-button" ><a href="edit.php?editID=<?php echo $result['order_id'] ?>"><i class="fa fa-pencil"></i></a></button>
                <button class="action-button"><a href="view.php?deleteID=<?php echo $result['order_id'] ?>" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a></button>
              </td>
            </tr>
          <?php
          }
        } else { ?>
          <tr>
            <td>No Records Found</td>
          </tr>
        <?php
        }
        ?>
      </table>
    </div>
    <div class="button-div">
      <a href='view.php'><button class="refresh-button">Refresh Page</button></a>
    </div>
  </main>

<?php
}
require './inc/footer.php'; ?>
