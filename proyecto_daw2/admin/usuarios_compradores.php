<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Administrador U. Compradores</title>
</head>
<body>
    <div class="admin-panel">
    <?php

    // Archivos comunes

    include 'admin_auth.php';
    include '../includes/db.php';
    
    ?>

    <h2>Usuarios que han comprado excursiones</h2>

    <!-- Realización encabezados-->

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Excursiones compradas</th>
                <th>Total de plazas</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Busqueda en excursiones y usuarios

            $sql = "SELECT 
                        u.nombre, 
                        u.email,
                        COUNT(DISTINCT r.excursion_id) AS excursiones_compradas,
                        SUM(r.cantidad) AS total_plazas
                    FROM reservas r
                    JOIN usuarios u ON r.usuario_id = u.id
                    WHERE r.estado = 'confirmada'
                    GROUP BY u.id
                    ORDER BY total_plazas DESC";

            $resultado = $conexion->query($sql);

            //Recorre la tabla
            
            while ($row = $resultado->fetch_assoc()):
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= $row['excursiones_compradas'] ?></td>
                    <td><?= $row['total_plazas'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <p class="volver"><a href="admin_panel.php">Volver al panel de administración</a></p>
</div>
</body>
</html>