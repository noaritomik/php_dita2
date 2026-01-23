<?php
include("config.php");

$id = (int)$_POST["id"];
$flight_no = strtoupper(trim($_POST["flight_no"]));
$airline = trim($_POST["airline"]);
$departure = trim($_POST["departure"]);
$arrival = trim($_POST["arrival"]);
$status = $_POST["status"];

$stmt = mysqli_prepare($conn, "UPDATE flights SET flight_no=?, airline=?, departure=?, arrival=?, status=? WHERE id=?");
mysqli_stmt_bind_param($stmt, "sssssi", $flight_no, $airline, $departure, $arrival, $status, $id);
mysqli_stmt_execute($stmt);
echo "Flight updated successfully!";
