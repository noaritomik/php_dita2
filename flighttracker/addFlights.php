<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$flight_no = $data['flight_no'];
$airline = $data['airline'];
$departure = $data['departure'];
$arrival = $data['arrival'];
$status = $data['status'];

// Check if flight exists
$check = $conn->prepare("SELECT * FROM flights WHERE flight_no = ?");
$check->bind_param("s", $flight_no);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    // Update
    $stmt = $conn->prepare("UPDATE flights SET airline=?, departure=?, arrival=?, status=? WHERE flight_no=?");
    $stmt->bind_param("sssss", $airline, $departure, $arrival, $status, $flight_no);
    $stmt->execute();
    echo json_encode(["message" => "Flight updated"]);
} else {
    // Insert
    $stmt = $conn->prepare("INSERT INTO flights (flight_no, airline, departure, arrival, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $flight_no, $airline, $departure, $arrival, $status);
    $stmt->execute();
    echo json_encode(["message" => "Flight added"]);
}
?>