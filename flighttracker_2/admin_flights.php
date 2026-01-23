<?php
include("config.php");
header("Content-Type: application/json");

$result = mysqli_query($conn, "SELECT * FROM flights ORDER BY id DESC");
$flights = [];
while($row = mysqli_fetch_assoc($result)) {
    $flights[] = $row;
}
echo json_encode($flights);
