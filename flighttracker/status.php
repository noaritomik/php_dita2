<?php
header('Content-Type: application/json');
require 'db.php';

$flight = $_GET['flight'] ?? '';

if($flight === ''){
    echo json_encode(["error" => "Flight number is required"]);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM flights WHERE flight_no = ?");
$stmt->bind_param("s", $flight);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $data = $result->fetch_assoc();
    echo json_encode($data);
}else{
    echo json_encode(["error" => "Flight not found"]);
}
?>