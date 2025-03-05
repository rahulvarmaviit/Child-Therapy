<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate required fields
if (empty($_POST['parent_name'])) {
    die("Error: Parent name is required");
}
if (empty($_POST['email'])) {
    die("Error: Email is required");
}
// Add similar checks for other required fields

// Sanitize input data
$parent_name = mysqli_real_escape_string($conn, $_POST['parent_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$child_name = mysqli_real_escape_string($conn, $_POST['child_name']);
$age = intval($_POST['age']);
$preferred_date = $_POST['preferred_date'];
$preferred_time = $_POST['preferred_time'];
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Prepare SQL statement
$sql = "INSERT INTO consultations 
        (parent_name, email, phone, child_name, age, preferred_date, preferred_time, message)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssssisss", 
    $parent_name, 
    $email, 
    $phone, 
    $child_name, 
    $age, 
    $preferred_date, 
    $preferred_time, 
    $message
);

// Execute statement
if ($stmt->execute()) {
    echo "Booking submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>