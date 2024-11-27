<?php
require_once '../autoload.php';
 

if(!isset($_GET['id'])){
    header("Location: ./cliente-general-eventos.php");
    exit();
}

$id = $_GET['id'];


$conexion = new Database();
$eventoObjeto = new Evento($conexion->connect());
$categoriaEventoObjeto = new Categoria_evento($conexion->connect());

$categoriasEvento   = $categoriaEventoObjeto->mostrarCategoriasEventos();
$eventos            = $eventoObjeto->mostrarEventos();

//Vamos a verificar si el id existe
$existenciaId=false;
foreach($eventos as $evento){
    if($evento['ID_Evento']==$id){
        $existenciaId = true;
    }
}

if(!$existenciaId){
    header('Location: cliente-general-eventos.php');
    exit(); 
}

foreach($eventos as $evento){
    if($evento['ID_Evento']==$id && $evento['visibilidad']!='Público'){
        header('Location: cliente-general-eventos.php');
        exit();
    }
}

include '../vista/clientes/cliente-evento.php';
?>
