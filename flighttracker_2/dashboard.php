<?php
include("config.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - SkyTrack</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">✈ SkyTrack</div>
    <p>Welcome, <?= htmlspecialchars($_SESSION["user_name"]) ?></p>
    <a href="logout.php" class="logout-btn">Logout</a>
</header>

<main>
    <?php include("tracker.php"); ?>
</main>

<footer>
    © 2026 SkyTrack • Flight Tracking System
</footer>

<script src="script.js"></script>
</body>
</html>

