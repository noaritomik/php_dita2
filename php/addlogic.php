<?php

include_once("config.php");

if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $quantity=$_POST['quantity'];
    $price=$_POST['price'];

    $sql="INSERT INTO products(title,description,quantity,price) VALUES (:title,:description,:quantity,:price)";
    $sqlQuery=$conn->prepare($sql);

    $sqlQuery->bindParam(':title',$title);
    $sqlQuery->bindParam(':description',$description);
    $sqlQuery->bindParam(':quantity',$quantity);
    $sqlQuery->bindParam(':price',$price);

    $sqlQuery->execute();

    echo "Data saved successfully..";
}

?>