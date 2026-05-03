<?php
session_start(); // Comienza sesión
session_unset(); // Borra datos de las variables
session_destroy();// Elimina sesión del servidor
header("Location: index.php"); // Redirecciona a otra página
exit;