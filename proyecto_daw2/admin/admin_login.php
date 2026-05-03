<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Login Administrador</title>
</head>
<body>

<?php

// Archivos comunes

include '../includes/db.php';

// Inicia sesión

session_start();

// Recoge datos del formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conexion->prepare("SELECT * FROM administrador WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $admin = $resultado->fetch_assoc();

    echo "<pre>";
    print_r($admin);
    echo "</pre>";



    if ($admin && password_verify($pass, $admin['password'])) { // Inicia sesión como Administrador
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_nombre'] = $admin['nombre'];
        header("Location: admin_panel.php");
        exit;
    } else {
        echo "<div style='text-align: center; margin-top:30px;'>Credenciales incorrectas</div>";
    }
}
?>

<!-- Datos del formulario -->

<div class="inicio2">
    <h2>Login de administrador</h2>
<form method="POST">
    Email: <input class="dato" type="email" name="email" required><br>
    Contraseña: <input class="dato" type="password" name="password" required><br>
    <input class="botom2" type="submit" value="Iniciar sesión">
</form>
<p>¿Eres usuario? <a href="../index.php">Volver Menu Principal</a></p>
</div>
</body>
</html>