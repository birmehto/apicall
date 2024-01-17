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

// Check if required fields are provided
if (empty($id)) {
    echo json_encode(['error' => 'ID is required']);
    exit();
}

// Create SQL query for deleting a record
$sql = "DELETE FROM login WHERE id='$id'";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Record deleted successfully']);
} else {
    echo json_encode(['error' => 'Error deleting record: ' . $conn->error]);
}

// Close the database connection
$conn->close();
?>
