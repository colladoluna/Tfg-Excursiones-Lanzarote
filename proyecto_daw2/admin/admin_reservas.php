<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Administrador Reservas</title>
</head>
<body>
<?php

// Archivos comunes

include 'admin_auth.php';
include '../includes/db.php';
?>

<!-- Listado de resevas realizadas-->


<div class="admin-panel">
    <h2>Listado de todas las reservas</h2>
    <?php

    // Busqueda de reservas

    $sql = "SELECT r.id, u.nombre AS usuario, e.titulo AS excursion, r.cantidad, r.estado, r.fecha_reserva
            FROM reservas r
            JOIN usuarios u ON r.usuario_id = u.id
            JOIN excursiones e ON r.excursion_id = e.id
            ORDER BY r.fecha_reserva DESC";

    $resultado = $conexion->query($sql);

    // Visualización de reservas

    while ($row = $resultado->fetch_assoc()) {
        echo "<div style='margin-bottom: 10px;'>";
        echo "<strong>{$row['usuario']}</strong> reservó <strong>{$row['cantidad']}</strong> plazas en <em>{$row['excursion']}</em> ";
        echo "el día {$row['fecha_reserva']} | Estado: <strong>{$row['estado']}</strong>";
        echo "</div>";
    }
    ?>
<a class="volver" href="admin_panel.php">Volver al panel de administración</a>
</div>
</body>
</html>