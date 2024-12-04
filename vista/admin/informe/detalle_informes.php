<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle - Informe de Eventos</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/js/all.min.js"></script>
</head>
<body class="font-sans bg-gray-100 text-gray-800">
  <header class="bg-[#004f63] text-white py-5 px-8 flex items-center justify-between mb-5">
    <div class="flex items-center">
      <img src="../vista/admin/informe/img/logo_provint.png" alt="Logo" class="h-12 mr-4">
      <h1 class="text-2xl font-bold">DETALLE - INFORME DE EVENTOS</h1>
    </div>
    <button class="bg-white text-[#004f63] px-4 py-2 rounded-md flex items-center">
      <i class="fas fa-download mr-2"></i> DESCARGAR TODO
    </button>
  </header>

  <section>
    <div class="container mx-auto my-2 flex">
    <div><strong>NOMBRE DEL EVENTO:</strong> <?php echo $nombreEvento;?></div>
    <div class="ms-auto me-5"><strong>TIEMPO PROMEDIO :</strong> <?php echo $promedios['tiempo_promedio'];?> en segundos</div>
    <div class="ms-auto"><strong>ESTRELLAS PROMEDIO:</strong> <?php echo $promedios['estrellas_promedio'];?></div>
    </div>
   <div class="flex border border-slate-300 p-2">
   <div style="width: 25%;">
  <canvas id="donaGrafico"></canvas>
</div>
    <div style="width: 65%;">
  <canvas id="myChart"></canvas>
</div>
   </div> 
  </section>

  <?php
  foreach($interacciones as $interaccion){
    if($interaccion['id_evento']==$id){
      echo '<main class="px-8">
    <div class="bg-white shadow-md rounded-lg p-6 mb-8 grid grid-cols-3 gap-1">
      <div>
        <h2 class="text-[#004f63] font-bold text-xl mb-2">'.$interaccion['nombre_cliente'].'</h2>
        <h4 class="text-slate-400 font-bold text-xl mb-2">ID: '.$interaccion['id_cliente'].'</h4>
      </div>
      <div>
        <p class="mb-4">'.$interaccion['comentario'].'</p>
      </div>
      <div class="flex flex-col items-end">
        <button class="bg-[#004f63] text-white px-4 py-2 rounded-md flex items-center mb-2">
          <i class="fas fa-download mr-2"></i> DESCARGAR
        </button>
        <div class="flex items-center text-xl text-orange-500">';
          //Vamos a verificar si es que existe comentario
        if(isset($interaccion['estrellas'])){
          for($i = 1; $i <= $interaccion['estrellas']; $i++){
            echo '<i class="fas fa-star mr-1"></i>';
          }
        }
          
        echo '</div>
      </div>
    </div>

    <!-- Más secciones de eventos -->
  </main>';
    }
  }
  ?>

<!--
<footer class="bg-[#004f63] text-white py-4 text-center">
    <div class="flex justify-center">
      <a href="#" class="text-white px-2 hover:bg-[#006a80] rounded-md">1</a>
      <a href="#" class="text-white px-2 hover:bg-[#006a80] rounded-md">2</a>
    </div>
  </footer>  
-->
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const data = {
  datasets: [{
    label: 'Tiempo en segundos por cada usuario',
    data: [

    <?php
    foreach($interacciones as $interaccion){
      if($interaccion['id_evento']==$id){
      echo "{x: ".$interaccion['id_cliente'].",y: ".$interaccion['tiempo']."},";
      }
    }
    ?>

    ],
    backgroundColor: 'rgb(0, 0, 255)'
  }],
};

const config = {
  type: 'scatter',
  data: data,
  options: {
    scales: {
      x: {
        type: 'linear',
        position: 'bottom',
        title: {
          display: true,
          text: 'ID cliente'
        }
      },
      y: {
        display: true,
        title: {
          display: true,
          text: 'Segundos'
        }
    }
  }
}};





const datos = {
  labels: [
    '1 estrella',
    '2 estrellas',
    '3 estrellas',
    '4 estrellas',
    '5 estrellas'
  ],
  datasets: [{
    label: 'Valoraciónes',
    data: [

    <?php
    foreach($arrayEstrellas as $estrella){
      echo $estrella.",";
    }
    ?>

    ],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(154, 62, 235)',
      'rgb(205, 105, 186)'
    ],
    hoverOffset: 4
  }]
};

const configuracion = {
  type: 'doughnut',
  data: datos,
};


let graphDispersion = document.getElementById("myChart").getContext("2d");
    let dispersion = new Chart(graphDispersion, config);

    let graphDona = document.getElementById("donaGrafico").getContext("2d");
    let dona = new Chart(graphDona, configuracion);

</script>
</html>

