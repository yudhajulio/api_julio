<?php
header('Content-Type: application/json');

// Konfigurasi database
$servername = "localhost";
$username = "mobw7774_user_julio";
$password = "julio123456!.,";
$dbname = "mobw7774_api_julio";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    echo json_encode(array("success" => false, "message" => "Connection failed: " . $conn->connect_error));
    exit();
}

// Query untuk mengambil data riwayat
$sql = "SELECT id, mekanik, pengecetan, hari, jam, jenis, manfaat, garansi, created_at FROM janji";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $riwayat = array();
        while ($row = $result->fetch_assoc()) {
            $riwayat[] = $row;
        }
        echo json_encode(array("success" => true, "data" => $riwayat));
    } else {
        echo json_encode(array("success" => false, "message" => "No records found"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Error executing query: " . $conn->error));
}

$conn->close();
?>
