<?php
session_start();
//var_dump($_SESSION);  // Imprime la información de la sesión para ver si contiene los datos esperados.
 
require_once '../autoload.php';


// Verificar si hay una sesión activa, si no la hay, redirigir al login

 if (!isset($_SESSION['usuario_id'])) {
    header("Location: login-trabajadores.php");
    
    //header("Location: Y");
    exit();
}


// Manejo de errores
$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Eliminar el error de la sesión después de capturarlo
}

// Incluir la página principal solo si el usuario está autenticado
 
 include '../vista/admin/gestionGeneral/principal.php';
