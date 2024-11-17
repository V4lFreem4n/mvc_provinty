<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../vista/clientes/css/style.css"> <!-- Enlace al archivo CSS -->
</head>

<body>

    <div class="header"> 
        <h1 class="fade">PROVINTI</h1>

        <div class="login">
            <button class="search-icon">
                <i class="fas fa-search"></i> 
            </button>
            <a href="./registro-cliente.php" class="custom-link">Registrarse</a>
            <a href="./login-clientes.php" class="login-button">Login</a>
        </div>
    </div>

    <div class="contenedor" style="background-image: url('../vista/clientes/img/fondo.jpg'); background-size: cover; background-position: center;">
        <div class="left-section">
            <div class="festival-info">
                <h2>FESTIVAL KAVIPOR</h2>
                <p>31 de agosto de 2024</p>
                <p>1:00 pm</p>
                <button><a href="./cliente-general-eventos.php" class="h-100 w-100" style="color: wheat;text-decoration:none">Ver más</a></button>
            </div>
           
                
            <div class="countdown" id="countdown" >
    
                Falta: calculando...    

            </div>
        </div>
       
        <div class="right-section">
            <div class="event-details">
                <div class="non-clickable-buttons">
                    <span class="fake-button">Piura</span>
                    <span class="fake-button">Agosto</span>
                    <span class="fake-button">2024</span>
                </div>
                <p class="large-white-text">Piura Coliseo Municipal <i class="fas fa-map-marker-alt"></i></p>

                
                <div class="event-image">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1951.2449309040143!2d-81.18755922101533!3d-5.194152202404433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91abfb2242c8cd17%3A0x165337dc84810f12!2sColiseo%20Municipal%20de%20Piura!5e0!3m2!1ses-419!2spe!4v1696289820123!5m2!1ses-419!2spe"
                        width="300"
                        height="180"
                        style="border:0; border-radius: 10px;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
        
        
        </div> 
    
</div>
    <div class="event-buttons">
        <button>Todos</button>
        <button>Conciertos</button>
        <button>Teatro</button>
        <button>Cursos</button>
        <button>Entretenimiento</button>
        <button>Deportes</button>
        <button>Otros</button>
    </div>


    <script src="../vista/clientes/js/script.js"></script> <!-- Enlace al archivo JavaScript -->
</body>
</html>
