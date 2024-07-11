<?php
header('Content-Type: application/json');

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

// Change query to select all rows from the service table
$sql = "SELECT jenis, manfaat, garansi FROM service";

$result = $conn->query($sql);

$services = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
} else {
    echo json_encode(array("message" => "No records found"));
    exit();
}

echo json_encode($services);

$conn->close();
?>
