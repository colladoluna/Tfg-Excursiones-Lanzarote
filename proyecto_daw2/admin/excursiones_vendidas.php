<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Administrador Ventas</title>
</head>
<body>
    <?php

    // Archivos comunes

    include 'admin_auth.php';
    include '../includes/db.php';
    ?>

    <!-- Listado de excursiones vendidas -->
     
    <div class="admin-panel">
        <h2>Excursiones vendidas</h2>
        
        <!-- realización tabla visual -->

        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Excursión</th>
                    <th>Fecha</th>
                    <th>Plazas vendidas</th>
                    <th>Total Ventas (€)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Busqueda de excursiones vendidas
                $sql = "SELECT 
                            e.titulo, 
                            e.fecha,
                            SUM(r.cantidad) AS total_plazas,
                            SUM(r.cantidad * e.precio) AS total_recaudado
                        FROM reservas r
                        JOIN excursiones e ON r.excursion_id = e.id
                        WHERE r.estado = 'confirmada'
                        GROUP BY e.id
                        ORDER BY e.fecha ASC";

                $resultado = $conexion->query($sql);

                // Visualización en el listado 
                
                while ($fila = $resultado->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= htmlspecialchars($fila['titulo']) ?></td>
                        <td><?= $fila['fecha'] ?></td>
                        <td><?= $fila['total_plazas'] ?></td>
                        <td><?= number_format($fila['total_recaudado'], 2, ',', '.') ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <p class="volver"><a href="admin_panel.php">Volver al panel de administración</a></p>
</div>
</body>
</html>