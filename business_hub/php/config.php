<?php
$conn = new mysqli("localhost", "root", "", "business_hub");
if ($conn->connect_error) {
    die("Database connection failed");
}
session_start();
?>