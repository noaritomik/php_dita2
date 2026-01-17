<?php
include("config.php");
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
  <div class="logo">✈ SkyTrack</div>
  <p>Welcome, <?= htmlspecialchars($_SESSION["user_name"]) ?></p>
  <a href="logout.php" class="logout-btn">Logout</a>
</header>

<main>
  <?php include("index.php"); ?>
</main>

</body>
</html>
