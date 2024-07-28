<?php

class Database
{
  private $connection;
  function __construct()
  {
    $this->connect_db();
  }

  public function connect_db()
  {
    $this->connection = mysqli_connect('localhost', 'root', '', 'pizza_delivery');
  }

  public function getData()
  {
    $query = 'SELECT * FROM orders;';
    $result = $this->connection->query($query);
    return $result;
  }

  public function executeQuery($quantity, $size, $shape, $topping, $crust, $takeoutOrDelivery, $name, $phone)
  {
    try {
      $sql = "INSERT INTO orders (quantity,size_pizza,shape,topping,crust,delivery_takeout,client_name,phone) VALUES ('$quantity','$size','$shape','$topping','$crust','$takeoutOrDelivery','$name','$phone');";
      $result = $this->connection->query($sql);
      return $result;
    } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
    }
  }

  public function getDataImage()
  {
    $query = 'SELECT * FROM imagesUpload;';
    $result = $this->connection->query($query);
    return $result;
  }

  public function executeImage($name, $path)
  {
    try {
      $sql = "INSERT INTO imagesUpload (name, path) VALUES ('$name','$path');";
      $result = $this->connection->query($sql);
      return $result;
    } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
    }
  }

  public function getLoginInfo($username, $password)
  {
    $query = "SELECT COUNT(username), user_id, username, firstName, lastName FROM loginsInfo WHERE username = '$username' AND password = '$password';";
    $result = $this->connection->query($query);
    return $result;
  }
  
  public function validateUsername($username){
    $query = "SELECT COUNT(username) FROM loginsInfo WHERE username = '$username';";
    $result = $this->connection->query($query);
    return $result;
  }

  public function executeSignin($firstName, $lastName, $username, $password){
    try {
      $sql = "INSERT INTO loginsInfo (firstName, lastName, username, password) VALUES ('$firstName', '$lastName', '$username', '$password');";
      $result = $this->connection->query($sql);
      return $result;
    } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
    }
  }

  public function displayRecordById($order_id){
    $sql = "SELECT * FROM orders WHERE order_id = $order_id";
    $result = $this->connection->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row;
    }
    
  }

  public function updateRecord($quantity, $size, $shape, $topping, $crust, $takeoutOrDelivery, $name, $phone, $order_id){
    $sql = "UPDATE orders SET quantity = '$quantity', size_pizza = '$size', shape = '$shape', topping = '$topping', crust = '$crust', delivery_takeout = '$takeoutOrDelivery', client_name = '$name', phone = '$phone' WHERE order_id = $order_id";
    $this->connection->query($sql);
  }

  public function deleteRecord($order_id){
    $sql = "DELETE FROM orders WHERE order_id = $order_id";
    $this->connection->query($sql);
  }

  public function deleteImage($id){
    $sql = "DELETE FROM imagesUpload WHERE id = $id";
    $this->connection->query($sql);
  }


}
$database = new Database();
