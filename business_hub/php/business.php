<?php
include "config.php";
$id = $_GET['id'];

$b = $conn->query("SELECT * FROM businesses WHERE id=$id")->fetch_assoc();

if (isset($_POST['review'])) {
    $stmt = $conn->prepare(
        "INSERT INTO reviews (business_id, user_id, rating, comment)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("iiis", $id, $_SESSION['user_id'], $_POST['rating'], $_POST['comment']);
    $stmt->execute();
}
?>

<h1><?= $b['business_name'] ?></h1>
<p><?= $b['description'] ?></p>
<p><b>Category:</b> <?= $b['category'] ?></p>

<h2>Reviews</h2>
<?php
$r = $conn->query("SELECT * FROM reviews WHERE business_id=$id");
while ($rev = $r->fetch_assoc()) {
    echo "⭐ {$rev['rating']}<br>{$rev['comment']}<hr>";
}
?>

<?php if (isset($_SESSION['user_id'])) { ?>
<form method="POST">
    <input type="number" name="rating" min="1" max="5" required>
    <textarea name="comment"></textarea>
    <button name="review">Submit Review</button>
</form>
<?php } ?>