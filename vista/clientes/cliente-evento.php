<?php
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Nombre del evento - Provinty</title>

        <style>
          .header {
              background-color: #004f63;
              color: white;
              padding: 10px 20px;
              display: flex;
              justify-content: space-between;
              align-items: center;
              box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
          }

          .header img {
              width: 100px;
          }

          .user-info {
              display: flex;
              align-items: center;
              background-color: #58bcbb;
              padding: 8px 12px;
              border-radius: 25px;
              color: white;
              font-weight: bold;
              font-size: 14px;
              box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
          }

          .user-info i {
              font-size: 20px;
              margin-right: 8px;
              color: #fff;
          }

          .user-info .username {
              margin-right: 15px;
          }

          .user-info a {
              color: #004f63;
              background-color: white;
              padding: 5px 10px;
              border-radius: 5px;
              text-decoration: none;
              font-weight: bold;
              transition: all 0.3s ease;
          }

          .user-info a:hover {
              background-color: #004f63;
              color: white;
          }

          .login a {
              color: white;
              text-decoration: none;
              margin-left: 15px;
              font-weight: bold;
          }

          .login a:hover {
              text-decoration: underline;
          }
          .event-card {
            margin-top: 10px; ;
          position: relative;
          width: 100%;
          height: 400px;
          
          border-radius: 16px;
          overflow: hidden;
          transition: transform 0.3s ease;
        }

        .event-card:hover {
          transform: translateY(-5px);
        }

.event-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.event-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    135deg,
    rgba(13, 84, 105, 0.95) 0%,
    rgba(13, 84, 105, 0.8) 40%,
    rgba(13, 84, 105, 0.4) 100%
  );
  padding: 2.5rem;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}

.event-content {
  max-width: 80%;
}

.event-title {
  color: white;
  font-size: 2.8rem;
  font-weight: 800;
  margin: 0 0 0.5rem 0;
  letter-spacing: -0.5px;
  line-height: 1.2;
  font-family: system-ui, -apple-system, sans-serif;
}

.event-artist {
  color: rgba(255, 255, 255, 0.9);
  font-size: 1.25rem;
  margin: 0 0 2rem 0;
  font-weight: 500;
  letter-spacing: 0.5px;
  font-family: system-ui, -apple-system, sans-serif;
}

.date-container {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.date-box {
  background-color: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(8px);
  color: white;
  padding: 0.75rem 1.5rem;
  border-radius: 12px;
  font-weight: 700;
  font-size: 1.25rem;
  font-family: system-ui, -apple-system, sans-serif;
  border: 1px solid rgba(255, 255, 255, 0.2);
  text-align: center;
  min-width: 3.5rem;
}

.event-badge {
  position: absolute;
  top: 1.5rem;
  right: 1.5rem;
  background-color: rgba(255, 255, 255, 0.95);
  color: #0d5469;
  padding: 0.5rem 1rem;
  border-radius: 2rem;
  font-weight: 600;
  font-size: 0.875rem;
  letter-spacing: 0.5px;
  text-transform: uppercase;
}




/* Contenedor principal para secciones */
.event-section {
  padding: 3rem 0;
  background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
}

/* Encabezados de sección */
.section-header {
  position: relative;
  margin-bottom: 2.5rem;
  padding-bottom: 1rem;
  color: #004f63;
}

.section-header::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 60px;
  height: 4px;
  background: #58bcbb;
  border-radius: 2px;
}

/* Descripción */
.description-container {
  background: white;
  border-radius: 16px;
  padding: 2rem;
  box-shadow: 0 4px 20px rgba(0, 79, 99, 0.08);
  margin-bottom: 3rem;
}

.description-text {
  font-size: 1.1rem;
  line-height: 1.8;
  color: #2c3e50;
}

/* Tabla de precios */
.pricing-section {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 2rem;
  margin-bottom: 3rem;
}

.price-table {
  background: white;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0, 79, 99, 0.08);
}

.price-table thead {
  background: #004f63;
  color: white;
}

.price-table th {
  padding: 1.2rem;
  font-weight: 600;
}

.price-table td {
  padding: 1rem 1.2rem;
  border-bottom: 1px solid #e9ecef;
}

.price-table tbody tr:hover {
  background: #f8f9fa;
}

.price-badge {
  display: inline-flex;
  align-items: center;
  background: #e3f2fd;
  color: #004f63;
  padding: 0.5rem 1rem;
  border-radius: 20px;
  font-weight: 600;
  margin-bottom: 0;
}

/* Términos y condiciones */
.terms-container {
  background: white;
  border-radius: 16px;
  padding: 2rem;
  box-shadow: 0 4px 20px rgba(0, 79, 99, 0.08);
}

.terms-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.terms-list li {
  position: relative;
  padding: 1rem 0 1rem 2rem;
  border-bottom: 1px solid #e9ecef;
  color: #2c3e50;
}

