<?php
// Only start a session if none exists
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "flight_tracker");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
