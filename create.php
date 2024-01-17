<?php
header('Content-Type: application/json');

// Include a configuration file with database credentials
include 'config.php';

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Validate incoming data (prevent SQL injection)
$name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
$email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';

// Check if required fields are provided
if (empty($name) || empty($email)) {
    echo json_encode(['error' => 'Name and email are required']);
    exit();
}

// Create SQL query
$sql = "INSERT INTO login (name, email) VALUES ('$name', '$email')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Record created successfully']);
} else {
    echo json_encode(['error' => 'Error creating record: ' . $conn->error]);
}

// Close the database connection
$conn->close();
?>
