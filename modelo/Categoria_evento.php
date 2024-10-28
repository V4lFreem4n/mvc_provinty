<?php

class Categoria_evento {

    private $connection;

    public function __construct($bd, $id_evento)
    {
     $this->connection = $bd;   
    }

    public function crearEvento($nombre, $precio_venta, $precio_preventa, $id_evento) {
        
        

        // Supongamos que $this->conexion es tu conexión a la base de datos
        $sql = "INSERT INTO categoria_evento (nombre_categoria_evento, precio_venta, precio_preventa, ID_Evento) 
                VALUES (?, ?, ?, ?)";
    
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt, "sddi", $nombre, $precio_venta, $precio_preventa, $id_evento, $foto);
    
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


    public function eliminarEvento($id) {
        // Consulta para eliminar un evento por id
        $sql = "DELETE FROM categoria_evento WHERE id = ?";
    
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincula el parámetro
            mysqli_stmt_bind_param($stmt, "i", $id); // 'i' indica que el parámetro es un entero
    
            // Ejecuta la declaración
            mysqli_stmt_execute($stmt);
    
            // Verifica si se eliminó algún registro
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "categoria_evento eliminado correctamente.";
            } else {
                echo "No se encontró un categoria_evento con ese ID o ya ha sido eliminado.";
            }
    
            // Cierra la declaración
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($this->connection);
        }
    }
/*
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
*/
 
    
    public function visibilizarEvento($id) {
        $sql = "UPDATE eventos SET visibilidad = 'Público' WHERE ID_Evento = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
    
        // Vincula el parámetro id con la consulta
        mysqli_stmt_bind_param($stmt, "i", $id);
    
        // Ejecuta la consulta
        mysqli_stmt_execute($stmt);
        
        // Verifica si se actualizó algún registro
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Evento actualizado correctamente.";
        } else {
            echo "No se encontró un evento con ese ID o no se realizaron cambios.";
        }
    
        // Cierra la declaración
        mysqli_stmt_close($stmt);
    }

    public function ocultarEvento($id) {
        $sql = "UPDATE eventos SET visibilidad = 'Privado' WHERE ID_Evento = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
    
        // Vincula el parámetro id con la consulta
        mysqli_stmt_bind_param($stmt, "i", $id);
    
        // Ejecuta la consulta
        mysqli_stmt_execute($stmt);
        
        // Verifica si se actualizó algún registro
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Evento actualizado correctamente.";
        } else {
            echo "No se encontró un evento con ese ID o no se realizaron cambios.";
        }
    
        // Cierra la declaración
        mysqli_stmt_close($stmt);
    }
    
    
    public function conseguirTiempoBorrado($id){
        $sql = "UPDATE eventos SET f_borrado = ?, hora_borrado = ? WHERE ID_Evento = ?";
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d');
        $horaActual = date('H:i:s');
    
        // Preparar la consulta
        $stmt = mysqli_prepare($this->connection, $sql);
        
        // Verificar si la preparación fue exitosa
        if (!$stmt) {
            die('Error al preparar la consulta: ' . mysqli_error($this->connection));
        }
    
        // Vincula los parámetros
        mysqli_stmt_bind_param($stmt, "ssi", $fechaActual, $horaActual, $id);
        
        // Ejecuta la consulta
        if (!mysqli_stmt_execute($stmt)) {
            die('Error al ejecutar la consulta: ' . mysqli_stmt_error($stmt));
        }
    
        // Verifica si se actualizó algún registro
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Evento actualizado correctamente.";
        } else {
            echo "No se encontró un evento con ese ID o no se realizaron cambios.";
        }
    
        // Cierra la declaración
        mysqli_stmt_close($stmt);
    }
    


}

?>