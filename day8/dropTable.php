<?php

try{
    $pdo=new PDO("mysql:host=localhost;dbname=db","root","");
    $sql="DROP TABLE users";

    $pdo->exec($sql);

    echo "Table dropped";
}catch(PDOException $e){
    echo $e.getMessage();
}

?>