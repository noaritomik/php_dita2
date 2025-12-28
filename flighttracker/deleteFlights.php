<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$flight_no = $data['flight_no'];

$stmt = $conn->prepare("DELETE FROM flights WHERE flight_no=?");
$stmt->bind_param("s", $flight_no);
$stmt->execute();

echo json_encode(["message" => "Flight deleted"]);
?>