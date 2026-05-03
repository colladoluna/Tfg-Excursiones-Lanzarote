<?php
include '../includes/db.php';
include 'admin_auth.php';

header('Content-Type: application/json');

// Recibir los datos en JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "error" => "No se recibieron datos."]);
    exit;
}

$titulo = $data['titulo'];
$descripcion = $data['descripcion'];
$fecha = $data['fecha'];
$duracion = intval($data['duracion_horas']);
$precio = floatval(str_replace(",", ".", $data['precio'])); 

$sql = "INSERT INTO excursiones (titulo, descripcion, fecha, duracion_horas, precio) VALUES (?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssdi", $titulo, $descripcion, $fecha, $duracion, $precio);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}
?>