
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


<div class="flex mb-2 shadow">
  <div class="bg-teal-500 w-full p-1 flex rounded-lg">
  <form><p onclick="restringirMultiplesEventes(event)" class="shadow pt-3 w-36 bg-white hover:bg-lime-400 hover:cursor-pointer rounded-lg mr-auto font-bold flex" id="crear_evento">
      <svg class="h-8 w-8 text-slate-900 mb-2 ml-1"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M4 13a8 8 0 0 1 7 7a6 6 0 0 0 3 -5a9 9 0 0 0 6 -8a3 3 0 0 0 -3 -3a9 9 0 0 0 -8 6a6 6 0 0 0 -5 3" />  <path d="M7 14a6 6 0 0 0 -3 6a6 6 0 0 0 6 -3" />  <circle cx="15" cy="9" r="1"  /></svg>
      <button type="button">Crear evento</button></p></form>

      <p class="ml-auto mr-5 mt-3 text-xl font-serif text-gray-300">PROVINTY</p>
  </div>
</div>  


<ul id="eventos">

<?php

foreach($eventos as $evento){
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
    <div class="bg-red-100 mr-2 ml-2 rounded-lg" onclick="eliminarEvento('.$evento['ID_Evento'].')">
        <svg class="h-8 w-8 text-red-900 hover:bg-red-300 hover:rounded-lg hover:cursor-pointer"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
            <path stroke="none" d="M0 0h24v24H0z"/>  
            <line x1="4" y1="7" x2="20" y2="7" />  
            <line x1="10" y1="11" x2="10" y2="17" />  
            <line x1="14" y1="11" x2="14" y2="17" />  
            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  
            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
        </svg>
    </div>
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

?>
</ul>


<!---MODAL--->
<section id="categoria_entrada" class="fixed top-0 bottom-0 left-0 right-0 bg-black bg-opacity-60 z-50 flex" style="display: none;">
<section class="rounded  my-auto mx-auto bg-white p-5">
  <div class="flex">
    <input type="checkbox" class="mr-2" id="cat1" onclick="verificarCheck('cat1')">
    <p class="mx-2" >SUPER VIP</p>
    <input class="border-2 border-slate-300 ml-auto"  type="number" id="cat1-input" style="display: none;margin-left: auto;">
  </div>

  <div class="flex">
    <input type="checkbox" class="mr-2" id="cat2" onclick="verificarCheck('cat2')">
    <p class="mx-2" >VIP</p>
    <input class="border-2 border-slate-300 ml-auto"  type="number" id="cat2-input" style="display: none;margin-left: auto;">
  </div>
  <div class="flex">
    <input type="checkbox" class="mr-2" id="cat3" onclick="verificarCheck('cat3')">
    <p class="mx-2" >PALCO VIP</p>
    <input class="border-2 border-slate-300 ml-auto"  type="number" id="cat3-input" style="display: none;margin-left: auto;">
  </div>
  <div class="flex">
    <input type="checkbox" class="mr-2" id="cat4" onclick="verificarCheck('cat4')">
    <p class="mx-2" >GENERAL </p>
    <input class="border-2 border-slate-300 ml-auto"  type="number" id="cat4-input" style="display: none;margin-left: auto;">
  </div>

  <div class="flex">
    <input type="checkbox" class="mr-2" id="cat5" onclick="verificarCheck('cat5')" >
    <p class="mx-2" >PALCO GENERAL</p>
    <input class="border-2 border-slate-300 ml-auto"  type="number" id="cat5-input" style="display: none;margin-left: auto;">
  </div>
  <div class="flex">
    <input type="checkbox" class="mr-2" id="cat6" onclick="verificarCheck('cat6')" >
    <p class="mx-2" >NIÑOS SUPERVIP</p>
    <input class="border-2 border-slate-300 ml-auto"  type="number" id="cat6-input" style="display: none;margin-left: auto;">
  </div>
  <div class="flex">
    <input type="checkbox" class="mr-2" id="cat7" onclick="verificarCheck('cat7')" >
    <p class="mx-2" >NIÑOS VIP</p>
    <input class="border-2 border-slate-300 ml-auto"  type="number" id="cat7-input" style="display: none;margin-left: auto;">
  </div>

  <div class="flex">
    <input type="checkbox" class="mr-2" id="cat8" onclick="verificarCheck('cat8')" >
    <p class="mx-2" >NIÑOS PALCO VIP</p>
    <input class="border-2 border-slate-300 ml-auto"  type="number" id="cat8-input" style="display: none;margin-left: auto;">
  </div>
  <div class="flex">
    <input type="checkbox" class="mr-2" id="cat9" onclick="verificarCheck('cat9')" >
    <p class="mx-2"  >NIÑOS GENERAL</p>
    <input class="border-2 border-slate-300 ml-auto"  type="number" id="cat9-input" style="display: none;margin-left: auto;">
  </div>
  <div class="flex">
    <input type="checkbox" class="mr-2" id="cat10" onclick="verificarCheck('cat10')" >
    <p class="mx-2"  >NIÑOS PALCO GENERAL</p>
    <input class="border-2 border-slate-300 ml-auto"  type="number" id="cat10-input" style="display: none;margin-left: auto;">
  </div>

  <div class="flex">
<button class="rounded  p-2 bg-green-300 hover:bg-green-400 ml-auto mt-2" onclick="guardarEventoCategoria(event)"><p>GUARDAR</p></button>
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




    .toggle {
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  width: 90px;
  height: 30px;
  background-color: #44a2be;
  border-radius: 20px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.toggle input {
  display: none; /* Escondemos el checkbox */
}

.toggle label {
  cursor: pointer;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  height: 100%;
  padding: 0 5px;
  z-index: 1;
}

.toggle .slider {
  position: absolute;
  left: 2.5px;
  top: 2.5px;
  width: 25px;
  height: 25px;
  background-color: white;
  border-radius: 50%;
  transition: transform 0.3s ease;
  z-index: 2;
}

.toggle input:checked + label .slider {
  transform: translateX(60px); /* Mueve la bola de un lado al otro */
}

.toggle input:checked ~ .toggle {
  background-color: #44a2be; /* Cambia el fondo al estar activado */
}

.toggle label .on,
.toggle label .off {
  font-size: 12px;
  color: white;
}

.toggle label .on {
  color: #44a2be;
}

.toggle input:checked + label .on {
  color: white;
}

.toggle input:checked + label .off {
  color: #44a2be;
}


  </style>
</html>
