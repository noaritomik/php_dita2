<?php
include("..config.php");

$flight = $_GET['flight'];

$airlines = ["American Airlines", "Delta", "United", "Emirates", "Lufthansa"];
$airports = ["JFK", "LAX", "ORD", "ATL", "DXB", "LHR"];
$statuses = ["On Time", "Delayed", "Boarding", "Departed", "Arrived"];

$airline = $airlines[array_rand($airlines)];
$departure = $airports[array_rand($airports)];
$arrival = $airports[array_rand($airports)];
$status = $statuses[array_rand($statuses)];

mysqli_query($conn, "INSERT INTO flights (flight_number, airline, departure, arrival, status)
VALUES ('$flight','$airline','$departure','$arrival','$status')");

echo json_encode([
    "flight" => $flight,
    "airline" => $airline,
    "departure" => $departure,
    "arrival" => $arrival,
    "status" => $status
]);