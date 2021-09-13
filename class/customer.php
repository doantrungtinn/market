<?php
class Customer {
  // Properties
  public $cusid;
  public $pass;
  public $fullname;
  public $address;
  public $city;
  public $connection;


  public function __construct($connection) {
      $this->conn = $connection;
  }


  // Methods
  function getByID($cusid){ //su dung o checklogin.php
      $sql = "SELECT * FROM `customers` WHERE CustomerID =$cusid";
      $old = mysqli_query($this->conn,$sql);
      if ($old==false) {
        return null;
      }
      $row = $old->fetch_assoc();
      return $row;
  }
  function add($cus){ //su dung o saveregister
      $sql = "INSERT INTO `customers`( `Password`, `Fullname`, `Address`, `City`)
       VALUES ('$cus->pass','$cus->fullname','$cus->address','$cus->city')";
        $old = mysqli_query($this->conn,$sql);
        $sqlGet = "SELECT * FROM `customers` ORDER BY CustomerID DESC LIMIT 1;";
        $old2 = mysqli_query($this -> conn, $sqlGet);
        $row = $old2 -> fetch_assoc();
        return $row['CustomerID'];
  }
}
?>