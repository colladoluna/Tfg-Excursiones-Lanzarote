<?php
include '../includes/db.php';
include 'admin_auth.php';

header('Content-Type: application/json');

// Recibir los datos en formato JSON

$data = json_decode(file_get_contents("php://input"), true);

// Comprobamos que se recibieron bien

if (!$data) {
    echo json_encode(["success" => false, "error" => "No se recibieron datos."]);
    exit;
}

$id = intval($data['id']);
$titulo = $data['titulo'];
$descripcion = $data['descripcion'];
$fecha = $data['fecha'];
$duracion = intval($data['duracion_horas']);
$precio = floatval(str_replace(",", ".", $data['precio'])); // Reemplaza coma por punto

$sql = "UPDATE excursiones SET titulo=?, descripcion=?, fecha=?, duracion_horas=?, precio=? WHERE id=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssdi", $titulo, $descripcion, $fecha, $duracion, $precio, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}
?>