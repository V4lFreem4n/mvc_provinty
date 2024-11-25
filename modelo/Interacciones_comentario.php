<?php

class InteraccionesComentario {

    private $connection;

    public function __construct($bd)
    {
     $this->connection = $bd;   
    }

    public function crearInteraccionComentarios($comentario, $id_cliente, $id_evento) {
        // Primero comprobamos si ya existe una fila con el id_cliente e id_evento
        $sql_check = "SELECT id FROM interaccion_comentarios WHERE id_cliente = ? AND id_evento = ?";
        
        // Prepara la declaración para la consulta SELECT
        $stmt_check = mysqli_prepare($this->connection, $sql_check);
        
        if ($stmt_check) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt_check, "ii", $id_cliente, $id_evento);
            
            // Ejecuta la consulta
            mysqli_stmt_execute($stmt_check);
            
            // Almacena los resultados para procesarlos correctamente
            mysqli_stmt_store_result($stmt_check);
            
            // Verificamos si se encontró algún resultado
            if (mysqli_stmt_num_rows($stmt_check) > 0) {
                // Si existe una fila con el mismo id_cliente e id_evento, actualizamos el comentario
                $sql_update = "UPDATE interaccion_comentarios SET comentario = ? WHERE id_cliente = ? AND id_evento = ?";
                
                $stmt_update = mysqli_prepare($this->connection, $sql_update);
                
                if ($stmt_update) {
                    // Vincula los parámetros
                    mysqli_stmt_bind_param($stmt_update, "sii", $comentario, $id_cliente, $id_evento);
                    
                    // Ejecuta la actualización
                    if (mysqli_stmt_execute($stmt_update)) {
                        echo "Comentario actualizado correctamente.";
                    } else {
                        echo "No se pudo actualizar el comentario.";
                    }
                    
                    // Cierra la declaración de actualización
                    mysqli_stmt_close($stmt_update);
                } else {
                    echo "Error en la preparación de la consulta de actualización: " . mysqli_error($this->connection);
                }
            } else {
                // Si no existe, hacemos un INSERT
                $sql_insert = "INSERT INTO interaccion_comentarios (comentario, id_cliente, id_evento) VALUES (?, ?, ?)";
                
                $stmt_insert = mysqli_prepare($this->connection, $sql_insert);
                
                if ($stmt_insert) {
                    // Vincula los parámetros
                    mysqli_stmt_bind_param($stmt_insert, "sii", $comentario, $id_cliente, $id_evento);
                    
                    // Ejecuta el INSERT
                    if (mysqli_stmt_execute($stmt_insert)) {
                        echo "Comentario creado correctamente.";
                    } else {
                        echo "Error al crear el comentario.";
                    }
                    
                    // Cierra la declaración de inserción
                    mysqli_stmt_close($stmt_insert);
                } else {
                    echo "Error en la preparación de la consulta de inserción: " . mysqli_error($this->connection);
                }
            }
            
            // Cierra la declaración de la consulta de comprobación
            mysqli_stmt_close($stmt_check);
        } else {
            echo "Error en la preparación de la consulta de comprobación: " . mysqli_error($this->connection);
        }
    }

    public function mostrarInteracciones() {
        $sql = "SELECT * FROM interaccion_comentarios";
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $eventos = [];
    
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $eventos[] = $row; // Agregar cada fila al array
                }
            }
    
            mysqli_stmt_close($stmt);
            return $eventos; // Devuelve un array de eventos
        }
    
        return false; // Si no hay resultados
    }

    public function mostrarInteraccionesById($id) {
        $sql = "SELECT * FROM interaccion_comentarios WHERE id=?";
        $stmt = mysqli_prepare($this->connection, $sql);
    
        if ($stmt) {
            // Vincular los parámetros a la consulta
            mysqli_stmt_bind_param($stmt, "i", $id);
    
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
        return false;
    }
}
    


    ?>