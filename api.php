api.php
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'database.php';

// Buat instance database dan dapatkan koneksi
$database = new Database();
$conn = $database->getConnection();

$request_method = $_SERVER["REQUEST_METHOD"];
$input = json_decode(file_get_contents("php://input"), true);

switch ($request_method) {
    case 'POST':
        if (isset($_GET['action']) && $_GET['action'] == 'register') {
            register($conn, $input);
        } else if (isset($_GET['action']) && $_GET['action'] == 'login') {
            login($conn, $input);
        }
        break;
    case 'GET':
        getUsers($conn);
        break;
    case 'PUT':
        updateUser($conn, $input);
        break;
    case 'DELETE':
        deleteUser($conn, $input);
        break;
    default:
        echo json_encode(["message" => "Request method not supported"]);
        break;
}

// Fungsi untuk registrasi
function register($conn, $input) {
    $username = $input['username'];
    $password = password_hash($input['password'], PASSWORD_BCRYPT);
    $name = $input['name'];

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("INSERT INTO users (username, password, name) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $name);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => $stmt->error]);
    }

    $stmt->close();
}

// Fungsi untuk login
function login($conn, $input) {
    $username = $input['username'];
    $password = $input['password'];

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            echo json_encode(["success" => true, "message" => "Login successful"]);
        } else {
            echo json_encode(["success" => false, "message" => "Invalid password"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "User not found"]);
    }

    $stmt->close();
}

// Fungsi untuk mendapatkan daftar pengguna
function getUsers($conn) {
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    $users = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    echo json_encode($users);
}

// Fungsi untuk memperbarui pengguna
function updateUser($conn, $input) {
    $id = $input['id'];
    $username = $input['username'];
    $name = $input['name'];
    $password = password_hash($input['password'], PASSWORD_BCRYPT);

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, name = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $password, $name, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => $stmt->error]);
    }

    $stmt->close();
}

// Fungsi untuk menghapus pengguna
function deleteUser($conn, $input) {
    $id = $input['id'];

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => $stmt->error]);
    }

    $stmt->close();
}
?>

