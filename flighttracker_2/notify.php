<?php
include("config.php");

$email = $_POST['email'];
$flight = $_POST['flight'];
$status = $_POST['status'];

mysqli_query($conn, "INSERT INTO notifications (email, flight_number, status)
VALUES ('$email','$flight','$status')");

$subject = "Flight Status Update";
$message = "Your flight $flight is currently $status";
$headers = "From: flighttracker@localhost";

mail($email, $subject, $message, $headers);

echo "Email sent";