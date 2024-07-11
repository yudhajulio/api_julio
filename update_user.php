<?php
$servername = "@localhost";
$usernameDB = "mobw7774_user_julio";
$passwordDB = "julio123456!.,";
$dbname = "mobw7774_api_julio";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentUsername = $_POST['currentUsername'];
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];

    // Update user in the database
    $sql = "UPDATE users SET username = '$newUsername', password = '$newPassword' WHERE username = '$currentUsername'";

    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'message' => 'Error: ' . $conn->error);
    }

    echo json_encode($response);
}

$conn->close();
?>