.terms-list li::before {
  content: '✓';
  position: absolute;
  left: 0;
  color: #58bcbb;
  font-weight: bold;
}

/* Sección de opiniones */
.review-section {
  background: white;
  border-radius: 16px;
  padding: 2rem;
  box-shadow: 0 4px 20px rgba(0, 79, 99, 0.08);
}

.review-textarea {
  border: 2px solid #e9ecef;
  border-radius: 12px;
  padding: 1rem;
  resize: none;
  transition: border-color 0.3s ease;
}

.review-textarea:focus {
  border-color: #58bcbb;
  outline: none;
}

.review-button {
  background: #004f63;
  color: white;
  border: none;
  border-radius: 25px;
  padding: 0.8rem 2rem;
  font-weight: 600;
  transition: transform 0.2s ease;
}

.review-button:hover {
  transform: translateY(-2px);
  background: #003845;
}

/* Sistema de estrellas mejorado */
.rating-container {
  text-align: center;
  margin-top: 2rem;
}

.star-rating {
  direction: rtl;
  display: inline-block;
  padding: 20px;
}

.star-rating input {
  display: none;
}

.star-rating label {
  color: #ddd;
  font-size: 40px;
  padding: 0 2px;
  transition: all 0.2s ease;
}

.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input:checked ~ label {
  color: #ffd700;
  transform: scale(1.1);
}

/* Guía de compra */
.purchase-guide {
  background: white;
  border-radius: 16px;
  padding: 2rem;
  height: 100%;
}

.guide-step {
  display: flex;
  align-items: flex-start;
  margin-bottom: 1.5rem;
  padding: 1rem;
  background: #f8f9fa;
  border-radius: 12px;
}

.step-number {
  background: #58bcbb;
  color: white;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  margin-right: 1rem;
  flex-shrink: 0;
}

.step-content {
  font-size: 0.95rem;
  color: #2c3e50;
}
      </style>

  </head>
  <body>


  <div class="header">
    <img src="../vista/clientes/img/logo_provint.png" alt="Provinti Logo">
    <?php if (isset($_SESSION['roles'])): ?>
        <div class="user-info">
            <i class="fas fa-user-circle"></i>
            <span class="username">Hola, <?php echo htmlspecialchars($_SESSION['nombre'], ENT_QUOTES, 'UTF-8'); ?></span>
            <a href="../controlador/cliente/logout.php">Cerrar Sesión</a>
        </div>
    <?php else: ?>
        <div class="login">
            <a href="./registro-cliente.php">Registrarse</a>
            <a href="./login-clientes.php">Login</a>
        </div>
    <?php endif; ?>
</div>
<div class="event-card">
  <img src="../uploads/<?php echo $id;?>.png" alt="Teatro event" class="event-image">
  <div class="event-overlay">
    <div class="event-content">
    <?php
      foreach($eventos as $evento){
        if($evento['ID_Evento']==$id){
            echo "<p class='descripcion h1'><strong style='color:white; font-size:50px'>".$evento['Titulo']."</strong></p>";
        }
        }
      ?>
      
      <p class="event-artist">Artista: Grupo Z</p>
      <div class="date-container">
        <div class="date-box">15</div>
        <div class="date-box">10</div>
        <div class="date-box">2024</div>
      </div>
    </div>
  </div>
  <div class="event-badge">    Detalles   </div>
</div>
  
      <!-- Descripción -->

      
<section class="event-section">
  <div class="container">
    <h2 class="section-header">Descripción</h2>
    <div class="description-container">
      <p class="description-text">
      <?php
      foreach($eventos as $evento){
        if($evento['ID_Evento']==$id){
          
            echo "<p class='descripcion'>".$evento['Descripcion']."</p>";
        }
        }
      ?>
      </p>
    </div>
 
      

  <section class="container p-3">
    <div class="mt-3 d-flex">
    <h2 class="section-header">Tabla Precios</h2>
    </div>
</section>
 <!-- Precios y Guía de Compra -->
 <div class="pricing-section">
      <div class="price-table">
        <table class="table mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>SECTOR</th>
              <th>PRECIO PREVENTA</th>
              <th>PRECIO VENTA</th>
            </tr>
          </thead>
          <tbody>
          <?php
