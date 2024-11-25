<?php

class InteraccionesEstrellas {

    private $connection;

    public function __construct($bd)
    {
     $this->connection = $bd;   
    }

    public function crearInteraccionEstrellas($estrellas, $idCliente, $idEvento) {
    
    
        // Consulta SQL actualizada para incluir los nuevos campos
        $sql = "INSERT INTO interacciones_estrellas (estrellas, id_cliente, id_evento) 
                VALUES (?, ?, ?)";
        
        // Prepara la declaración
        $stmt = mysqli_prepare($this->connection, $sql);
        
        if ($stmt) {
            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt, "iii", $estrellas, $idCliente, $idEvento);
        
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

    public function mostrarInteracciones() {
        $sql = "SELECT * FROM interacciones_estrellas";
        $result = mysqli_query($this->connection, $sql);
        $eventos = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $eventos[] = $row; // Agregar cada fila al array
            }
        }
    
        return $eventos; // Devuelve un array de eventos
    }

    public function actualizarOcrearInteraccion($estrellas, $id_cliente, $id_evento) {
        // Verificar si ya existe una fila con el mismo id
        $sql = "SELECT * FROM interacciones_estrellas WHERE id_cliente=? AND id_evento=?";
        $stmt = mysqli_prepare($this->connection, $sql);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ii", $id_cliente,$id_evento);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
    
            // Si la fila existe, actualizarla
            if ($result && mysqli_num_rows($result) > 0) {
                // Fila existe, hacemos un UPDATE
                $sql_update = "UPDATE interacciones_estrellas SET estrellas = ? WHERE id_cliente = ? AND id_evento=?";
                $stmt_update = mysqli_prepare($this->connection, $sql_update);
                
                if ($stmt_update) {
                    // Vincula los parámetros
                    mysqli_stmt_bind_param($stmt_update, "iii", $estrellas, $id_cliente, $id_evento);
                    // Ejecuta la actualización
                    mysqli_stmt_execute($stmt_update);
                    mysqli_stmt_close($stmt_update);
    
                    return true; // Fila actualizada correctamente
                }
            } else {
                // Si la fila no existe, insertamos una nueva fila
                $sql_insert = "INSERT INTO interacciones_estrellas (estrellas, id_cliente, id_evento) VALUES (?, ?, ?)";
                $stmt_insert = mysqli_prepare($this->connection, $sql_insert);
    
                if ($stmt_insert) {
                    // Vincula los parámetros
                    mysqli_stmt_bind_param($stmt_insert, "iii", $estrellas, $id_cliente, $id_evento);
                    // Ejecuta la inserción
                    mysqli_stmt_execute($stmt_insert);
                    mysqli_stmt_close($stmt_insert);
    
                    return true; // Fila insertada correctamente
                }
            }
            
            // Cerrar el statement de selección
            mysqli_stmt_close($stmt);
        }
    
        // Si algo salió mal
        return false;
    }
    

}
    ?>