<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Pago Excursiones</title>
</head>
<body>
   
        <?php

        // Archivos comunes

        include 'includes/auth.php';
        include 'includes/db.php';
        include 'includes/header.php';

        $usuario_id = $_SESSION['usuario_id'];

        // Realización del pago

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserva_id'])) {
            $reserva_id = $_POST['reserva_id'];

            $stmt = $conexion->prepare("SELECT * FROM reservas WHERE id = ? AND usuario_id = ?");
            $stmt->bind_param("ii", $reserva_id, $usuario_id);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows === 1) {
                $update = $conexion->prepare("UPDATE reservas SET estado = 'confirmada' WHERE id = ?");
                $update->bind_param("i", $reserva_id);
                $update->execute();
                $mensaje = "¡Reserva pagada correctamente!";
            }
        }

        // Obtiene todas las reservas del usuario

        $sql = "SELECT r.id, r.cantidad, r.estado, r.fecha_reserva, e.titulo, e.fecha
                FROM reservas r
                JOIN excursiones e ON r.excursion_id = e.id
                WHERE r.usuario_id = ?
                ORDER BY r.fecha_reserva DESC";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $res = $stmt->get_result();
        ?>

        <!-- Visiualización de las reservas del usuario -->

        <div style='text-align: center'><h2>Mis reservas</h2></div>

        <?php if (isset($mensaje)): ?>
            <p style="color: green; font-weight: bold; text-align: center"><?= $mensaje ?></p>
        <?php endif; ?>

        <?php while ($row = $res->fetch_assoc()): ?>
            <div class="opcion" class="opcion-info" style ="margin: 20px auto">
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px; text-align: center">
                <strong><?= htmlspecialchars($row['titulo']) ?></strong> (<?= $row['fecha'] ?>)<br>
                Plazas: <?= $row['cantidad'] ?> | Estado: <strong><?= $row['estado'] ?></strong><br>
                Fecha de reserva: <?= $row['fecha_reserva'] ?><br>

                <?php if ($row['estado'] === 'pendiente'): ?>
                    <form method="POST" style="margin-top:5px;">
                        <input type="hidden" name="reserva_id" value="<?= $row['id'] ?>">
                        <input type="submit" value="Pagar ahora">
                    </form>
                <?php endif; ?>
            </div>
            </div>
        <?php endwhile; ?>

     </body>

</html>

    


