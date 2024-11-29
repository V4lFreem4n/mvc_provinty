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

$nombreEvento = "";

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

include '../vista/admin/informe/detalle_informes.php';

?>