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

    if (!empty($username) && !empty($password)) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $usernameDB, $passwordDB);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                // Membandingkan password tanpa enkripsi
                if ($password === $user['password']) {
                    echo json_encode([
                        "success" => true, 
                        "message" => "Login successful",
                        "data" => [
                            "name" => $user['name'],
                            "username" => $user['username'],
                            "password" => $user['password']
                        ]
                    ]);
                } else {
                    echo json_encode(["success" => false, "message" => "Invalid password"]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "User not found"]);
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