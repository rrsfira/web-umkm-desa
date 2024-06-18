<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'db_pabean';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    // Validasi input
    if (empty($id) || empty($action)) {
        echo json_encode(["status" => "error", "message" => "Invalid input"]);
        $conn->close();
        exit;
    }

    // Sanitize input
    $id = $conn->real_escape_string($id);
    $action = $conn->real_escape_string($action);

    // Prepare SQL query
    if ($action == 'accept') {
        $sql = "UPDATE users SET terima = '1', tolak = '0', status = 'Diterima' WHERE id = '$id'";
    } elseif ($action == 'reject') {
        $sql = "UPDATE users SET terima = '0', tolak = '1', status = 'Data Ditolak' WHERE id = '$id'";
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid action"]);
        $conn->close();
        exit;
    }

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
}

$conn->close();
?>
