<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../includes/db.php';
include 'admin_auth.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear nueva excursión</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>
    <div style="text-align: center">;
    <div class="admin-panel">
        <h2>Crear nueva excursión</h2>

        <form id="formNuevaExcursion">
            Título: <input type="text" name="titulo" required><br>
            Descripción: <textarea name="descripcion" required></textarea><br>
            Fecha: <input type="date" name="fecha" required><br>
            Duración (horas): <input type="number" name="duracion_horas" required><br>
            Precio: <input type="number" step="0.01" name="precio" required><br>
            <button type="submit">Guardar excursión</button>
        </form>

        <div id="mensaje" style="margin-top: 10px;"></div>

        <p class ="volver"><a href="ver_excursiones.php">Volver al listado de excrusiones</a></p>
    </div>

    <script>
    document.getElementById('formNuevaExcursion').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const datos = {
            titulo: form.titulo.value,
            descripcion: form.descripcion.value,
            fecha: form.fecha.value,
            duracion_horas: form.duracion_horas.value,
            precio: form.precio.value
        };

        fetch('crear_excursion_ajax.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datos)
        })
        .then(res => res.json())
        .then(respuesta => {
            const mensaje = document.getElementById('mensaje');
            if (respuesta.success) {
                mensaje.innerHTML = "<p style='color:green;'>Excursión creada correctamente.</p>";
                form.reset();
            } else {
                mensaje.innerHTML = "<p style='color:red;'>Error: " + respuesta.error + "</p>";
            }
        })
        .catch(error => {
            document.getElementById('mensaje').innerHTML = "<p style='color:red;'>Error inesperado.</p>";
            console.error(error);
        });
    });
    </script>
    </div>
</body>
</html>