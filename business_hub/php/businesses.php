<?php
include "config.php";
$result = $conn->query("SELECT * FROM businesses");
?>

<h1>All Businesses</h1>

<?php while ($b = $result->fetch_assoc()) { ?>
<div class="card">
    <h3><?= $b['business_name'] ?></h3>
    <p><?= substr($b['description'], 0, 100) ?>...</p>
    <a href="business.php?id=<?= $b['id'] ?>">View</a>
</div>
<?php } ?>