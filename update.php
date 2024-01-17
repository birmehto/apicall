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
$id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : '';
$name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
$email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';

// Check if required fields are provided
if (empty($id) || empty($name) || empty($email)) {
    echo json_encode(['error' => 'ID, name, and email are required']);
    exit();
}

// Create SQL query for updating a record
$sql = "UPDATE login SET name='$name', email='$email' WHERE id='$id'";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Record updated successfully']);
} else {
    echo json_encode(['error' => 'Error updating record: ' . $conn->error]);
}

// Close the database connection
$conn->close();
?>
