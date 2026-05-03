<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Excursiones Lanzarote</title>
</head>
<body>
    <?php

    // Comprabación sesiones activas

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>
    <header>
        <div class="logo">
            <img src="imagenes/logo.png" class="imagenlogo" alt="Logo Lanzarote">
            <h2>Excursiones Lanzarote. Naturaleza y Arte en la isla.</h2>
        </div>
        <!-- Nos muestra la cabecera segun el login-->
        <nav>
            <?php if (isset($_SESSION['usuario_id'])): ?>
            <span>Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Usuario') ?></strong> | </span>
                <div class="tamaño_enlaces">
                <a href="index.php">Inicio</a> |
                <a href="mis_reservas.php">Mis reservas</a> |
                <a href="excursiones_pagadas.php">Excursiones compradas</a> |
                <a href="logout.php">Cerrar sesión</a>
                </div>
            <?php elseif (isset($_SESSION['admin_id'])): ?>
                <span>Administrador: <strong><?= htmlspecialchars($_SESSION['admin_nombre'] ?? 'Admin') ?></strong> | </span>
                <a href="admin/admin_panel.php">Panel Admin</a> |
                <a href="logout.php">Cerrar sesión</a>
            <?php else: ?>
                <a href="login.php">Iniciar sesión</a> |
                <a href="register.php">Registrarse</a> |
                <a href="admin/admin_login.php">Acceso admin</a>
            <?php endif; ?>
        </nav>       
    </header>
    
</body>
</html>






