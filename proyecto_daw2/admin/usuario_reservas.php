<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Administrador Excursiones</title>
</head>
<body>
    <div class="admin-panel">
    <?php

    // Archivos comunes

    include 'admin_auth.php';
    include '../includes/db.php';

    if (!isset($_GET['id'])) {
        echo "ID de usuario no especificado."; // El usuario no existe
        exit;
    }

    $usuario_id = $_GET['id']; // El usuario existe

    // Busqueda entre las tablas reservas y excursiones 

    $stmt = $conexion->prepare("
        SELECT e.titulo, e.fecha, r.cantidad, r.estado, r.fecha_reserva
        FROM reservas r
        JOIN excursiones e ON r.excursion_id = e.id
        WHERE r.usuario_id = ?
        ORDER BY r.fecha_reserva DESC
    ");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    ?>

    <h2>Reservas del usuario ID <?= $usuario_id ?></h2>
  








<?php if ($resultado->num_rows === 0): ?>
    <p>Este usuario no tiene reservas registradas.</p>
<?php else: ?>
    <ul>
        <?php while ($reserva = $resultado->fetch_assoc()): ?>
            <li>
                <strong><?= $reserva['titulo'] ?></strong> (<?= $reserva['fecha'] ?>)<br>
                Plazas: <?= $reserva['cantidad'] ?> | Estado: <?= $reserva['estado'] ?> | Fecha reserva: <?= $reserva['fecha_reserva'] ?>
                <hr>
            </li>
        <?php endwhile; ?>
    </ul>
<?php endif; ?>
<p class="volver"><a href="usuarios.php">Volver al listado de ususarios</a><br><br></p>
</div>

</body>
</html>
