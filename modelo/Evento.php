<?php

class Evento {

    private $connection;

    public function __construct($bd)
    {
     $this->connection = $bd;   
    }

    public function crearEvento($titulo, $aforo, $foto, $descripcion, $artista, $terminosCondiciones, $fecha_evento, $fecha_creacion, $estado_publicacion, $organizador, $contactoOrganizador, $ubicacion, $horaInicioEvento, $horaFinEvento, $redes,$id_usuario_pk) {
    
        $visibilidad = 'Privado';

    

        // Consulta SQL actualizada para incluir los nuevos campos
        $sql = "INSERT INTO eventos (Titulo, Aforo, Foto, Descripcion, terminos_condiciones, Artista_Autor, Fecha_Evento, Fecha_Creacion, Estado_Publicacion, Visibilidad, Organizador, Contacto_Organizador, ubicacion, horaInicioEvento	, horaFinEvento, redes, id_usuario) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
        
        if ($stmt) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt, "sissssssssssssssi", $titulo, $aforo, $foto, $descripcion, $artista, $terminosCondiciones, $fecha_evento,
             $fecha_creacion, $estado_publicacion, $visibilidad, $organizador, $contactoOrganizador, $ubicacion, $horaInicioEvento, $horaFinEvento, $redes, $id_usuario_pk);
        
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
    
    public function obtenerUsuarioPorIdEvento($idUsuario) {
        // Consulta SQL con INNER JOIN
        $sql = "
            SELECT usuarios.* 
            FROM usuarios
            INNER JOIN eventos ON usuarios.id = eventos.id_usuario
            WHERE usuarios.id = ?";
    
        // Preparar la consulta
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincular los parámetros a la consulta
            mysqli_stmt_bind_param($stmt, "i", $idUsuario);
    
            // Ejecutar la consulta
            mysqli_stmt_execute($stmt);
    
            // Obtener el resultado
            $result = mysqli_stmt_get_result($stmt);
    
            // Verificar si hay resultados
            if ($result && mysqli_num_rows($result) > 0) {
                // Devolver los datos del usuario como un array asociativo
                return mysqli_fetch_assoc($result);
            }
    
            // Cerrar el statement
            mysqli_stmt_close($stmt);
        }
    
        // Retornar null si no se encuentra
        return null;
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

    public function eliminarLogicamenteEvento($id) {
        $sql = "UPDATE eventos SET estado_publicacion = 'Cancelado' WHERE ID_Evento = ?";
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

    public function proximoId(){
        $sql = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".DB_NAME."' AND TABLE_NAME = 'eventos'";
        $result = mysqli_query($this->connection, $sql);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['AUTO_INCREMENT'];
            return $id;
        } else {
            return 0;
        }
    }
    


}

?>