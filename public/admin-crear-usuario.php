<?php
require_once '../autoload.php';

//Acá le tenemos que pasar todas las variables que se necesitan, okey?
$conexion = new Database();
$usuariObjeto = new Usuario($conexion->connect());
$usuarios = $usuariObjeto->mostrarUsuario();

include '../vista/admin/gestionUsuarios/admin-crear-usuario-view.php';

?>