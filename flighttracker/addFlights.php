<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$flight_no = strtoupper(trim($data['flight_no'] ?? ''));
$airline   = trim($data['airline'] ?? '');
$departure = trim($data['departure'] ?? '');
$arrival   = trim($data['arrival'] ?? '');
$status    = trim($data['status'] ?? '');

if (!$flight_no || !$airline || !$departure || !$arrival || !$status) {
    echo json_encode(["error" => "All fields are required"]);
    exit;
}

$check = $conn->prepare("SELECT * FROM flights WHERE flight_no=?");
$check->bind_param("s", $flight_no);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    $stmt = $conn->prepare("UPDATE flights SET airline=?, departure=?, arrival=?, status=? WHERE flight_no=?");
    $stmt->bind_param("sssss", $airline, $departure, $arrival, $status, $flight_no);
    $stmt->execute();
    echo json_encode(["message" => "Flight updated"]);
} else {
    $stmt = $conn->prepare("INSERT INTO flights (flight_no, airline, departure, arrival, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $flight_no, $airline, $departure, $arrival, $status);
    $stmt->execute();
    echo json_encode(["message" => "Flight added"]);
}
?>

<!-- <?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$flight_no = strtoupper(trim($data['flight_no'] ?? ''));
$airline   = trim($data['airline'] ?? '');
$departure = trim($data['departure'] ?? '');
$arrival   = trim($data['arrival'] ?? '');
$status    = trim($data['status'] ?? '');

if (!$flight_no || !$airline || !$departure || !$arrival || !$status) {
    echo json_encode(["error" => "All fields are required"]);
    exit;
}

$check = $conn->prepare("SELECT * FROM flights WHERE flight_no = ?");
if (!$check) { echo json_encode(["error" => $conn->error]); exit; }

$check->bind_param("s", $flight_no);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    $stmt = $conn->prepare("UPDATE flights SET airline=?, departure=?, arrival=?, status=? WHERE flight_no=?");
    if (!$stmt) { echo json_encode(["error" => $conn->error]); exit; }
    $stmt->bind_param("sssss", $airline, $departure, $arrival, $status, $flight_no);
    $stmt->execute();
    echo json_encode(["message" => "Flight updated"]);
} else {
    $stmt = $conn->prepare("INSERT INTO flights (flight_no, airline, departure, arrival, status) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) { echo json_encode(["error" => $conn->error]); exit; }
    $stmt->bind_param("sssss", $flight_no, $airline, $departure, $arrival, $status);
    $stmt->execute();
    echo json_encode(["message" => "Flight added"]);
}
exit;
?> -->