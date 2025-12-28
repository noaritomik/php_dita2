<?php
header('Content-Type: application/json');
require 'db.php';

$result = $conn->query("SELECT * FROM flights ORDER BY flight_no ASC");

$flights = [];
while($row = $result->fetch_assoc()) {
    $flights[] = $row;
}

echo json_encode($flights);