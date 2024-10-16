
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script async src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
</head>
<body>
<section class="bg-slate-300 w-screen h-screen px-0 py-10" id="allScreen">
<div class="container mx-auto">


<div class="flex shadow">
  <div class="bg-teal-500 w-full p-1 flex rounded-lg">
  <form><p onclick="restringirMultiplesEventes(event)" class="shadow p-2 w-36 bg-teal-300 hover:bg-teal-400 hover:cursor-pointer rounded-lg mr-auto font-bold flex justify-center items-center" id="crear_evento">
      <svg class="h-8 w-8 text-slate-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M4 13a8 8 0 0 1 7 7a6 6 0 0 0 3 -5a9 9 0 0 0 6 -8a3 3 0 0 0 -3 -3a9 9 0 0 0 -8 6a6 6 0 0 0 -5 3" />  <path d="M7 14a6 6 0 0 0 -3 6a6 6 0 0 0 6 -3" />  <circle cx="15" cy="9" r="1"  /></svg>
      <button type="button" class="text-slate-800">Crear evento</button></p></form>


      <button onclick="mostrarHistorial()" class="ml-5 shadow p-2 w-36 bg-teal-300 hover:bg-teal-400 hover:cursor-pointer rounded-lg mr-auto font-bold flex justify-center items-center">
      <svg class="h-8 w-8 text-slate-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <polyline points="12 8 12 12 14 14" />  <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" /></svg>  
      <p class="text-slate-800">Historial</p></button>
      <p class="ml-auto mr-5 mt-3 text-xl font-serif text-gray-300">PROVINTY</p>
  </div>
  
</div>  

<div class="bg-slate-200 p-2 mt-1" id="tabla-historial" style="display: none;">
  <p class="flex justify-center font-bold text-slate-600 mb-2">Eventos eliminados</p>

  <div class="grid grid-cols-6 border-b border-gray-300">
  <div class="font-bold text-slate-600">Nombre del evento</div>
  <div class="font-bold text-slate-600">Identificador</div>
  <div class="font-bold text-slate-600">Promotor</div>
  <div class="font-bold text-slate-600">Fecha de eliminación</div>
  <div class="font-bold text-slate-600">Hora de eliminación</div>
  <div class="font-bold text-slate-600 ">Descargar informes</div>
</div>

<div class="grid grid-cols-6 border-b border-gray-300 p-1">
  <div>
  <div class="flex">
  <svg class="h-6 w-6 text-slate-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="12.41 6.75 13 2 10.57 4.92" />  <polyline points="18.57 12.91 21 10 15.66 10" />  <polyline points="8 8 3 14 12 14 11 22 16 16" />  <line x1="1" y1="1" x2="23" y2="23" /></svg>
  <p class="flex font-bold text-slate-500">Día de la canción criolla</p>  
</div>
  </div>
  <div>25</div>
  <div>Agua Marina</div>
  <div>16/10/2024</div>
  <div>16:45</div>
  <div><a href="#" class="hover:text-blue-400 font-bold">Pulsar aquí</a></div>
</div>




  
</div>


<ul id="eventos">

<?php

