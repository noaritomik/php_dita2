<?php
include "php/config.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
}

$uid = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM businesses WHERE user_id=$uid");
$business = $result->fetch_assoc();
?>

<h1>Dashboard</h1>

<?php if ($business) { ?>
    <h2>Your Business</h2>
    <p><?= $business['business_name'] ?></p>
    <a href="php/edit_business.php">Edit Business</a>
<?php } else { ?>
    <a href="php/create_business.php">Create Business</a>
<?php } ?>

<br><br>
<a href="php/businesses.php">View All Businesses</a><br>
<a href="php/logout.php">Logout</a>