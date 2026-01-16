<?php
include "config.php";
$uid = $_SESSION['user_id'];

$b = $conn->query("SELECT * FROM businesses WHERE user_id=$uid")->fetch_assoc();

if (isset($_POST['update'])) {
    $stmt = $conn->prepare(
        "UPDATE businesses SET business_name=?, description=? WHERE user_id=?"
    );
    $stmt->bind_param("ssi", $_POST['name'], $_POST['description'], $uid);
    $stmt->execute();
    header("Location: ../dashboard.php");
}
?>

<form method="POST">
    <input type="text" name="name" value="<?= $b['business_name'] ?>">
    <textarea name="description"><?= $b['description'] ?></textarea>
    <button name="update">Update</button>
</form>