foreach($eventos as $evento){
if($evento['Estado_Publicacion'] !== "Cancelado"){
  echo '<li id="'.$evento['ID_Evento'].'"><div class="bg-white py-2 flex px-2 my-2" atributo-evento-id="'.$evento['ID_Evento'].'" atributo-evento-tipo="evento">
<svg class="h-8 w-8 text-black-400 mt-2"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
  </svg>
<input placeholder="'.$evento['Titulo'].'" style="width: 300px;" class="ml-2 p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" disabled id="nombre-evento-titulo-'.$evento['ID_Evento'].'">
<div class="ml-auto flex py-2">

<!--DANGER-->
    <div class="relative tooltip-container" style="display:none" id="dangerEventoDesplegado_'.$evento['ID_Evento'].'">
        <svg class="h-8 w-8 text-yellow-400 mr-2" id="tooltip" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
            <path stroke="none" d="M0 0h24v24H0z"/>
            <path d="M12 9v2m0 4v.01" />
            <path d="M5.07 19H19a2 2 0 0 0 1.75 -2.75L13.75 4a2 2 0 0 0 -3.5 0L3.25 16.25a2 2 0 0 0 1.75 2.75" />
        </svg>
        <div class="tooltip flex">¡Necesita <p class="font-bold mx-1">EDITAR</p> todos los datos para este evento!</div>
    </div>
    <!---->

<!--CHECK SWITCH-->
<div class="toggle mr-4">
  <input type="checkbox" id="btn'.$evento['ID_Evento'].'">
  <label for="btn'.$evento['ID_Evento'].'">
    <span class="on">Público</span>
    <span class="off">Privado</span>
    <div class="slider"></div> <!-- El círculo que se desliza -->
  </label>
</div>

    <!--ID-->
    <div class="mt-1 flex mr-4"><p class="font-bold mr-1">ID</p><p>'.$evento['ID_Evento'].'</p></div>
    <!---->
    <!--MODIFICAR-->
    <p onclick="visiblePanelModificar('.$evento['ID_Evento'].')" class="bg-green-200 px-2 py-1 ml-2 mr-2 hover:bg-green-300 hover:cursor-pointer rounded-lg hover:rounded-lg disabled:pointer-events-none transition-all" id="collapse-'.$evento['ID_Evento'].'">Editar</p>
    <!---->
    <!--ESTADISTICAS-->
    <a class="bg-blue-200 px-2 py-1 hover:bg-blue-300 hover:cursor-pointer rounded-lg hover:rounded-lg" href="./admin-estadisticas-evento.php?id='.$evento['ID_Evento'].'" target="_blank">Estadísticas</a>
    <!---->
    <!--ELIMINAR-->
    <form action="../controlador/Evento/controladorEliminarEvento.php" method="post" id="eliminar-'.$evento['ID_Evento'].'"><button class="bg-red-100 mr-2 ml-2 rounded-lg" onclick="eliminarEvento(event)" type="submit">
    <input name="id_evento" value="'.$evento['ID_Evento'].'" type="hidden">    
    <svg class="h-8 w-8 text-red-900 hover:bg-red-300 hover:rounded-lg hover:cursor-pointer"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
            <path stroke="none" d="M0 0h24v24H0z"/>  
            <line x1="4" y1="7" x2="20" y2="7" />
            <line x1="10" y1="11" x2="10" y2="17" />  
            <line x1="14" y1="11" x2="14" y2="17" />  
            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  
            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
        </svg>
    </button></form>
    <!---->
</div>
</div>
'.'<!--Panel de descripción-->
<form><div id="collapse-panel-'.$evento['ID_Evento'].'" style="display:none">
  <div class="bg-green-200 p-1"></div>
<div class="bg-slate-200 p-5 grid grid-cols-3">
  <div>
    <div class="ml-2">
      <input id="input-evento-nombre-'.$evento['ID_Evento'].'" value="'.$evento['Titulo'].'" placeholder="Nombre del evento" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none " required >
      <p class="text-xs ml-1">Nombre del evento*</p>
    </div>

    <div class="ml-2 my-1">
      <input id="input-evento-fecha-'.$evento['ID_Evento'].'" value="'.date('Y-m-d', strtotime($evento['Fecha_Creacion'])).'" type="date" placeholder="Fecha del evento" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      <p class="text-xs ml-1">Fecha del evento*</p>
    </div>

    <div class="ml-2 my-1">
      <input id="input-evento-ubicacion-'.$evento['ID_Evento'].'" value="Ubicación" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none " placeholder="Ubicación del evento">
      <p class="text-xs ml-1">Ubicación del evento*</p>
    </div>

    <div class="ml-2 my-1">
      <a id="input-evento-categoria-'.$evento['ID_Evento'].'" style="width: 300px;" class="hover:text-green-400" href="#" onclick="visibleModalCategoriaEntradas('.$evento['ID_Evento'].')">Categorías de entrada</a>
      <p class="text-xs ml-1">Categorías de la entrada*</p>
    </div>

    <div class="ml-2 my-1">
      <div class="flex">
      <input onclick="validarHora('.$evento['ID_Evento'].')"  type="time" id="input-evento-hora-inicio-'.$evento['ID_Evento'].'" placeholder="Hora del evento" style="width: 100px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      <input disabled type="time" id="input-evento-hora-fin-'.$evento['ID_Evento'].'" placeholder="Hora del evento" style="width: 100px;" class="ml-3 p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      
      </div>
      <p class="text-xs ml-1">Hora de inicio y fin del evento*</p>
    </div>

    <div class="ml-2 my-1">
      <input type="number" id="input-evento-capacidad-'.$evento['ID_Evento'].'" value="'.$evento['Aforo'].'" placeholder="Capacidad del evento" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      <p class="text-xs ml-1">Capacidad del evento*</p>
    </div>

  </div>

  <div>
<div class="ml-2 my-1">
      <input id="input-evento-organizador-'.$evento['ID_Evento'].'" value="'.$evento['Artista_Autor'].'" placeholder="Organizador evento" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      <p class="text-xs ml-1">Organizador del evento*</p>
    </div>

    <div class="ml-2 my-1">
      <input id="input-evento-contacto-organizador-'.$evento['ID_Evento'].'" value="contacto" placeholder="Contacto del organizador del evento" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      <p class="text-xs ml-1">Contacto del organizador del evento*</p>
    </div>

 <div class="ml-2 my-1">
      <input id="input-evento-redes-'.$evento['ID_Evento'].'" value="redes" placeholder="Redes sociales del evento" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      <p class="text-xs ml-1">Redes sociales del evento*</p>
    </div>

<div class="ml-2 my-1">
      <input type="file" id="input-evento-cancelacion-'.$evento['ID_Evento'].'" required >
      <p class="text-xs ml-1 text-red-900">Política de cancelación del evento*</p>
    </div>

    <div>
    <textarea id="input-evento-descripcion-'.$evento['ID_Evento'].'" placeholder="Describe el evento..." class="w-full focus:outline-none p-2" required >'.$evento['Descripcion'].'</textarea>
    <p class="text-xs ml-1">Descripción del evento*</p>
    </div>
  </div>


  <div>
    <div class="bg-white px-5 ml-5 mb-1 flex" style="width: 150px; height: 150px;">
      <img src="images/imagen.png" class="my-auto mx-auto" id="imagen_evento_'.$evento['ID_Evento'].'">
 
    </div>
    <p class="text-xs ml-5 my-1">Imagen del evento*</p>
    <input id="input-evento-imagen-'.$evento['ID_Evento'].'" type="file" class="ml-5" onchange="subirImagen(this,`imagen_evento_'.$evento['ID_Evento'].'`)" accept=".jpg, .jpeg, .png">
    <div class="flex">
      <button class="p-2 bg-green-300 hover:bg-green-400 rounded mt-2 ml-auto rounded" type="button" onclick="guardarEvento('.$evento['ID_Evento'].')">GUARDAR</button>
    </div>
  </div>

</div>
</div></form>'
.'</li>';
}
}

