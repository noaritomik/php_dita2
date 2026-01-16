<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$flight_no = strtoupper(trim($data['flight_no'] ?? ''));

if (!$flight_no) {
    echo json_encode(["error" => "Flight number is required"]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM flights WHERE flight_no=?");
if (!$stmt) { echo json_encode(["error" => $conn->error]); exit; }

$stmt->bind_param("s", $flight_no);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["message" => "Flight deleted"]);
} else {
    echo json_encode(["error" => "Flight not found"]);
}
exit;
?>