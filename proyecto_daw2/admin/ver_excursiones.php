<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Administrador Excursiones</title>
</head>
<body>
    <div class="admin-panel">

        <?php

        // Archivos comunes

        include '../includes/db.php'; 
        include 'admin_auth.php'; 


        $sql = "SELECT * FROM excursiones";
        $result = $conexion->query($sql);

        echo "<h2>Listado de Excursiones</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Título</th><th>Fecha</th><th>Precio</th><th>Acciones</th></tr>";

        while ($fila = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$fila['id']}</td>";
            echo "<td>{$fila['titulo']}</td>";
            echo "<td>{$fila['fecha']}</td>";
            echo "<td>{$fila['precio']}</td>";
            echo "<td><a href='editar_excursiones.php?id={$fila['id']}'>Editar</a> |
                        <button onclick='eliminarExcursion({$fila['id']})'>Eliminar</button></td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
        <p class="volver"><a href="admin_panel.php">Volver al panel de administración</a></p>
        <p style="text-align: center; margin: 20px 0;">
        <a href="nueva_excursion.php" style="font-size: 18px">Agregar Excursión</a>
</p>
    </div>
    <script>
        function eliminarExcursion(id) {
            if (!confirm("¿Estás seguro de que deseas eliminar esta excursión?")) {
                return;
            }

            fetch('eliminar_excursion_ajax.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert("Excursión eliminada correctamente.");
                    location.reload(); 
                } else {
                    alert("Error al eliminar: " + data.error);
                }
            })
            .catch(error => {
                alert("Error inesperado.");
                console.error(error);
            });
        }
    </script>
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
            const mensaje = document.getElementById('mensaje-nueva');
            if (respuesta.success) {
                mensaje.innerHTML = "<p style='color:green;'>Excursión creada correctamente.</p>";
                form.reset();
                setTimeout(() => location.reload(), 1000); 
            } else {
                mensaje.innerHTML = "<p style='color:red;'>Error: " + respuesta.error + "</p>";
            }
        })
        .catch(error => {
            document.getElementById('mensaje-nueva').innerHTML = "<p style='color:red;'>Error inesperado.</p>";
            console.error(error);
        });
    });
    </script>
    
</body>
</html>