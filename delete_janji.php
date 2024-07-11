<?php
header('Content-Type: application/json');

// Database configuration
$servername = "localhost";
$username = "mobw7774_user_julio";
$password = "julio123456!.,";
$dbname = "mobw7774_api_julio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

// Retrieve POST data
$id = $_POST['id'] ?? '';

// Validate POST data
if (empty($id)) {
    die(json_encode(["success" => false, "message" => "ID is required"]));
}

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM janji WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Appointment deleted successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
