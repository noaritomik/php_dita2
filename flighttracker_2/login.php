<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email=?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<<<<<<< HEAD

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Login</h2>

    <?php if (isset($error)) echo "<p class='auth-error'>$error</p>"; ?>

    <form method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button>Login</button>
    </form>

    <p>No account? <a href="register.php">Register</a></p>
  </div>
=======
<div class="search-card">
  <h2>Login</h2>
  <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
  <form method="POST">
    <div class="search-box">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button>Login</button>
  </form>
  <p>No account? <a href="register.php">Register</a></p>
>>>>>>> 64eda9ca38886298005b0463d4f8caa192b3f829
</div>

</body>
</html>
