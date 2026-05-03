<?php

// Inicia sesión

session_start();

// Si no hay sesión aciva se redirecciona

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}