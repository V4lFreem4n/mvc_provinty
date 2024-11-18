<?php
require_once '../autoload.php';

session_start();
if($_SESSION['rol']!='superadministrador'){
    header("Location: ./login-trabajadores.php");
    exit();
}

include '../vista/admin/gestionUsuarios/index.php';
?>
