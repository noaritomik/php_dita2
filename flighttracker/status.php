
<?php
header('Content-Type: application/json');
include 'db.php';

if (isset($_GET['flight_no']) && !empty(trim($_GET['flight_no']))) {
    $flight_no = strtoupper(trim($_GET['flight_no']));
    $stmt = $conn->prepare("SELECT * FROM flights WHERE flight_no=?");
    $stmt->bind_param("s", $flight_no);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "Flight not found"]);
    }
    exit;
}

// Return all flights if no flight_no
$result = $conn->query("SELECT * FROM flights ORDER BY flight_no ASC");
$flights = [];
while ($row = $result->fetch_assoc()) $flights[] = $row;
echo json_encode($flights);
?>