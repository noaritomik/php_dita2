<?php
include("config.php");

// Ensure user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Optional: check if user is admin
$isAdmin = true; // set true for now, later you can check a user role column
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
    <p>Welcome, <?= htmlspecialchars($_SESSION["user_name"]) ?><?= $isAdmin ? " (Admin)" : "" ?></p>
    <a href="logout.php" class="logout-btn">Logout</a>
</header>

<main>

    <!-- Flight Tracker -->
    <?php include("tracker.php"); ?>

    <?php if ($isAdmin): ?>
    <!-- Admin Flight Management -->
    <section class="search-card">
        <h2>Manage Flights</h2>
        <p><a href="addflight.php">Add New Flight</a></p>

        <?php
        $result = mysqli_query($conn, "SELECT * FROM flights ORDER BY id DESC");
        if(mysqli_num_rows($result) > 0):
        ?>
        <table border="1" width="100%" cellpadding="8" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Flight No</th>
                <th>Airline</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['flight_no']) ?></td>
                <td><?= htmlspecialchars($row['airline']) ?></td>
                <td><?= htmlspecialchars($row['departure']) ?></td>
                <td><?= htmlspecialchars($row['arrival']) ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="updateflight.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="deleteflight.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
        <p>No flights found.</p>
        <?php endif; ?>
    </section>
    <?php endif; ?>

</main>

<footer>
    © 2026 SkyTrack • Flight Tracking System
</footer>

<script src="script.js"></script>
</body>
</html>




<!-- <?php
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
</html> -->

