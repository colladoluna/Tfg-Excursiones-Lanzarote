<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Administrador Usuarios</title>
</head>
<body>
    <?php

    // Archivos comunes

    include 'admin_auth.php';
    include '../includes/db.php';
    ?>

    <!-- Usuarios registrados-->
    <div class="admin-panel">

        <h2>Listado de usuarios registrados</h2>
        
        <!-- Realización encabezados-->

        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Fecha registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Ordena la tabla por fecha

                $resultado = $conexion->query("SELECT * FROM usuarios ORDER BY fecha_registro DESC");

                // Recorre la tabla

                while ($usuario = $resultado->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= $usuario['id'] ?></td>
                        <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td><?= $usuario['telefono'] ?: 'No especificado' ?></td>
                        <td><?= $usuario['fecha_registro'] ?></td>
                        <td>
                            <a href="usuario_reservas.php?id=<?= $usuario['id'] ?>">Ver reservas</a> |
                            <a href="usuario_eliminar.php?id=<?= $usuario['id'] ?>" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <p class="volver"><a href="admin_panel.php">Volver al panel de administración</a></p>
    </div>
</body>
</html>