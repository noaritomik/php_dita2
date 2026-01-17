<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Email already exists";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="search-card">
  <h2>Create Account</h2>
  <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
  <form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button>Create Account</button>
  </form>
  <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
