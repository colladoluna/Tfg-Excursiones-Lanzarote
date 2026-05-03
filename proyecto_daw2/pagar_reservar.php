<?php

// Archivos comunes

include 'includes/auth.php';
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reserva_id = $_POST['reserva_id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Verifica que la reserva es del usuario

    $stmt = $conexion->prepare("SELECT * FROM reservas WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ii", $reserva_id, $usuario_id);
    $stmt->execute();
    $res = $stmt->get_result();

    // Cambiar estado 

    if ($res->num_rows === 1) {
        $update = $conexion->prepare("UPDATE reservas SET estado = 'confirmada' WHERE id = ?");
        $update->bind_param("i", $reserva_id);
        $update->execute();
    }
}

// Redirige a otra página

header("Location: mis_reservas.php");
exit;