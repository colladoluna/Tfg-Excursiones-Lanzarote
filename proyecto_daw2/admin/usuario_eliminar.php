<?php

// Archivos comunes

include 'admin_auth.php';
include '../includes/db.php';

if (!isset($_GET['id'])) {
    echo "ID no especificado."; // El usuario no existe
    exit;
}

$usuario_id = $_GET['id']; // El usuario existe

// Elimina las reservas

$conexion->query("DELETE FROM reservas WHERE usuario_id = $usuario_id");

// Elimina al usuario

$conexion->query("DELETE FROM usuarios WHERE id = $usuario_id");

header("Location: usuarios.php");
exit;