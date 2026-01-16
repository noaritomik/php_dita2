<?php
header('Content-Type: application/json');
include 'db.php';

$result = $conn->query("SELECT * FROM flights ORDER BY flight_no ASC");

$flights = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $flights[] = $row;
    }
    echo json_encode($flights);
} else {
    echo json_encode(["error" => "Could not fetch flights"]);
}
exit;
?>