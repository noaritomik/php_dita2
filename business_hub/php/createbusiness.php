<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare(
        "INSERT INTO businesses (user_id, business_name, description, category)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param(
        "isss",
        $_SESSION['user_id'],
        $_POST['name'],
        $_POST['description'],
        $_POST['category']
    );
    $stmt->execute();
    header("Location: ../dashboard.php");
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Business Name" required>
    <textarea name="description" placeholder="Description"></textarea>
    <input type="text" name="category" placeholder="Category">
    <button>Create</button>
</form>