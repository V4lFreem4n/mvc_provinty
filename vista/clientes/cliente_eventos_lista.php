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
            <button class="search-icon">
                <i class="fas fa-search"></i> 
            </button>
            <a href="./registro-cliente.php" class="custom-link">Registrarse</a>
            <a href="#" class="login-button">Login</a>
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

<section class="container zona-eventos" style="background-color: #293a81;">
  

<?php
foreach($eventos as $evento){
  if($evento['Estado_Publicacion'] !== "Cancelado"){
echo "<div class='card' style='width: 18rem;'>
  <img class='card-img-top' src='...' alt='Card image cap'>
  <div class='card-body'>
    <h5 class='card-title' style='color:black'>". htmlspecialchars($evento['Titulo'])."</h5>
    <p class='card-text'>". htmlspecialchars($evento['Descripcion']) . "</p>
    <a href='#' class='btn btn-primary'>Ver Evento</a>
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
