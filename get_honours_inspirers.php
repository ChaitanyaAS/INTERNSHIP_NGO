<?php
header('Content-Type: application/json');

// Database credentials
$servername = getenv('DB_SERVER');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

// Fetch honours and inspirers data
$response = ['honours' => [], 'inspirers' => []];

$honours_query = "SELECT id, hon_name, hon_img FROM honours";
$inspirers_query = "SELECT id, inspirer_name, inspirer_img FROM Inspirers";

$honours_result = $conn->query($honours_query);
if ($honours_result->num_rows > 0) {
    while ($row = $honours_result->fetch_assoc()) {
        $response['honours'][] = $row;
    }
}

$inspirers_result = $conn->query($inspirers_query);
if ($inspirers_result->num_rows > 0) {
    while ($row = $inspirers_result->fetch_assoc()) {
        $response['inspirers'][] = $row;
    }
}

$conn->close();

echo json_encode($response);
?>
