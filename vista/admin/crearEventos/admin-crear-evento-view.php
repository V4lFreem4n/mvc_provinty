
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script async src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
</head>
<body>
<section class="bg-gray-300 w-screen h-screen px-0 py-10" id="allScreen">
<div class="container mx-auto">


<div class="flex shadow">
  <div class="bg-slate-800 w-full p-1 flex rounded-lg">
  <form><p onclick="restringirMultiplesEventes(event)" class="shadow p-2 w-36 bg-emerald-300 hover:bg-teal-400 hover:cursor-pointer rounded-lg mr-auto font-bold flex justify-center items-center" id="crear_evento">
      <svg class="h-8 w-8 text-slate-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M4 13a8 8 0 0 1 7 7a6 6 0 0 0 3 -5a9 9 0 0 0 6 -8a3 3 0 0 0 -3 -3a9 9 0 0 0 -8 6a6 6 0 0 0 -5 3" />  <path d="M7 14a6 6 0 0 0 -3 6a6 6 0 0 0 6 -3" />  <circle cx="15" cy="9" r="1"  /></svg>
      <button type="button" class="text-slate-800">Crear evento</button></p></form>


      <button onclick="mostrarHistorial()" class="ml-5 shadow p-2 w-36 bg-emerald-300 hover:bg-teal-400 hover:cursor-pointer rounded-lg mr-auto font-bold flex justify-center items-center">
      <svg class="h-8 w-8 text-slate-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <polyline points="12 8 12 12 14 14" />  <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" /></svg>  
      <p class="text-slate-800">Historial</p></button>
      <img class="ml-auto" src="../vista/admin/crearEventos/logo.jpeg" width="100px">
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
  
  <?php
  foreach($eventos as $evento){
    if($evento['Estado_Publicacion']=="Cancelado"){
      echo '<div class="flex">
  <svg class="h-6 w-6 text-slate-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="12.41 6.75 13 2 10.57 4.92" />  <polyline points="18.57 12.91 21 10 15.66 10" />  <polyline points="8 8 3 14 12 14 11 22 16 16" />  <line x1="1" y1="1" x2="23" y2="23" /></svg>
  <p class="flex font-bold text-slate-500">'.$evento['Titulo'].'</p>  
</div>
<div>'.$evento['ID_Evento'].'</div>
    <div>'.$evento['Artista_Autor'].'</div>
    <div>'.$evento['f_borrado'].'</div>
    <div>'.$evento['hora_borrado'].'</div>
    <div><a href="#" class="hover:text-blue-400 font-bold">Pulsar aquí</a></div>';
  }
    }
  ?>
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
 <div class="switch-container mr-3">
    <label class="switch" style="cursor:pointer;">
      <input type="checkbox" id="switch_visibilidad_'.$evento['ID_Evento'].'" onclick="visibilizarEvento('.$evento['ID_Evento'].')">
      <span class="slider"></span>
    </label>
    <span id="switchLabel_'.$evento['ID_Evento'].'">'.$evento['visibilidad'].'</span>
  </div>

    <!--ID-->
    <div class="mt-1 flex mr-4"><p class="font-bold mr-1">ID</p><p>'.$evento['ID_Evento'].'</p></div>
    <!---->
    <!--MODIFICAR-->
    <p onclick="visiblePanelModificar('.$evento['ID_Evento'].')" class="bg-green-200 px-2 py-1 ml-2 mr-2 hover:bg-green-300 hover:cursor-pointer rounded-lg hover:rounded-lg disabled:pointer-events-none transition-all" id="collapse-'.$evento['ID_Evento'].'">Ver detalles</p>
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
<div id="collapse-panel-'.$evento['ID_Evento'].'" style="display:none">
  <div class="bg-green-200 p-1"></div>
