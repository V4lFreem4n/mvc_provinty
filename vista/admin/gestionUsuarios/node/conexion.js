let mysql = require("mysql");

let conexion = mysql.createConnection({
    host: "localhost",
    database: "bd_provinty",
    user: "root",
    password: ""


})

conexion.connect(function (err) {
    if (err) {
        throw err;
    } else {
        console.log("Conexion exitosa");
    }
});