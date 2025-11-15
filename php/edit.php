<?php
include_once("config.php");

$id=$_GET['id'];

$sql="SELECT * FROM products WHERE id=:id";

$prep=$conn->prepare($sql);

$prep->bindParam(':id',$id);
$prep->execute();

$data=$prep->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id']?>">
        <input type="hidden" name="title" value="<?php echo $data['title']?>">
        <input type="hidden" name="description" value="<?php echo $data['description']?>">
        <input type="hidden" name="quantity" value="<?php echo $data['quantity']?>">
        <input type="hidden" name="price" value="<?php echo $data['price']?>">

        <button type="submit" name="update">Update</button>
    </form>

    <a href="dashboard.php">Dashboard</a>
</body>
</html>