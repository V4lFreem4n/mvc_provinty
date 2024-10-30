<?php

class Categoria_evento {

    private $connection;

    public function __construct($bd)
    {
     $this->connection = $bd;   
    }

    public function crearCategoriaEvento($nombre, $precio_venta, $precio_preventa, $id_evento) {
        
        

        // Supongamos que $this->conexion es tu conexión a la base de datos
        $sql = "INSERT INTO categoria_evento (nombre_categoria_evento, precio_venta, precio_preventa, ID_Evento) 
                VALUES (?, ?, ?, ?)";
    
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt, "sddi", $nombre, $precio_venta, $precio_preventa, $id_evento);
    
            // Ejecuta la declaración
            mysqli_stmt_execute($stmt);
    
            // Verifica si la inserción fue exitosa
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Categoría Evento creado correctamente.";
            } else {
                echo "Error al crear el Categoría Evento.";
            }
    
            // Cierra la declaración
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($this->connection);
        }
    }
    
    public function mostrarCategoriasEventos() {
        $sql = "SELECT * FROM categoria_evento";
        $result = mysqli_query($this->connection, $sql);
        $eventos = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $eventos[] = $row; // Agregar cada fila al array
            }
        }
    
        return $eventos; // Devuelve un array de eventos
    }
    

    public function contarEventosCreados(){
        // Consulta para contar las filas en la tabla eventos
        $sql = "SELECT COUNT(*) AS total FROM categoria_evento";

        // Ejecuta la consulta
        $result = mysqli_query($this->connection, $sql);

        // Verifica si se obtuvo un resultado
        if ($result) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total']; // Devuelve el total de filas
        } else {
        // Si hay un error, puedes manejarlo aquí
        echo "Error en la consulta: " . mysqli_error($this->connection);
        return 0; // Devuelve 0 en caso de error
        }
    }


    
    


}

?>