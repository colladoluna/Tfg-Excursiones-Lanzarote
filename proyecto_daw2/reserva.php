<?php
// Archivos comunes

include 'includes/auth.php';
include 'includes/db.php';
include 'includes/header.php';

// Control de acceso

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
// Insercción de datos en tabla

$excursion_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $cantidad = $_POST['cantidad'];

    $sql = "INSERT INTO reservas (usuario_id, excursion_id, cantidad) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iii", $usuario_id, $excursion_id, $cantidad);
    $stmt->execute();

    echo "<div style='text-align: center;'>Reserva realizada con éxito.<a href='mis_reservas.php'>Ver mis reservas</a></div>";

}
?>
<!-- Recogida de datos -->
<div class="registro">
    <h3> Número de Plazas</h3>
    <form method="POST"> 
        <div style ="font-size:20px ;margin-bottom: 20px">
            Cantidad de plazas: <input  type="number" name="cantidad" min="1" required><br>
            <input type="submit" class="boton" value="Confirmar reserva">
        </div>
    </form>
</div>
<footer>
        <p>&copy; 2025 Excursiones Lanzarote. Martins S.A. Todos los derechos reservados.</p>
</footer>