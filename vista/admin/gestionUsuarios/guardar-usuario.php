<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_provinty";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se enviaron datos por POST
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

    // Insertar usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombreUsuario, contrasena, rol, dni, correo, numero, fotoURL) 
            VALUES ('$nombreUsuario', '$contrasena', '$rol', '$dni', '$correo', '$numero', '$fotoURL')";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario guardado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
