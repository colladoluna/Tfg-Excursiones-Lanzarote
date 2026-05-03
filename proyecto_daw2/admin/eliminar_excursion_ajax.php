<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../includes/db.php';
include 'admin_auth.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'])) {
    echo json_encode(["success" => false, "error" => "ID no recibido"]);
    exit;
}

$id = intval($data['id']);

$sql = "DELETE FROM excursiones WHERE id = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false, "error" => "Error en prepare: " . $conexion->error]);
    exit;
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}
?>