<div class="bg-slate-200 p-5 grid grid-cols-3">
  <div>
    <div class="ml-2">

      <div class="flex p-1 bg-stone-100 rounded divide-slate-200">
      <svg class="h-8 w-8 text-slate-300"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="5" y="11" width="14" height="10" rx="2" />  <circle cx="12" cy="16" r="1" />  <path d="M8 11v-4a4 4 0 0 1 8 0v4" /></svg>
      <p>'.$evento['Titulo'].'</p>
      </div>

      <p class="text-xs ml-1">Nombre del evento*</p>
    </div>

    <div class="ml-2 my-1">
    <div class="flex p-1 bg-stone-100 rounded divide-slate-200">
      <svg class="h-8 w-8 text-slate-300"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="5" y="11" width="14" height="10" rx="2" />  <circle cx="12" cy="16" r="1" />  <path d="M8 11v-4a4 4 0 0 1 8 0v4" /></svg>
    <p>'.date('Y-m-d', strtotime($evento['Fecha_Creacion'])).'</p>
      </div>
      
      <p class="text-xs ml-1">Fecha del evento*</p>
    </div>

    <div class="ml-2 my-1">
    <div class="flex p-1 bg-stone-100 rounded divide-slate-200">
      <svg class="h-8 w-8 text-slate-300"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="5" y="11" width="14" height="10" rx="2" />  <circle cx="12" cy="16" r="1" />  <path d="M8 11v-4a4 4 0 0 1 8 0v4" /></svg>
    <p>'.$evento['ubicacion'].'</p>  
      </div>
    
    <p class="text-xs ml-1">Ubicación del evento*</p>
    </div>

    <div class="ml-2 my-1">
      <a id="input-evento-categoria-'.$evento['ID_Evento'].'" style="width: 300px;" class="hover:text-green-400 font-bold" href="#" onclick="visibleModalCategoriaEntradas('.$evento['ID_Evento'].')">Categorías de entrada</a>
      <p class="text-xs ml-1">Categorías de la entrada*</p>
    </div>

    <div class="ml-2 my-1">
      <div class="flex">
      <p class="p-1 bg-stone-100 rounded flex">
      <svg class="h-8 w-8 text-slate-300"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="4" y="5" width="16" height="16" rx="2" />  <line x1="16" y1="3" x2="16" y2="7" />  <line x1="8" y1="3" x2="8" y2="7" />  <line x1="4" y1="11" x2="20" y2="11" />  <line x1="10" y1="16" x2="14" y2="16" />  <line x1="12" y1="14" x2="12" y2="18" /></svg>
      '.$evento['horaInicioEvento'].'
      </p>
      <p class="ml-2 p-1 bg-stone-100 rounded flex">
      <svg class="h-8 w-8 text-slate-300"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="4" y="5" width="16" height="16" rx="2" />  <line x1="16" y1="3" x2="16" y2="7" />  <line x1="8" y1="3" x2="8" y2="7" />  <line x1="4" y1="11" x2="20" y2="11" />  <rect x="8" y="15" width="2" height="2" /></svg>
      '.$evento['horaFinEvento'].'
      </p>
      </div>
      <p class="text-xs ml-1">Hora de inicio y fin del evento*</p>
    </div>

    <div class="ml-2 my-1">
    <div class="flex p-1 bg-stone-100 rounded divide-slate-200">
      <svg class="h-8 w-8 text-slate-300"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="5" y="11" width="14" height="10" rx="2" />  <circle cx="12" cy="16" r="1" />  <path d="M8 11v-4a4 4 0 0 1 8 0v4" /></svg>
      <p>'.$evento['Aforo'].'</p> 
      </div>
   
     <p class="text-xs ml-1">Capacidad del evento*</p>
    </div>

  </div>

  <div>
<div class="ml-2 my-1">
<div class="flex p-1 bg-stone-100 rounded divide-slate-200">
      <svg class="h-8 w-8 text-slate-300"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="5" y="11" width="14" height="10" rx="2" />  <circle cx="12" cy="16" r="1" />  <path d="M8 11v-4a4 4 0 0 1 8 0v4" /></svg>
    <p>'.$evento['organizador'].'</p>     
      </div>
 
    <p class="text-xs ml-1">Organizador del evento*</p>
    </div>

    <div class="ml-2 my-1">
    <div class="flex p-1 bg-stone-100 rounded divide-slate-200">
      <svg class="h-8 w-8 text-slate-300"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="5" y="11" width="14" height="10" rx="2" />  <circle cx="12" cy="16" r="1" />  <path d="M8 11v-4a4 4 0 0 1 8 0v4" /></svg>
    <p>'.$evento['contacto_organizador'].'</p> 
      </div>
     
    <p class="text-xs ml-1">Contacto del organizador del evento*</p>
    </div>

 <div class="ml-2 my-1">
 <div class="flex p-1 bg-stone-100 rounded divide-slate-200">
      <svg class="h-8 w-8 text-slate-300"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="5" y="11" width="14" height="10" rx="2" />  <circle cx="12" cy="16" r="1" />  <path d="M8 11v-4a4 4 0 0 1 8 0v4" /></svg>
    <p>'.$evento['redes'].'</p>
      </div>
    
 <p class="text-xs ml-1">Redes sociales del evento*</p>
    </div>

<div class="ml-2 my-1">
  <a href="#" class="hover:text-blue-600">Pulsar aquí para descargar</a>
      <p class="text-xs ml-1 text-red-900">Política de cancelación del evento*</p>
    </div>

    <div>
    <textarea disabled style="width:250px" class="bg-stone-100 ml-2">'.$evento['Descripcion'].'</textarea>
    <p class="text-xs ml-1">Descripción del evento*</p>
    </div>
  </div>


  <div>
    <div class="bg-white px-5 ml-5 mb-1 flex" style="width: 150px; height: 150px;">
      <img src="images/imagen.png" class="my-auto mx-auto" id="imagen_evento_'.$evento['ID_Evento'].'">
 
    </div>
    <p class="text-xs ml-5 my-1">Imagen del evento*</p>
  </div>

</div>
</div>'
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

<section id="terminos_condiciones" class="fixed top-0 bottom-0 left-0 right-0 bg-black bg-opacity-60 z-50 flex" style="display: flex;">

<section class="rounded  my-auto mx-auto bg-white p-5 w-3/4 max-w-2xl">
<div class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

<div>
 <div class="flex mb-2"><p class="text-lg">Términos y Condiciones</p> <button class="p-2 bg-teal-400 text-white rounded-lg ml-auto" onclick="agregarTerminoCondiciones()">Añadir</button></div>
 <div id="section-terminos-condiciones"></div>
 <div class="mt-2 flex"><button class="p-2 bg-emerald-600 text-white rounded-lg ml-auto" onclick="guardarTerminos()">Guardar</button></div>
 
</div>

</div></section></section>



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

.terminosCondiciones{
cursor: pointer;
}

.terminosCondiciones:hover{
  color:#4CAF50;
}

  </style>
</html>
