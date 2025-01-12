<?php
// Display all errors for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$servername = getenv('DB_SERVER'); 
$username = getenv('DB_USERNAME'); 
$password = getenv('DB_PASSWORD'); 
$dbname = getenv('DB_NAME');


// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set for UTF-8 compatibility
$conn->set_charset("utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $blood_group = $_POST['blood_group'];
    $dob = $_POST['date_of_birth'];
    $profession = $_POST['profession'];
    $hobbies = $_POST['passion_hobbies'];

    // Sanitize name for file usage
    $sanitized_name = preg_replace("/[^A-Za-z0-9]/", "", $name);

    // Check if mobile number already exists
    $check_query = $conn->prepare("SELECT * FROM approve_volunteer WHERE mobile = ?");
    if (!$check_query) {
        die("Error preparing query (Check Mobile): " . $conn->error);
    }

    $check_query->bind_param("s", $mobile);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
                alert('This mobile number has already been submitted.');
                window.history.back();
              </script>";
    } else {
        // Handle file upload
        $target_dir = "assets/approve_vol/";
        $file_name = $mobile . "_" . $sanitized_name . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $target_file = $target_dir . $file_name;

        // Ensure directory exists
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                die("Failed to create directory: $target_dir");
            }
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert data into database
            $stmt = $conn->prepare("INSERT INTO approve_volunteer (vol_id, mobile, email, address, blood_group, dob, profession, hobbies, vol_img, name) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                die("Error preparing query (Insert Data): " . $conn->error);
            }

            $stmt->bind_param("sssssssss", $mobile, $email, $address, $blood_group, $dob, $profession, $hobbies, $target_file, $name);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Form submitted successfully!');
                        window.location.href = 'index.html'; // Redirect after success
                      </script>";
            } else {
                die("Error executing query (Insert Data): " . $stmt->error);
            }

            $stmt->close();
        } else {
            die("Error uploading file.");
        }
    }

    $check_query->close();
}

// Close database connection
$conn->close();
?>
