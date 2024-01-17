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

// Create SQL query for retrieving records
$sql = "SELECT * FROM login";

// Execute the query
$result = $conn->query($sql);

// Check if any records were returned
if ($result->num_rows > 0) {
    // Fetch all rows and encode them as JSON
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['data' => $rows]);
} else {
    echo json_encode(['message' => 'No records found']);
}

// Close the database connection
$conn->close();
?>
