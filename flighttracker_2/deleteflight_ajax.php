<?php
include("config.php");

$id = (int)$_GET["id"];
$stmt = mysqli_prepare($conn, "DELETE FROM flights WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
echo "Flight deleted successfully!";
