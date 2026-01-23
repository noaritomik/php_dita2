<?php
include("config.php");
header('Content-Type: application/json');

if (!isset($_GET['flight']) || empty(trim($_GET['flight']))) {
    echo json_encode(["error" => "No flight number provided"]);
    exit;
}

$flight = strtoupper(trim($_GET['flight']));

if (!preg_match('/^[A-Z]{2}\d{2,4}$/', $flight)) {
    echo json_encode(["error" => "Invalid flight number format"]);
    exit;
}

$sql = "SELECT * FROM flights WHERE flight_no = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $flight);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode([
        "flight" => $row['flight_no'],
        "airline" => $row['airline'],
        "departure" => $row['departure'],
        "arrival" => $row['arrival'],
        "status" => $row['status']
    ]);
    exit;
}

$airlines = ["American Airlines", "Delta", "United", "Emirates", "Lufthansa"];
$airports = ["JFK", "LAX", "ORD", "ATL", "DXB", "LHR"];
$statuses = ["On Time", "Delayed", "Boarding", "Departed", "Arrived"];

$airline = $airlines[array_rand($airlines)];
$departure = $airports[array_rand($airports)];
do {
    $arrival = $airports[array_rand($airports)];
} while ($arrival === $departure);
$status = $statuses[array_rand($statuses)];

$insert_sql = "INSERT INTO flights (flight_no, airline, departure, arrival, status) VALUES (?, ?, ?, ?, ?)";
$insert_stmt = mysqli_prepare($conn, $insert_sql);
mysqli_stmt_bind_param($insert_stmt, "sssss", $flight, $airline, $departure, $arrival, $status);
mysqli_stmt_execute($insert_stmt);

echo json_encode([
    "flight" => $flight,
    "airline" => $airline,
    "departure" => $departure,
    "arrival" => $arrival,
    "status" => $status
]);

