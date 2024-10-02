<?php

include_once '../../autoload.php';


$conn = new Database();
$evento = new Usuario($conn->connect());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST["nombreUsuario"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT); // Encriptar la contraseña
    $rol = $_POST["rol"];
    $dni = $_POST["dni"];
    $correo = $_POST["correo"];
    $numero = $_POST["numero"];
    $fotoURL = ""; // Opcional para guardar la ruta de la imagen

    // Si se ha subido una foto, manejar la subida del archivo
    if (!empty($_FILES["foto"]["name"])) {
        $fotoTmpPath = $_FILES["foto"]["tmp_name"];
        $fotoName = $_FILES["foto"]["name"];
        $fotoSize = $_FILES["foto"]["size"];
        $fotoType = $_FILES["foto"]["type"];
        $fotoExt = pathinfo($fotoName, PATHINFO_EXTENSION);
        $newFileName = $nombreUsuario . "_foto." . $fotoExt;

        $uploadDir = "uploads/";
        $dest_path = $uploadDir . $newFileName;

        if (move_uploaded_file($fotoTmpPath, $dest_path)) {
            $fotoURL = $dest_path;
        }
    }

    $evento->crearUsuario($nombreUsuario,$nombreUsuario,1,$contrasena,$dni,"12-12-2024");
    header("Location: ../../public/admin-crear-usuario.php");
    exit();
}
?>