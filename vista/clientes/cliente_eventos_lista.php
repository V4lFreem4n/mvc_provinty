<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .header {
            background-color: #004f63;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            font-family: 'Lobster', cursive;
            font-size: 32px;
            margin: 0;
        }
        .header .login a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
            font-weight: bold;
        }
        .header .login a:hover {
            text-decoration: underline;
        }
        .carousel-container {
            margin: auto;
            max-width: 90%;
        }
        .carousel-inner img {
            height: 500px;
            object-fit: cover;
            width: 100%;
            border: 8px solid #004f63; /* Bordes en las imágenes */
            border-radius: 15px;
        }
        .carousel-caption-left {
            position: absolute;
            top: 40%;
            left: 5%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            color: white;
            text-align: center;
            width: 350px; /* Más ancho */
        }
        .carousel-caption-left h3 {
            margin-bottom: 15px;
            font-size: 28px; /* Más grande */
            font-weight: bold;
        }
        .carousel-caption-left p {
            margin: 10px 0;
            font-size: 20px;
        }
        .date-boxes {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }
        .date-box {
            background-color: #004f63;
            color: white;
            padding: 20px; /* Tamaño aumentado */
            border-radius: 10px;
            margin: 0 10px; /* Espaciado entre cuadros */
            text-align: center;
            font-size: 22px; /* Texto más grande */
            font-weight: bold;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .event-buttons {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .event-buttons button {
            background-color: #004f63;
            color: white;
            border: none;
            margin: 0 5px;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        .event-buttons button:hover {
            background-color: #007b93;
        }


    .zona-eventos {
        margin-top: 60px;
        background-color: #f9f9f9;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    .evento-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .evento-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .card-title {
        font-size: 18px;
        margin-bottom: 10px;
    }
    .card-text {
        font-size: 16px;
        color: #555;
    }
    .btn-primary {
        background-color: #004f63;
        border: none;
        font-weight: bold;
    }
    .btn-primary:hover {
        background-color: #007b93;
    }
    @media (max-width: 768px) {
        .evento-card {
            margin-bottom: 20px;
        }
    }
</style>
    
</head>
<body>
    <!-- Header -->
    <div class="header"> 
    <img src="../vista/clientes/img/logo_provint.png" width="100px">
    <?php
if (isset($_SESSION['roles'])) {
    echo '<div class="d-flex">
            ' . htmlspecialchars($_SESSION['nombre'], ENT_QUOTES, 'UTF-8') . '
            <a href="../controlador/cliente/logout.php" class="login-button ml-2">Cerrar Sesión</a>
          </div>';
} else {
    echo '<div class="login">
            <a href="./registro-cliente.php">Registrarse</a>
            <a href="./login-clientes.php">Login</a>
          </div>';
}
?>

    </div>


     <!-- Carrusel -->
     <div class="container mt-4 carousel-container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" id="carousel-inner"></div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

  <!-- Zona de Eventos -->
<section class="container zona-eventos mt-5">
    <h2 class="text-center mb-5" style="font-family: 'Lobster', cursive; color: #004f63;">Próximos Eventos</h2>
    <div class="row">
        <?php
        foreach ($eventos as $evento) {
            if ($evento['Estado_Publicacion'] !== "Cancelado" && $evento['visibilidad']=="Público") {
                echo "
                <div class='col-md-4 mb-4'>
                    <div class='card evento-card'>
                        <img class='card-img-top' src='../uploads/".$evento['Foto']."' alt='Imagen del Evento'>
                        <div class='card-body'>
                            <h5 class='card-title text-primary font-weight-bold'>". htmlspecialchars($evento['Titulo'])."</h5>
                            <p class='card-text descripcion'>". htmlspecialchars($evento['Descripcion']). "</p>
                            <a href='./cliente-evento.php?id=".$evento['ID_Evento']."' class='btn btn-primary btn-block'>Ver Detalles</a>
                        </div>
                    </div>
                </div>";
            }
        }
        ?>
    </div>
</section>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
  const maxLength = 100; // Máximo de caracteres
  const elements = document.querySelectorAll(".descripcion");

  elements.forEach((element) => {
    if (element.textContent.length > maxLength) {
      element.textContent = element.textContent.slice(0, maxLength) + "...";
    }
  });

//Carrusel, funcionalidades
(async ( ) => {

const result = await cargarImagenesCarousel (); //Usaremos API FETCH

}) ()

function cargarImagenesCarousel(){
    let div_carousel = document.getElementById("carousel-inner");


    let url = "../controlador/cliente/controlador_carousel.php";
    let data = "";
    fetch(url, {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
  })
  .then(response => response.json())
  .then(data => {
      console.log('Éxito:', data); //Vamos a usar éstos datos que recibimos y hacer cositas.
      //Conseguimos el nombre de las imágenes y cargamos el carousel dinámicamente
        //data = JSON.parse(data);
        eventos = data.data;
        eventos.forEach((element, index) => {
    let fecha = element['fecha'];
    let [anio, mes, dia] = fecha.split(" ")[0].split("-");

    let div = document.createElement("div");
    div.className = index === 0 ? "carousel-item active" : "carousel-item"; // Solo el primero tiene "active"
    div.innerHTML = `
        <img class="d-block w-100" src="../${element['nombre_imagen']}" alt="Imagen evento">
        <div class="carousel-caption-left">
            <h3>${element['nombre_evento']}</h3>
            <p>${element['artista']}</p>
            <div class="date-boxes">
                <div class="date-box">${dia}</div>
                <div class="date-box">${mes}</div>
                <div class="date-box">${anio}</div>
            </div>
        </div>`;
    div_carousel.appendChild(div);
});


  })
  .catch((error) => {
      console.error('Error:', error);
  });
}

</script>

</body>
</html>
