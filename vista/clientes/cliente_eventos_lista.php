<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../vista/clientes/css/style.css"> <!-- Enlace al archivo CSS -->
</head>

<body style="background-color: #eedada;">

    <div class="header"> 
        <h1 class="fade">PROVINTI</h1>

        <div class="login">
            <a href="./registro-cliente.php" class="custom-link">Registrarse</a>
            <a href="#" class="login-button">Login</a>
        </div>
    </div>

  <section>
  <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div id="carouselExampleIndicators" class="carousel slide d-flex" data-ride="carousel">
    <div class="carousel-inner mx-auto" style="justify-content: center;">
      <div class="carousel-item active">
        <img class="d-block" src="./images/fondo.webp" width="auto" height="500px" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block" src="./images/fondo_carro_1.webp" width="auto" height="500px" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block" src="./images/tercer_fondo.webp" width="auto" height="500px" alt="Third slide">
      </div>
    </div>
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
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

  </section>

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

    <div class="container d-flex my-4">
      <div class="d-flex"><p class="my-auto mr-5">Encuentra eventos en tu región</p></div>
    <select name="regiones" id="regiones" class="form-select">
  <option value="Amazonas">Amazonas</option>
  <option value="Áncash">Áncash</option>
  <option value="Apurímac">Apurímac</option>
  <option value="Arequipa">Arequipa</option>
  <option value="Ayacucho">Ayacucho</option>
  <option value="Cajamarca">Cajamarca</option>
  <option value="Callao">Callao</option>
  <option value="Cusco">Cusco</option>
  <option value="Huancavelica">Huancavelica</option>
  <option value="Huánuco">Huánuco</option>
  <option value="Ica">Ica</option>
  <option value="Junín">Junín</option>
  <option value="La Libertad">La Libertad</option>
  <option value="Lambayeque">Lambayeque</option>
  <option value="Lima">Lima</option>
  <option value="Loreto">Loreto</option>
  <option value="Madre de Dios">Madre de Dios</option>
  <option value="Moquegua">Moquegua</option>
  <option value="Pasco">Pasco</option>
  <option value="Piura">Piura</option>
  <option value="Puno">Puno</option>
  <option value="San Martín">San Martín</option>
  <option value="Tacna">Tacna</option>
  <option value="Tumbes">Tumbes</option>
  <option value="Ucayali">Ucayali</option>
</select>
<button class="btn btn-primary ml-4">Buscar</button>
    </div>

<section class="container zona-eventos mb-5" >
  

<?php
foreach($eventos as $evento){
  if($evento['Estado_Publicacion'] !== "Cancelado"){
echo "<div class='card' style='width: 18rem;'>
  <img class='card-img-top' src='./images/tercer_fondo.webp' alt='Card image cap'>
  <div class='card-body'>
    <h5 class='card-title' style='color:black'>". htmlspecialchars($evento['Titulo'])."</h5>
    <p class='card-text' style='font-weight: 500'>".$evento['Descripcion']. "</p>
    <a href='./cliente-evento.php?id=".$evento['ID_Evento']."' class='btn btn-primary'>Ver Evento</a>
  </div>
</div>
";
  }}
?>

</section>

    <script src="../vista/clientes/js/script.js"></script> <!-- Enlace al archivo JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
