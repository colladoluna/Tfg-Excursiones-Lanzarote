<?php

// Comprabación sesión activa

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si no hay sesión aciva se redirecciona

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}