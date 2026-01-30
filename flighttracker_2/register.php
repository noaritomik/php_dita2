<?php
include("config.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if (!$name || !$email || !$password || !$confirm) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address!";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email=?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error = "Email already registered!";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = mysqli_prepare($conn, "INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($insert, "sss", $name, $email, $hashed);
            if (mysqli_stmt_execute($insert)) {
                $_SESSION["user_id"] = mysqli_insert_id($conn);
                $_SESSION["user_name"] = $name;
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Error registering user!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - SkyTrack</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="search-card" style="max-width:400px; margin:100px auto;">
    <h2>Create Account</h2>

    <?php if ($error) echo "<p class='auth-error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>

    <p style="margin-top:10px;">
        Already have an account?
        <a href="login.php">Login here</a>
    </p>
</div>

</body>
</html>


<!-- <!DOCTYPE html>
<html>
<head>
    <title>Register - SkyTrack</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Create Account</h2>

    <?php if ($error): ?>
      <p class="auth-error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm" placeholder="Confirm Password" required>
      <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
  </div>
</div>

</body>
</html> -->
