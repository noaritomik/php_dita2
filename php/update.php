<?php

include_once("config.php");

if(isset($_POST['update'])){
    $id=$_POST['id'];
    $id=$_POST['name'];
    $id=$_POST['surname'];
    $id=$_POST['email'];

    $sql="UPDATE user SET name=:name, surname=:surname, email=:email WHERE id=:id";
    $prep=$conn->prepare($sql);
    $prep->bindParam(':id',$id);
    $prep->bindParam(':name',$name);
    $prep->bindParam(':surname',$surname);
    $prep->bindParam(':email',$email);

    $prep->execute();

    header("Location:dashboard.php")
}

?>