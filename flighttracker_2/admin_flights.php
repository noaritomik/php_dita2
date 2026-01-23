<?php
include("config.php");
header("Content-Type: application/json");

// Check if flights table is empty
$result = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM flights");
$row = mysqli_fetch_assoc($result);

if ($row['cnt'] == 0) {
    // Pre-populate 5 random flights
    $airlines = ["American Airlines", "Delta", "United", "Emirates", "Lufthansa"];
    $airports = ["JFK", "LAX", "ORD", "ATL", "DXB", "LHR"];
    $statuses = ["On Time", "Delayed", "Boarding", "Departed", "Arrived"];

    for ($i = 1; $i <= 5; $i++) {
        $flight_no = "AA" . rand(100, 999);
        $airline = $airlines[array_rand($airlines)];
        $departure = $airports[array_rand($airports)];
        do {
            $arrival = $airports[array_rand($airports)];
        } while ($arrival === $departure);
        $status = $statuses[array_rand($statuses)];

        $stmt = mysqli_prepare($conn, "INSERT INTO flights (flight_no, airline, departure, arrival, status) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $flight_no, $airline, $departure, $arrival, $status);
        mysqli_stmt_execute($stmt);
    }
}

// Fetch all flights
$result = mysqli_query($conn, "SELECT * FROM flights ORDER BY id DESC");
$flights = [];
while($row = mysqli_fetch_assoc($result)) {
    $flights[] = $row;
}
echo json_encode($flights);

