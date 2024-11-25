const express = require("express");
const bodyParser = require("body-parser");
const mysql = require("mysql");

const app = express();
const PORT = 3000;

// Configuración de Body-Parser para manejar el cuerpo de las solicitudes POST
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Conexión a la base de datos MySQL
const conexion = mysql.createConnection({
    host: "localhost",
    database: "bd_provinty",
    user: "root",
    password: ""
});

conexion.connect(function (err) {
    if (err) {
        console.error("Error al conectar con la base de datos:", err);
        return;
    }
    console.log("Conexión exitosa a la base de datos");
});

// Ruta para guardar un nuevo usuario
app.post("/guardar-usuario", (req, res) => {
    const { nombreUsuario, contrasena, rol, dni, correo, numero } = req.body;

    // Validación básica para campos vacíos
    if (!nombreUsuario || !contrasena || !rol || !dni || !correo || !numero) {
        return res.status(400).send("Todos los campos son obligatorios");
    }

    // Consulta SQL para insertar un nuevo usuario
    const sql = "INSERT INTO usuarios (nombreUsuario, contrasena, rol, dni, correo, numero) VALUES (?, ?, ?, ?, ?, ?)";

    conexion.query(sql, [nombreUsuario, contrasena, rol, dni, correo, numero], function (err, result) {
        if (err) {
            console.error("Error al guardar el usuario:", err);
            return res.status(500).send("Error al guardar el usuario en la base de datos");
        }
        res.status(200).send("Usuario guardado correctamente");
    });
});

// Iniciar el servidor
app.listen(PORT, () => {
    console.log(`Servidor ejecutándose en el puerto ${PORT}`);
});
