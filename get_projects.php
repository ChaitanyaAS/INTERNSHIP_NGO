<?php
// Database connection
$servername = getenv('DB_SERVER'); 
$username = getenv('DB_USERNAME'); 
$password = getenv('DB_PASSWORD'); 
$dbname = getenv('DB_NAME');

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

// Get the type_id from the request
$type_id = isset($_GET['type_id']) ? intval($_GET['type_id']) : 0;

// Fetch projects by type_id
$sql = "SELECT project_name, project_image, project_desc FROM projects WHERE type_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $type_id);
$stmt->execute();
$result = $stmt->get_result();

$projects = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
		$row['project_image'] = str_replace("\/", "/", $row['project_image']);
        $projects[] = $row;
    }
}

// Send JSON response
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($projects, JSON_UNESCAPED_SLASHES);

$stmt->close();
$conn->close();
?>
