<?php
include("config.php");
header('Content-Type: application/json');

// 1️⃣ Get flight number from query
if (!isset($_GET['flight']) || empty($_GET['flight'])) {
    echo json_encode(["error" => "No flight number provided"]);
    exit;
}

$flight = $_GET['flight'];

// 2️⃣ Check if flight already exists in DB
$sql = "SELECT * FROM flights WHERE flight_no = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $flight);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    // Flight exists → return it
    echo json_encode([
        "flight" => $row['flight_no'],
        "airline" => $row['airline'],
        "departure" => $row['departure'],
        "arrival" => $row['arrival'],
        "status" => $row['status']
    ]);
    exit;
}

// 3️⃣ Generate random flight info
$airlines = ["American Airlines", "Delta", "United", "Emirates", "Lufthansa"];
$airports = ["JFK", "LAX", "ORD", "ATL", "DXB", "LHR"];
$statuses = ["On Time", "Delayed", "Boarding", "Departed", "Arrived"];

$airline = $airlines[array_rand($airlines)];
$departure = $airports[array_rand($airports)];
do {
    $arrival = $airports[array_rand($airports)];
} while ($arrival === $departure); // Prevent same departure and arrival
$status = $statuses[array_rand($statuses)];

// 4️⃣ Insert the new flight into DB
$insert_sql = "INSERT INTO flights (flight_no, airline, departure, arrival, status)
               VALUES (?, ?, ?, ?, ?)";
$insert_stmt = mysqli_prepare($conn, $insert_sql);
mysqli_stmt_bind_param($insert_stmt, "sssss", $flight, $airline, $departure, $arrival, $status);
mysqli_stmt_execute($insert_stmt);

// 5️⃣ Return as JSON
echo json_encode([
    "flight" => $flight,
    "airline" => $airline,
    "departure" => $departure,
    "arrival" => $arrival,
    "status" => $status
]);
