<?php
// $username=$_GET['username'];
// $password=$_GET['password'];

// echo $username;
// echo "<br>";
// echo $password;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="add.php" method="POST">
    <!-- <label for="username">Username:</label>
    <input type="text" id="username" name="username" placeholder="Username"><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Password"><br>
    <input type="submit" value="Submit"> -->
    <input type="text" name="name"><br>
    <input type="text" name="username"><br>
    <input type="email" name="email"><br>
    <button type="submit" name="submit">Add</button>
</form>
</body>
</html>