?>
</ul>


<!---MODAL--->
<section id="categoria_entrada" class="fixed top-0 bottom-0 left-0 right-0 bg-black bg-opacity-60 z-50 flex" style="display: none;">

<section class="rounded  my-auto mx-auto bg-white p-5">
<div class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

<div class="text-lg mb-2">Establecer Precios de Categorías de entrada</div>

  <!-- Cabecera -->
  <div class="grid grid-cols-3 gap-4 font-semibold">
    <div>Categoría de entrada</div>
    <div>Venta</div>
    <div>Pre venta</div>
  </div>
  
  <!-- Fila 1 -->
  <div class="grid grid-cols-3 gap-4 bg-slate-100">
    <div class="flex">
      <input type="checkbox" class="mr-2" id="cat1" onclick="verificarCheck(1)">
      <p id="nombre_categoria_evento_1">SUPER VIP</p>
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-venta-1" style="display: none;">
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-preventa-1" style="display: none;">
    </div>
  </div>

  <!-- Fila 2 -->
  <div class="grid grid-cols-3 gap-4">
    <div class="flex">
      <input type="checkbox" class="mr-2" id="cat2" onclick="verificarCheck(2)">
      <p id="nombre_categoria_evento_2">VIP</p>
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-venta-2" style="display: none;">
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-preventa-2" style="display: none;">
    </div>
  </div>

  <!-- Fila 3 -->
  <div class="grid grid-cols-3 gap-4 bg-slate-100">
    <div class="flex">
      <input type="checkbox" class="mr-2" id="cat3" onclick="verificarCheck(3)">
      <p id="nombre_categoria_evento_3">PALCO VIP</p>
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-venta-3" style="display: none;">
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-preventa-3" style="display: none;">
    </div>
  </div>

  <!-- Fila 4 -->
  <div class="grid grid-cols-3 gap-4">
    <div class="flex">
      <input type="checkbox" class="mr-2" id="cat4" onclick="verificarCheck(4)">
      <p id="nombre_categoria_evento_4">GENERAL</p>
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-venta-4" style="display: none;">
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-preventa-4" style="display: none;">
    </div>
  </div>

  <!-- Fila 5 -->
  <div class="grid grid-cols-3 gap-4 bg-slate-100">
    <div class="flex">
      <input type="checkbox" class="mr-2" id="cat5" onclick="verificarCheck(5)">
      <p id="nombre_categoria_evento_5">PALCO GENERAL</p>
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-venta-5" style="display: none;">
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-preventa-5" style="display: none;">
    </div>
  </div>
  <!-- Fila 6 -->
  <div class="grid grid-cols-3 gap-4">
    <div class="flex">
      <input type="checkbox" class="mr-2" id="cat6" onclick="verificarCheck(6)">
      <p id="nombre_categoria_evento_6">NIÑOS SUPERVIP</p>
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-venta-6" style="display: none;">
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-preventa-6" style="display: none;">
    </div>
  </div>

  <!-- Fila 7 -->
  <div class="grid grid-cols-3 gap-4 bg-slate-100">
    <div class="flex">
      <input type="checkbox" class="mr-2" id="cat7" onclick="verificarCheck(7)">
      <p id="nombre_categoria_evento_7">NIÑOS VIP</p>
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-venta-7" style="display: none;">
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-preventa-7" style="display: none;">
    </div>
  </div>

  <!-- Fila 8 -->
  <div class="grid grid-cols-3 gap-4">
    <div class="flex">
      <input type="checkbox" class="mr-2" id="cat8" onclick="verificarCheck(8)">
      <p id="nombre_categoria_evento_8">NIÑOS PALCO VIP</p>
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-venta-8" style="display: none;">
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-preventa-8" style="display: none;">
    </div>
  </div>

  <!-- Fila 9 -->
  <div class="grid grid-cols-3 gap-4 bg-slate-100">
    <div class="flex">
      <input type="checkbox" class="mr-2" id="cat9" onclick="verificarCheck(9)">
      <p id="nombre_categoria_evento_9">NIÑOS GENERAL</p>
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-venta-9" style="display: none;">
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-preventa-9" style="display: none;">
    </div>
  </div>

  <!-- Fila 10 -->
  <div class="grid grid-cols-3 gap-4">
    <div class="flex">
      <input type="checkbox" class="mr-2" id="cat10" onclick="verificarCheck(10)">
      <p id="nombre_categoria_evento_10">NIÑOS PALCO GENERAL</p>
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-venta-10" style="display: none;">
    </div>
    <div>
      <input class="border-2 border-slate-300" type="number" id="cat-preventa-10" style="display: none;">
    </div>
  </div>
