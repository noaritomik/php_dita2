<?php
include("config.php");

$flight_no = strtoupper(trim($_POST["flight_no"]));
$airline = trim($_POST["airline"]);
$departure = trim($_POST["departure"]);
$arrival = trim($_POST["arrival"]);
$status = $_POST["status"];

if (!$flight_no || !$airline || !$departure || !$arrival || !$status) {
    echo "All fields are required!";
    exit;
}

$stmt = mysqli_prepare($conn, "INSERT INTO flights (flight_no, airline, departure, arrival, status) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssss", $flight_no, $airline, $departure, $arrival, $status);
if (mysqli_stmt_execute($stmt)) {
    echo "Flight added successfully!";
} else {
    echo "Error: Flight may already exist.";
}
