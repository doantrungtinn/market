<?php
require_once('../connection.php');
include('../class/category.php');
include('../class/vegetable.php');

if (isset($_POST['name'])) {
    $vege = new Vegetable($connection);
    $vege->vegeName  = $_POST['name'];
    $vege->unit  = $_POST['unit'];
    $vege->amount  = $_POST['amount'];
    $vege->image = "images/".$_FILES['images']['name'];
    $vege->price  = $_POST['price'];
    $vege->cateID  = $_POST['cateID'];

    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["images"]["name"]);
    
    // KT kích thước
    if ($_FILES["images"]["size"] > 2097152) {
        header('location:./new.php?err=-1');
    }

    // KT ảnh
    $check = getimagesize($_FILES["images"]["tmp_name"]);
    if($check == false) {
      header('location:./new.php?err=-1');
    } 

    if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO `vegetable`(`CategoryID`, `VegetableName`, `Unit`, `Amount`, `Image`, `Price`)
                VALUES ('$vege->cateID','$vege->vegeName','$vege->unit','$vege->amount','$vege->image','$vege->price')";
        $old = mysqli_query($connection,$sql);
        header('location:./new.php?err=0');
    }else{
        header('location:./new.php?err=-1');
    }
}
