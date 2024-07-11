<?php

header('Content-Type: application/json');

$servername = "localhost";
$usernameDB = "mobw7774_user_julio";
$passwordDB = "julio123456!.,";
$dbname = "mobw7774_api_julio";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
    $password = $data['password'];
    $name = $data['name'];

    if (!empty($username) && !empty($password) && !empty($name)) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $usernameDB, $passwordDB);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Simpan password tanpa enkripsi
            $stmt = $conn->prepare("INSERT INTO users (username, password, name) VALUES (:username, :password, :name)");
            $stmt->execute(['username' => $username, 'password' => $password, 'name' => $name]);

            if ($stmt->rowCount()) {
                echo json_encode(['success' => true, 'message' => 'Registration successful']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to register user']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>