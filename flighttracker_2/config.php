<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "flight_tracker");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
