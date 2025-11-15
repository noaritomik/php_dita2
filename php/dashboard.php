<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    include_once('config.php');
    $getUsers=$conn->prepare("SELECT * FROM users");
    $getUsers->execute();
    $user=$getUsers->fetchAll();
?>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
    </tr>
    <?php
    foreach($user as $users){
    ?>
    <tr>
        <td> <?= $users['id']?></td>
        <td> <?= $users['name']?></td>
        <td> <?= $users['surname']?></td>
        <td> <?= $users['email']?></td>
        <td><?= "<a href='delete.php?id=$users[id]'>Delete</a> | <a href='edit.php?id=$users[id]'>Update</a>"?></td>
    </tr>    
    <?php
    }
    ?>
</table>

<?php
    include_once('config.php');
    $getUsers=$conn->prepare("SELECT * FROM products");
    $getUsers->execute();
    $user=$getUsers->fetchAll();
?>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    <?php
    foreach($user as $products){
    ?>
    <tr>
        <td> <?= $products['id']?></td>
        <td> <?= $products['title']?></td>
        <td> <?= $products['description']?></td>
        <td> <?= $products['quantity']?></td>
        <td> <?= $products['price']?></td>
        <td><?= "<a href='delete.php?id=$products[id]'>Delete</a> | <a href='edit.php?id=$products[id]'>Update</a>"?></td>
        <td><?= "<a href='add.php'>Add</a>"?></td>
    </tr>    
    <?php
    }
    ?>
</table>

</body>
</html>