<?php
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "mobw7774_user_julio";
$password = "julio123456!.,";
$dbname = "mobw7774_api_julio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch color data
$sql = "SELECT mekanik, pengecetan, hari, jam FROM warna";
$result = $conn->query($sql);

$warna = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $warna[] = $row;
    }
} else {
    // Log if no data found
    error_log("No data found");
}

// Close connection
$conn->close();

// Return data in JSON format
echo json_encode($warna);
?>
