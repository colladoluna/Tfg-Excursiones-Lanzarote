<?php

// Archivos comunes

include 'includes/auth.php';
include 'includes/db.php';
include 'includes/header.php'; 

$usuario_id = $_SESSION['usuario_id'];

// Obtiene todas las reservas del usuario

$sql = "SELECT e.titulo, e.fecha, r.cantidad, r.fecha_reserva
        FROM reservas r
        JOIN excursiones e ON r.excursion_id = e.id
        WHERE r.usuario_id = ? AND r.estado = 'confirmada'
        ORDER BY e.fecha";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$res = $stmt->get_result();
?>

<!-- Comprueba la compra de excursiones -->

<div style='text-align:center'><h2>Excursiones compradas</h2></div>

<?php if ($res->num_rows === 0): ?>
    <p>No has comprado ninguna excursión todavía.</p>
<?php else: ?>
    <?php while ($row = $res->fetch_assoc()): ?>
        <div class="opcion" class="opcion-info" style ="margin: 20px auto">
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;text-align: center">
            <strong><?= htmlspecialchars($row['titulo']) ?></strong> (<?= $row['fecha'] ?>)<br>
            Plazas compradas: <?= $row['cantidad'] ?><br>
            Comprado el: <?= $row['fecha_reserva'] ?>
        </div>
    </div>
    <?php endwhile; ?>
<?php endif; ?>

