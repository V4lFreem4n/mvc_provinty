<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "victor", "victor", "provintybd");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Función para ejecutar consultas
function ejecutarConsulta($sql) {
    global $conexion;
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        echo "Error: " . $conexion->error;
    }
    return $resultado;
}

// Función para cerrar la conexión
function cerrarConexion() {
    global $conexion;
    $conexion->close();
}
?>

