<?php
session_start();
include_once '../../autoload.php';

$conn = new Database();
$db = $conn->connect();
$cliente = new Cliente($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// Verificar si el formulario fue enviado usando el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombres = isset($_POST['nombres']) ? trim($_POST['nombres']) : null;
    $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $pais = isset($_POST['pais']) ? trim($_POST['pais']) : null;
    $tipo_documento = isset($_POST['tipo_documento']) ? trim($_POST['tipo_documento']) : null;
    $numero_documento = isset($_POST['numero_documento']) ? trim($_POST['numero_documento']) : null;
    $sexo = isset($_POST['sexo']) ? trim($_POST['sexo']) : null;
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? trim($_POST['fecha_nacimiento']) : null;
    $contraseña = isset($_POST['contraseña']) ? trim($_POST['contraseña']) : null;

    // Validaciones básicas
    if (!$nombres || !$apellidos || !$email || !$pais || !$tipo_documento || !$numero_documento || !$sexo || !$fecha_nacimiento || !$contraseña) {
        $_SESSION['error'] = "Por favor, completa todos los campos del formulario";
    header("Location: ../../public/registro-clientes.php");
    exit();
    }

    // Verificar si el correo ya existe
    if ($cliente->existeCorreo($email)) {
        $_SESSION['error'] = "El correo ya está registrado.";
        header("Location: ../../public/registro-clientes.php");
        exit();
    }

    $cliente->crearCliente($nombres,$apellidos,$numero_documento,$fecha_nacimiento,$email,$contraseña);
    //Falta establece la sesión
    unset($_SESSION['error']);
    header("Location: ../../public/login-clientes.php");
    exit();
   
} else {
    $_SESSION['error'] = "Acceso no válido. Por favor, envía el formulario.";
    header("Location: ../../public/registro-clientes.php");
    exit();
}

}
?>