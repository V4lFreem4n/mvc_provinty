<?php

class Evento {

    private $connection;

    public function __construct($bd)
    {
     $this->connection = $bd;   
    }

    public function crearEvento($titulo, $aforo, $precio_entrada, $precio_preventa, $foto, $descripcion, $artista,$fecha_evento, $fecha_creacion, $estado_publicacion) {
        // Supongamos que $this->conexion es tu conexión a la base de datos
        $sql = "INSERT INTO eventos (Titulo, Aforo, Precio_Entrada, Precio_Preventa, Foto, Descripcion, Artista_Autor, Fecha_Evento, Fecha_Creacion, Estado_Publicacion) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt, "siiissssss", $titulo, $aforo, $precio_entrada, $precio_preventa, $foto, $descripcion, $artista,$fecha_evento, $fecha_creacion, $estado_publicacion);
    
            // Ejecuta la declaración
            mysqli_stmt_execute($stmt);
    
            // Verifica si la inserción fue exitosa
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Evento creado correctamente.";
            } else {
                echo "Error al crear el evento.";
            }
    
            // Cierra la declaración
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($this->connection);
        }
    }
    
    public function mostrarEventos() {
        $sql = "SELECT * FROM eventos";
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
        $sql = "SELECT COUNT(*) AS total FROM eventos";

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


    public function eliminarEvento($id) {
        // Consulta para eliminar un evento por id
        $sql = "DELETE FROM eventos WHERE ID_Evento = ?";
    
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincula el parámetro
            mysqli_stmt_bind_param($stmt, "i", $id); // 'i' indica que el parámetro es un entero
    
            // Ejecuta la declaración
            mysqli_stmt_execute($stmt);
    
            // Verifica si se eliminó algún registro
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Evento eliminado correctamente.";
            } else {
                echo "No se encontró un evento con ese ID o ya ha sido eliminado.";
            }
    
            // Cierra la declaración
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($this->connection);
        }
    }

    public function editarEvento($id, $titulo, $aforo, $asistentes_actuales, $precio_entrada, $precio_preventa, $foto, $descripcion, $artista, $lugar, $fecha_evento, $fecha_creacion, $estado_publicacion) {
        // Consulta para actualizar un evento
        $sql = "UPDATE eventos SET 
                    titulo = ?, aforo = ?,  asistentes_actuales = ?, precio_entrada = ?, precio_preventa = ?, foto = ?, descripcion = ?,artista = ?,lugar = ?,fecha_evento = ?, fecha_creacion = ?, estado_publicacion = ? 
                WHERE id = ?";
    
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt, "siisssssssssi", 
                $titulo, 
                $aforo, 
                $asistentes_actuales, 
                $precio_entrada, 
                $precio_preventa, 
                $foto, 
                $descripcion, 
                $artista, 
                $lugar, 
                $fecha_evento, 
                $fecha_creacion, 
                $estado_publicacion, 
                $id); // El último parámetro es el ID
    
            // Ejecuta la declaración
            mysqli_stmt_execute($stmt);
    
            // Verifica si se actualizó algún registro
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Evento actualizado correctamente.";
            } else {
                echo "No se encontró un evento con ese ID o no se realizaron cambios.";
            }
    
            // Cierra la declaración
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($this->connection);
        }
    }
    
    

}

?>