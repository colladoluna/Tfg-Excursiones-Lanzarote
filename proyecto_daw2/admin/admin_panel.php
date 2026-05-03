<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Panel administrador</title>
</head>
<body>

<?php

// Archivos comunes

include 'admin_auth.php';

?>
<!-- Encabezado de página con redireccionamiento -->

<div class="admin-panel">
    <h1 class="titulo">Panel del Administrador</h1>   
    <p class="subtitulo">Bienvenido, <?= htmlspecialchars($_SESSION['admin_nombre']) ?></p>

<!-- Listado de opciones -->

    <ul>
        <li><a href="admin_reservas.php">Excursiones reservadas</a></li>
        <li><a href="excursiones_vendidas.php">Excursiones vendidas</a></li>
        <li><a href="usuarios.php">Listado usuarios</a></li>
        <li><a href="usuarios_compradores.php">Usuarios compradores</a></li>
        <li><a href="ver_excursiones.php">Listado excursiones</a></li>
    </ul>
    <a href="../index.php" class="volver">Volver al Inicio</a>
</div>
</body>
</html>