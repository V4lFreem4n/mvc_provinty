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
  </head>
  <body>

    <nav class="navbar navbar-expand-lg d-flex" style="position:fixed;width:100%">
    <div class="mr-auto">
        <img src="../vista/clientes/img/logo_provint.png" width="100px">   
    </div>

    <?php

if(isset($_SESSION['roles']) && $_SESSION['roles'] == "cliente"){

  echo '<div><p>Hola! '.$_SESSION['nombre'].'</p></div>
  <div class="login">
    <a href="../controlador/cliente/logout.php" class="login-button">Cerrar Sesión</a>
</div>';
}else{
  echo '<div class="d-flex" style="cursor: pointer;">
            <p class="my-auto font-bold iniciarSesion"><strong><a href="./login-clientes.php">Iniciar Sesión</a></strong></p>
        </div>';
}
?>

        
    </nav>

  <section class="fondo-evento bg-success" style="height: 500px;">
   
  </section>

  <section class="container d-flex">
    <button class="bg-primary p-3 mt-2 mx-auto border-none" style="cursor :pointer; border:none; border-radius:5px;">
        <strong style="color:bisque">Ver entradas</strong>
    </button>
  </section>

  <section class="container mt-5">
  <p class="h4">Descripcion</p>
  
<?php
foreach($eventos as $evento){
  if($evento['ID_Evento']==$id){
    
      echo "<p class='descripcion'>".$evento['Descripcion']."</p>";
  }
  }
?>
  </section>

  <section class="container p-3">
    <div class="mt-3 d-flex">
        <p>TABLA DE PRECIOS</p>
        <p class="ml-5">¿CÓMO COMPRAR LAS ENTRADAS?</p>
    </div>
</section>

<section class="container">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">SECTOR</th>
      <th scope="col">CANTIDAD</th>
      <th scope="col">PRECIO</th>
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
      <td>36</td>
      <td>S/. '.$categoria['precio_venta'].'</td>
    </tr>';
    $contador++;
      } 
    }

    

    
    ?>
  </tbody>
</table>
</section>

<section class="container mt-5">
<p class="h4">Términos y condiciones</p>
<ul>
<?php

//Acá vamos a mostrar los términos y condiciones
foreach($eventos as $evento){
if($evento['ID_Evento']==$id){
  //conseguimos los términos
  $terminos_condiciones_json_string = $evento['terminos_condiciones'];
  $array_terminos = json_decode($terminos_condiciones_json_string, true); // Decodificar el JSON a un array de PHP
  foreach($array_terminos as $termino){
    echo "<li>".$termino."</li>";
  }
}
}
?>
</ul>
</section>

<?php
if(isset($_SESSION['roles']) && $_SESSION['roles'] == "cliente"){
  echo '
  <section class="container my-5">
    <p class="h4">¿Qué te pareció?</p>
    <textarea class="form-control my-3" placeholder="Envíanos tus reseñas"></textarea>
    <button class="btn btn-primary" type="button">Enviar</button>
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
    id_cliente: <?php echo json_encode($_SESSION['idCliente']); ?>, // Aseguramos que sea JSON válido
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

 


  /** FUNCIÓN AUTOEJECUTABLE
   * (async () => {
  const apiUrl = "https://jsonplaceholder.typicode.com/posts";
  const postData = {
    title: "Mi nuevo post",
    body: "Este es el contenido del post.",
    userId: 1,
  };

  const options = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(postData),
  };

  const response = await fetchData(apiUrl, options);
  console.log("Respuesta del POST:", response);
})();

   */

</script>


</html>