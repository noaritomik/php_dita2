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
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn,
          "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hash);
        mysqli_stmt_execute($stmt);

        header("Location: Home.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - SkyTrack</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="register-page">

<div class="search-card">
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

