<!-- <?php
header('Content-Type: application/json');
require 'db.php';

$flight = strtoupper(trim($_GET['flight'] ?? ''));

if ($flight === '') {
    echo json_encode([
        "success" => false,
        "error" => "Flight number is required"
    ]);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM flights WHERE flight_no = ?");
$stmt->bind_param("s", $flight);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode([
        "success" => true,
        "flight" => $data
    ]);
} else {
    echo json_encode([
        "success" => false,
        "error" => "Flight not found"
    ]);
} -->

<?php
include 'db.php';

if (isset($_GET['flight_no'])) {
    $flight_no = $_GET['flight_no'];
    $stmt = $conn->prepare("SELECT * FROM flights WHERE flight_no=?");
    $stmt->bind_param("s", $flight_no);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
} else {
    $result = $conn->query("SELECT * FROM flights");
    $flights = [];
    while ($row = $result->fetch_assoc()) {
        $flights[] = $row;
    }
    echo json_encode($flights);
}
?>