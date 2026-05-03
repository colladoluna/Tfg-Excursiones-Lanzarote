<?php

// Conexión con la Base de datos

$conexion = new mysqli("localhost", "root", "", "excursiones_db");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>