$contador = 1;
    foreach($categoriasEvento as $categoria){
      if($categoria['ID_Evento']==$id){
        echo '<tr>
      <th scope="row">'.$contador.'</th>
      <td>'.$categoria['nombre_categoria_evento'].'</td>
      <td>'.$categoria['precio_preventa'].'</td>
      <td>S/. '.$categoria['precio_venta'].'</td>
    </tr>';
    $contador++;
      } 
    }
    ?>
          </tbody>
        </table>
      </div>

      <div class="purchase-guide">
    <h3 class="h5 mb-4">Términos y Condiciones</h3>
    <?php
    // Mostrar los términos y condiciones dinámicamente
    foreach ($eventos as $evento) {
        if ($evento['ID_Evento'] == $id) {
            // Conseguimos los términos
            $terminos_condiciones_json_string = $evento['terminos_condiciones'];
            $array_terminos = json_decode($terminos_condiciones_json_string, true); // Decodificar el JSON a un array de PHP

            // Generar cada paso con los términos
            $step_number = 1;
            foreach ($array_terminos as $termino) {
                echo '<div class="guide-step">';
                echo '  <div class="step-number">' . $step_number . '</div>';
                echo '  <div class="step-content">' . htmlspecialchars($termino, ENT_QUOTES, 'UTF-8') . '</div>';
                echo '</div>';
                $step_number++;
            }
        }
    }
    ?>
</div>

  </div>

<?php
if(isset($_SESSION['roles']) && $_SESSION['roles'] == "cliente"){
  echo '
   <h2 class="section-header">¿Qué te pareció?</h2>
<div class="review-section">
  <form method="post" action="../controlador/cliente/controlador_valorar_comentario.php">
    <textarea maxlength="690" class="form-control review-textarea" rows="4" name="comentario" placeholder="Comparte tu experiencia con nosotros..."></textarea>
    <div class="d-flex justify-content-between align-items-center mt-3">
      <input type="hidden" value="'.$id.'" name="id_evento">
      <button class="review-button" type="submit">Enviar reseña</button>
    </div>
  </form>
</div>

  </section>
  
  <section class="container my-5">
    <div class="d-flex"><div class="mx-auto"><p class="h4">Califícanos ;)</p></div></div>
    <form id="form">
      <p class="clasificacion">
        <input class="star-calify" id="radio1" type="radio" name="estrellas" value="5" onclick="valorarEstrellas(\'radio1\')">
        <label for="radio1">★</label>
        <input class="star-calify" id="radio2" type="radio" name="estrellas" value="4" onclick="valorarEstrellas(\'radio2\')">
        <label for="radio2">★</label>
        <input class="star-calify" id="radio3" type="radio" name="estrellas" value="3" onclick="valorarEstrellas(\'radio3\')">
        <label for="radio3">★</label>
        <input class="star-calify" id="radio4" type="radio" name="estrellas" value="2" onclick="valorarEstrellas(\'radio4\')">
        <label for="radio4">★</label>
        <input class="star-calify" id="radio5" type="radio" name="estrellas" value="1" onclick="valorarEstrellas(\'radio5\')">
        <label for="radio5">★</label>
      </p>
    </form>
  </section>';
}
?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
  <style>
    .navbar{
        background: #58bcbb;
    }

    .iniciarSesion{
        transition: height ease 1s ;
    }

    .iniciarSesion:hover{
        height: 26px;
    }

    #form {
  width: 250px;
  margin: 0 auto;
  height: 80px;
}

#form p {
  text-align: center;
}

#form label {
  cursor: pointer;  
  font-size: 50px;
}

input[type="radio"] {
  display: none;
}

label {
  color: grey;
}

.clasificacion {
  direction: rtl;
  unicode-bidi: bidi-override;
}

label:hover,
label:hover ~ label {
  color: orange;
}

input[type="radio"]:checked ~ label {
  color: orange;
}
  </style>

<script>
  //Hacemos la función que reciba los ids si es que son pulsados
  
  async function valorarEstrellas(id) {

    let numId;

switch (id) {
    case "radio1":
        numId = 5;
        break;
    case "radio2":
        numId = 4;
        break;
    case "radio3":
        numId = 3;
        break;
    case "radio4":
        numId = 2;
        break;
    case "radio5":
        numId = 1;
        break;
}

console.log("El valor de numId es:", numId);


    // Muestra el ID seleccionado
    console.log("El ID elegido es: ", id);

    let data = {
    estrellas: numId,
    id_cliente: "<?php echo json_encode($_SESSION['idCliente']); ?>", // Aseguramos que sea JSON válido
    id_evento: <?php echo json_encode($id); ?> // También aseguramos que sea JSON válido
};

    // Lógica para enviar el ID a la API
    const url = "../controlador/cliente/controlador_valorar_estrellas.php"; // URL de ejemplo

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Éxito:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

 
//Vamos a contar el tiempo transcurrido

(function () {

  let intervalo = setInterval(enviarTiempo, 3000);
  
})();

const ruta = "../controlador/cliente/controlador_tiempo_transcurrido.php";
let datos = {
  info_tiempo: "Han pasado segundos",
  id_cliente: "<?php echo json_encode($_SESSION['idCliente']); ?>",
  id_evento:<?php echo json_encode($id); ?>
}

function enviarTiempo(){
  fetch(ruta, {
    method:'post',
    header:{
      'Content-Type': 'application/json',
    },
    body:JSON.stringify(datos),
  }).then(response => response.json())
    .then(data => {
        console.log('Éxito:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}


</script>


</html>