<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="estilo.css">
    <title>Iniciar Sesión</title>
</head>
<body>

    <?php
    // Archivos comunes

    include 'includes/db.php';
    include 'includes/header.php';


    // Recoge datos 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $sql = "SELECT * FROM usuarios WHERE email = ?"; // Comprueba datos
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        if ($usuario && password_verify($pass, $usuario['password'])) { 
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header("Location: index.php");
        } else {
            echo "<div style='text-align: center;'>Credenciales incorrectas</div>";
        }
    }
    ?>
    <!-- Recogida datos -->

    <div class="registro">
        <h3> Inicio Sesión</h3>
        <form method="POST">
            Email: <input class="dato" type="email" name="email"><br>
            Contraseña: <input class="dato" type="password" name="password"><br>
            <input class="boton" type="submit" value="Iniciar sesión">
        <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
        </form>
    </div>

    <footer>
            <p>&copy; 2025 Excursiones Lanzarote. Martins S.A. Todos los derechos reservados.</p>
    </footer>
</body>
</html>