<?php

// Archivos comunes

include '../includes/db.php';
include 'admin_auth.php';


function mostrarError($mensaje) {
    echo "<p style='color:red; text-align:center;'>$mensaje</p>";
    echo "<p style='text-align:center;'><a style='color: purple;' href='admin_panel.php'>Volver al panel de administración</a></p>";
    exit;
}

// Valida el id

if (!isset($_GET['id'])) {
    mostrarError("ID no especificado.");
}

$id = intval($_GET['id']);

// Consulta segura

$sql = "SELECT * FROM excursiones WHERE id = ?";
$stmt = $conexion->prepare($sql);

// Verifica la consulta
if (!$stmt) {
    mostrarError("Error al preparar la consulta: " . $conexion->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

// Comprobación si existe excursión

if ($res->num_rows === 0) {
    mostrarError("Excursión no encontrada.");
}

$excursion = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Excursión</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>
    <div style='text-align:center'><h2>Editar Excursión</h2></div>
     <div style='text-align:center' style=" background-color: white;">
        <form id="formEditarExcursion">
            <input type="hidden" name="id" value="<?= $excursion['id'] ?>">
            Título: <input type="text" name="titulo" value="<?= $excursion['titulo'] ?>" required><br>
            Descripción: <textarea name="descripcion" required><?= $excursion['descripcion'] ?></textarea><br>
            Fecha: <input type="date" name="fecha" value="<?= $excursion['fecha'] ?>" required><br>
            Duración (horas): <input type="number" name="duracion_horas" value="<?= $excursion['duracion_horas'] ?>" required><br>
            Precio: <input type="number" step="0.01" name="precio" value="<?= $excursion['precio'] ?>" required><br>
            <button type="submit">Guardar cambios</button>
        </form>

        <div id="mensaje" style="text-align:center; margin-top: 20px;"></div>
        <p class="volver"><a href="admin_panel.php">Volver al panel de administración</a></p>
     </div>
    

    <script>
        document.getElementById('formEditarExcursion').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;

            const datos = {
                id: form.id.value,
                titulo: form.titulo.value,
                descripcion: form.descripcion.value,
                fecha: form.fecha.value,
                duracion_horas: form.duracion_horas.value,
                precio: form.precio.value
            };

            fetch('guardar_excursiones_ajax.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(datos)
            })
            .then(res => res.json())
            .then(respuesta => {
                const mensaje = document.getElementById('mensaje');
                if (respuesta.success) {
                    mensaje.innerHTML = "<p style='color:green;'>Excursión actualizada correctamente.</p>";
                } else {
                    mensaje.innerHTML = "<p style='color:red;'>Error: " + respuesta.error + "</p>";
                }
            })
            .catch(error => {
                document.getElementById('mensaje').innerHTML = "<p style='color:red;'>Error inesperado.</p>";
                console.error("Error en fetch:", error);
            });
        });
    </script>
    </div>
</body>
</html>