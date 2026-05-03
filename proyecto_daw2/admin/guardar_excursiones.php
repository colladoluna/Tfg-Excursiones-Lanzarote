<?php

// Archivos comunes

include '../includes/db.php';
include 'admin_auth.php';

$id = intval($_POST['id']);
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$duracion = intval($_POST['duracion_horas']);
$precio = floatval($_POST['precio']);

// Modificación datos nuevos

$sql = "UPDATE excursiones SET titulo = ?, descripcion = ?, fecha = ?, duracion_horas = ?, precio = ? WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssidi", $titulo, $descripcion, $fecha, $duracion, $precio, $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Excursión actualizada correctamente. <a href='ver_excursiones.php'>Volver al listado</a>";
} else {
    echo "No se realizaron cambios o hubo un error.";
}
?>