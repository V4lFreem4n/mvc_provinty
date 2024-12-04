<?php
require_once '../autoload.php';

session_start();
if(!isset($_SESSION['rol']) && !($_SESSION['rol'] == "superadministrador" || $_SESSION['rol'] == "administrador" ||$_SESSION['rol'] == "promotor")){
    header("Location: ./login-trabajadores.php");
        exit();
}

if(!isset($_GET['id'])){
    header("Location: ./admin-general.php");
    exit();
}

$id = $_GET['id'];



$db = new Database();

$eventosObjeto = new Evento($db->connect());
$eventos = $eventosObjeto->mostrarEventos();
$existenciaId=false;



foreach($eventos as $evento){
    if($evento['ID_Evento']==$id){
        $existenciaId = true;
        $nombreEvento = $evento['Titulo'];
    }
}

if(!$existenciaId){
    header('Location: admin-informes-eventos.php');
    exit(); 
}

$interaccionesObjeto = new Interaccion($db->connect());

$interacciones = $interaccionesObjeto->mostrarInteracciones();
$promedios = $interaccionesObjeto->obtenerPromedios($id);

$estrellas = $interaccionesObjeto->arrayEstrellas($id);
$arrayEstrellas = [
    (int)$estrellas['total_1_estrellas'],
    (int)$estrellas['total_2_estrellas'],
    (int)$estrellas['total_3_estrellas'],
    (int)$estrellas['total_4_estrellas'],
    (int)$estrellas['total_5_estrellas']
];
include '../vista/admin/informe/detalle_informes.php';

?>