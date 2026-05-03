<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Excursiones Lanzarote</title>
</head>
<body>
<main>
<?php

// Archivos comunes

include 'includes/db.php';
include 'includes/header.php';

// Ordena y visualiza todas las excursiones

$sql = "SELECT * FROM excursiones ORDER BY fecha";
$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    echo '<div class="opciones-container" class="opcion" class="opcion-info">';
    echo "<h3>{$fila['titulo']}</h3>";
    echo "<p>{$fila['descripcion']}</p>";
    echo "<p>Fecha: {$fila['fecha']} | Precio: {$fila['precio']}€ </p>";
    echo "<a href='reserva.php?id={$fila['id']}'>Reservar</a>";
    echo "</div><hr>";
    echo "<div style='height: 80px;'></div>";
}
?>
</main>
    <footer>
        <p>&copy; 2025 Excursiones Lanzarote. Martins S.A. Todos los derechos reservados.</p>
     </footer>

</body>
</html>