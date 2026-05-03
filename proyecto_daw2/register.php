<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Registro</title>
</head>
<body>

<?php

// Archivos comunes

include 'includes/db.php';
include 'includes/header.php';


// Insercción de datos en tabla

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $telefono = $_POST['telefono'];

    $verificar = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
    $verificar->bind_param("s", $email);
    $verificar->execute();
    $resultado = $verificar->get_result();

    if ($resultado->num_rows > 0) {
             echo "<div style='text-align: center; color: red;'>Este correo ya está registrado. <a href='login.php'>Iniciar sesión</a></div>";
    } else {
        $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, telefono) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $apellidos, $email, $pass, $telefono);

        if ($stmt->execute()) {
            echo "<div style='text-align: center; color: green;'>Usuario registrado correctamente. <a href='login.php'>Iniciar sesión</a></div>";
        } else {
            echo "<div style='text-align: center; color: red;'>Error al registrar: " . $stmt->error . "</div>";
        }
    }
}
?>

<div style='text-align: center; padding-bottom: -5px;'>Rellene el formulario con sus datos</div>";
<!-- Recogida de datos -->
<div class="registro">
<form method="POST">
    <div class="dato">
        <h3> Formulario de registro</h3>
        Nombre: <input type="text" name="nombre" required><br>
        Apellidos: <input type="text" name="apellidos" required><br>
        Email: <input type="email" name="email" required><br>
        Contraseña: <input type="password" name="password" required><br>
        Teléfono: <input type="text" name="telefono" required><br>
    </div>
    <input class="boton" type="submit" value="Registrarse">
</form>
</div>

</body>
<footer>
        <p>&copy; 2025 Excursiones Lanzarote. Martins S.A. Todos los derechos reservados.</p>
</footer>
</html>
