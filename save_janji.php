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
$mekanik = $_POST['mekanik'] ?? '';
$pengecetan = $_POST['pengecetan'] ?? '';
$hari = $_POST['hari'] ?? '';
$jam = $_POST['jam'] ?? '';
$jenis = $_POST['jenis'] ?? '';
$manfaat = $_POST['manfaat'] ?? '';
$garansi = $_POST['garansi'] ?? '';
$created_at = date('Y-m-d H:i:s'); // Add created_at timestamp

// Validate POST data
if (empty($mekanik) || empty($pengecetan) || empty($hari) || empty($jam) || empty($jenis) || empty($manfaat)) {
    die(json_encode(["success" => false, "message" => "All fields are required"]));
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO janji (mekanik, pengecetan, hari, jam, jenis, manfaat, garansi, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $mekanik, $pengecetan, $hari, $jam, $jenis, $manfaat, $garansi, $created_at);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Appointment saved successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
