<?php
session_start();

use Routes\Routes;

require_once '../vendor/autoload.php';
require_once '../config/config.php';

$dotenv=\Dotenv\Dotenv::createImmutable(dirname(__DIR__,1));
$dotenv->safeLoad();

// Verificar la cookie recuerdame y restaurar la sesión si es necesario
if (!isset($_SESSION["identity"]) && isset($_COOKIE["remember_me"])) {
    $user_id = $_COOKIE["remember_me"];

    // Crear una instancia vacía de Usuario
    $usuario = \Models\Usuario::createEmpty();

    // Buscar el usuario por su ID
    $usuario_encontrado = $usuario->buscaId($user_id);

    if ($usuario_encontrado) {
        // Restaurar la sesión del usuario
        $_SESSION["identity"] = $usuario_encontrado;
        if ($usuario_encontrado->rol == "admin") {
            $_SESSION["admin"] = true;
        }
    }
}


Routes::index();
?>