</div>

 <div class="flex">
  <div class="bg-slate-300 ml-auto cursor-pointer hover:bg-slate-400 p-2 rounded" onclick="guardarDatosPreciosCategoria()">GUARDAR</div>
 </div>
</div>


</section>

</section>




<!----------->

</div>

</section> 





</body>

  


</script>
<script src="../vista/admin/crearEventos/funcionalidades.js"></script>

<!-- from node_modules -->
<script src="node_modules/@material-tailwind/html/scripts/collapse.js"></script>
 
<!-- from cdn -->
<script src="https://unpkg.com/@material-tailwind/html@latest/scripts/collapse.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>

<script>
const labels = ['Enero', 'Febrero', 'Marzo', 'Abril']

const graph = document.querySelector("#graph");

const data = {
    labels: labels,
    datasets: [{
        label:"Ejemplo 1",
        data: [1, 2, 3, 4],
        backgroundColor: 'rgba(9, 129, 176, 0.2)'
    }]
};

const config = {
    type: 'bar',
    data: data,
};

new Chart(graph, config);
</script>
<style>

  #allScreen{
    overflow-y:scroll;
  }

    .tooltip {
      bottom: -30px;
        right: -100px;
      position: absolute;
      background-color: #e0ec6d;
      color: #030303;
      padding: 5px;
      border-radius: 4px;
      font-size: 14px;
      white-space: nowrap;
      visibility: hidden;
      opacity: 0;
      transition: opacity 0.3s;
    }
    .tooltip-container:hover .tooltip {
      visibility: visible;
      opacity: 1;
    }


    .switch-container {
  display: flex;
  align-items: center;
  gap: 10px;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 34px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #4CAF50;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

  </style>
</html>
