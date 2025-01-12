<?php
$servername = getenv('DB_SERVER');  
$username = getenv('DB_USERNAME'); 
$password = getenv('DB_PASSWORD'); 
$dbname = getenv('DB_NAME');        

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Gather data from form and sanitize input
$name = mysqli_real_escape_string($conn, $_POST['name']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$type = mysqli_real_escape_string($conn, $_POST['type']);
$utr = !empty($_POST['utr']) ? mysqli_real_escape_string($conn, $_POST['utr']) : NULL;
$details = !empty($_POST['details']) ? mysqli_real_escape_string($conn, $_POST['details']) : NULL;

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO donation (name, mobile, email, utr, type, details) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $mobile, $email, $utr, $type, $details);

// Execute the statement
if ($stmt->execute()) {
    echo "<script>
        alert('Thank you for your donation. The Janmamithra team will contact you soon.');
        window.location.href = 'https://janmamithra.org/g/g3/index.html';
    </script>";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
