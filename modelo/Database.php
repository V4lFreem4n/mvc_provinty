<?php

// models/Database.php
class Database {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    public $conn;

    // Método para conectarse a la base de datos
    public function connect() {
        $this->conn = null;

        // Intentar conectarse a la base de datos
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);

        // Verificar si hay errores en la conexión
        if (mysqli_connect_errno()) {
            echo 'Connection Error: ' . mysqli_connect_error();
            return null;
        }

        return $this->conn;
    }

    // Función para ejecutar consultas SQL
    public function ejecutarConsulta($sql) {
        if (!$this->conn) {
            echo "No hay conexión a la base de datos.";
            return null;
        }
        
        $resultado = $this->conn->query($sql);
        
        if (!$resultado) {
            echo "1Error: " . $this->conn->error;
        }
        
        return $resultado;
    }

    // Función para cerrar la conexión
    public function cerrarConexion() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
