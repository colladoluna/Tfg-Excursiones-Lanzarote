<?php
echo "administrador.- admin@excursiones.com.- contraseña: admin123";
echo password_hash("admin123", PASSWORD_DEFAULT);

echo "usuario.- usuario@excursiones.com.- contraseña: usuario123";
echo password_hash("usuario123", PASSWORD_DEFAULT);

/* Genera contraseña en caso de error al logar al administrador/usuario. Pasos a seguir. En http://localhost/proyecto_daw2/generar_contraseña.php nos 
genera un código que debemos cambiar en phpmyadmin, tabla administrador/usuarios campo password 

*/
?>