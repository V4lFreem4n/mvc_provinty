let ultimoId = 0;

let estado_establecido_categoria_entrada = false;

let estadoMostrarHistorial = false;

let verificadorEventoDesplegado = false;

let estados_descripcion = [];

const listaEventos = [];

let estado_panel_descripcion = false; //13:41 Acá desplegamos el panel

let idAdvertenciaEventoNoRellenado = 0;

const lista = document.getElementById('eventos');
const items = lista.getElementsByTagName('li');
const ArrayDeDivsEventos = Array.from(items);

console.log("Cantidad de eventos:" + items.length);
console.log("Array : ",ArrayDeDivsEventos);

let index = 0;

ArrayDeDivsEventos.forEach(div => {
  index = div.id;
  let estado_panel_evento = {
    "id":index,
    "modificar":false
}

ultimoId = parseInt(index) + 1;
estados_descripcion.push(estado_panel_evento);
  console.log("El id del div es : " + index)
});


let categorias = {
  cat1: "SUPER VIP",
  cat2: "VIP",
  cat3: "PALCO VIP",
  cat4: "GENERAL",
  cat5: "PALCO GENERAL",
  cat6: "NIÑOS SUPERVIP",
  cat7: "NIÑOS VIP",
  cat8: "NIÑOS PALCO VIP",
  cat9: "NIÑOS GENERAL",
  cat10: "NIÑOS PALCO GENERAL"
};


function crearEvento(){

let evento = document.createElement("li");
evento.id = "evento-"+ultimoId;
evento.innerHTML = ` <div class="bg-white py-2 flex px-2 my-2">
<svg class="h-8 w-8 text-black-400 mt-2"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
  </svg>
<input placeholder="Complete los campos" style="width: 300px;" class="ml-2 p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" disabled id="nombre-evento-titulo-${index}">
<div class="ml-auto flex py-2">

<!--DANGER-->
    <div class="relative tooltip-container" style="display:none" id="dangerEventoDesplegado_${ultimoId}">
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
      <input type="checkbox" id="toggleSwitch">
      <span class="slider"></span>
    </label>
    <span id="switchLabel">Privado</span>
  </div>


    <!--ID-->
    <div class="mt-1 flex mr-4"><p class="font-bold mr-1">ID</p><p>${ultimoId}</p></div>
    <!---->
    <!--MODIFICAR-->
    <p onclick="visiblePanelModificar(${ultimoId})" class="bg-green-200 px-2 py-1 ml-2 mr-2 hover:bg-green-300 hover:cursor-pointer rounded-lg hover:rounded-lg disabled:pointer-events-none transition-all" id="collapse-${ultimoId}">Editar</p>
    <!---->
    <!--ESTADISTICAS-->
    <a class="bg-blue-200 px-2 py-1 hover:bg-blue-300 hover:cursor-pointer rounded-lg hover:rounded-lg" href="./admin-estadisticas-evento.php?id=${ultimoId}" target="_blank">Estadísticas</a>
    <!---->
    <!--ELIMINAR-->
    <div class="bg-red-100 mr-2 ml-2 rounded-lg" onclick="eliminarEvento(${ultimoId})">
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

<!--Panel de descripción-->
<form action="../controlador/Evento/controladorCrearEvento.php" method="post" id="formulario"><div id="collapse-panel-${ultimoId}" style="display:block">
  <div class="bg-green-200 p-1"></div>
<div class="bg-slate-200 p-5 grid grid-cols-3">
  <div>
    <div class="ml-2">
      <input id="input-evento-nombre-${ultimoId}" name="nombre" placeholder="Nombre del evento" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none " required >
      <p class="text-xs ml-1">Nombre del evento*</p>
    </div>

    <div class="ml-2 my-1">
      <input id="input-evento-fecha-${ultimoId}" name="fecha" type="date" placeholder="Fecha del evento" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      <p class="text-xs ml-1">Fecha del evento*</p>
    </div>

    <div class="ml-2 my-1">
      <input id="input-evento-ubicacion-${ultimoId}" name="ubicacion" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none " placeholder="Ubicación del evento">
      <p class="text-xs ml-1">Ubicación del evento*</p>
    </div>

    <div class="ml-2 my-1">
      <a id="input-evento-ubicacion-${ultimoId}" style="width: 300px;" class="hover:text-green-400" href="#" onclick="visibleModalCategoriaEntradas(${ultimoId})"><strong>Categorías de entrada</strong></a>
      <p class="text-xs ml-1">Ubicación del evento*</p>
    </div>

    <div class="ml-2 my-1">
      <div class="flex">
      <input onclick="validarHora(${ultimoId})" name="horaInicio" type="time" id="input-evento-hora-inicio-${ultimoId}" placeholder="Hora del evento" style="width: 100px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      <input disabled type="time" name="horaFin" id="input-evento-hora-fin-${ultimoId}" placeholder="Hora del evento" style="width: 100px;" class="ml-3 p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      
      </div>
      <p class="text-xs ml-1">Hora de inicio y fin del evento*</p>
    </div>

    <div class="ml-2 my-1">
      <input type="number" name="capacidad" id="input-evento-capacidad-${ultimoId}" placeholder="Capacidad del evento" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      <p class="text-xs ml-1">Capacidad del evento*</p>
    </div>

  </div>

  <div>
<div class="ml-2 my-1">
      <input id="input-evento-organizador-${ultimoId}" name="organizador" placeholder="Organizador evento" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      <p class="text-xs ml-1">Organizador del evento*</p>
    </div>

    <div class="ml-2 my-1">
      <input id="input-evento-contacto-organizador-${ultimoId}" name="contactoOrganizador" placeholder="Contacto del organizador del evento" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      <p class="text-xs ml-1">Contacto del organizador del evento*</p>
    </div>

 <div class="ml-2 my-1">
      <input id="input-evento-redes-${ultimoId}" name="redes" placeholder="Redes sociales del evento" style="width: 300px;" class="p-2 text-gray-900 rounded-lg bg-gray-50 focus:outline-none" required >
      <p class="text-xs ml-1">Redes sociales del evento*</p>
    </div>

<div class="ml-2 my-1">
      <input type="file" id="input-evento-cancelacion-${ultimoId}" name="politicaCancelacion" required >
      <p class="text-xs ml-1 text-red-900">Política de cancelación del evento*</p>
    </div>

    <div>
    <textarea id="input-evento-descripcion-${ultimoId}" name="descripcion" placeholder="Describe el evento..." class="w-full focus:outline-none p-2" required ></textarea>
    <p class="text-xs ml-1">Descripción del evento*</p>
    </div>
  </div>


  <div>
    <div class="bg-white px-5 ml-5 mb-1 flex" style="width: 150px; height: 150px;">
      <img src="images/imagen.png" class="my-auto mx-auto" id="imagen_evento_${ultimoId}">
 
    </div>
    <p class="text-xs ml-5 my-1">Imagen del evento*</p>
    <input id="input-evento-imagen-${ultimoId}" name="imagen" type="file" class="ml-5" onchange="subirImagen(this,'imagen_evento_${ultimoId}')" accept=".jpg, .jpeg, .png">
    
    <div id="json_precios_categorias"></div>
    <div id="json_terminos_condiciones"></div>
    
  <div class="ml-5 mt-2"><p style=""><strong class="terminosCondiciones" onclick="terminosCondiciones()">Términos y condiciones</strong></p></div>

    <div class="flex">
      <button class="p-2 bg-green-300 hover:bg-green-400 rounded mt-2 ml-auto rounded" type="button" onclick="guardarEvento(${ultimoId})">GUARDAR</button>
    </div>
  </div>

</div>
</div></form>


<!------------------------>
`;
//Cada vez que creamos un evento, vamos a usar el array de estados
let estado_panel_evento = {
    "id":ultimoId,
    "modificar":true
}
estados_descripcion.push(estado_panel_evento);
document.getElementById("eventos").appendChild(evento);
//alert("El evento se creó exitosamente")

}

//Vamos a crear una función que identifique el evento donde lo aparezca y desaparezca a voluntad.
function visiblePanelModificar(e){
console.log("Se pulsó :", "panel visible : ID ->", e)

    estados_descripcion.forEach(elemento => {
      console.log("Se llegó acá eo", e)
    if(elemento.id == e){
      console.log("Se llegó acá eoooo", e)
        if(elemento.modificar == false){
            document.getElementById("collapse-panel-"+e).style.display="block";  //Aki desplegamos
            //document.getElementById("panel-stats-"+e).style.display="none";
            elemento.modificar = true; //<---Entramos al elemento y si está cerrado lo abrimos
            console.log("Se pulsó :", "panel visible - DESPLEGADO ", "elemento.modificar = true")
        }else{
            document.getElementById("collapse-panel-"+e).style.display="none"; //Aki cerramos :v
            elemento.modificar = false; //Entramos al elemento y si está abierto lo cerramos
            console.log("Se pulsó :", "panel visible - OCULTO ", "elemento.modificar = false")
        }

    }
});    
}


function visibleModalCategoriaEntradas(e){
  document.getElementById("categoria_entrada").style.display="flex";
}

//Cerrar modal
document.getElementById("categoria_entrada").addEventListener('click',(event)=>{
  console.log("LLEGAMOS ACA 1")
  if (event.target.id == "categoria_entrada") {
    console.log("LLEGAMOS ACA 2")
    document.getElementById("categoria_entrada").style.display="none"; 
    //Acá vamos a cerrar el modal y vamos a formatear todos los campos
    for (let indice = 1; indice <= 10; indice++) {
      document.getElementById("cat-venta-"+indice).value= "";
      document.getElementById("cat-preventa-"+indice).value= "";
      document.getElementById("cat"+indice).checked = false;
      document.getElementById("cat-venta-"+indice).style.display="none";
    document.getElementById("cat-preventa-"+indice).style.display="none";
    }
  }
  
})

//Mostrar inputs en el modal por checks

function verificarCheck(e){
  let check = document.getElementById('cat'+e);
  if(check.checked){
    document.getElementById("cat-venta-"+e).style.display="flex";
    document.getElementById("cat-preventa-"+e).style.display="flex";
  }else{
    document.getElementById("cat-venta-"+e).style.display="none";
    document.getElementById("cat-preventa-"+e).style.display="none";
  }
}

function obtenerCategoriasSeleccionadas() {
  let categoriasSeleccionadas = []; 

  for (let i = 1; i <= 10; i++) {
    let checkboxId = `cat${i}`; 
    let inputId = `cat${i}-input`;
    let checkbox = document.getElementById(checkboxId); 

    if (checkbox.checked) {
      let input_value = document.getElementById(inputId).value;
      categoriasSeleccionadas.push({ categoria: categorias[checkboxId], cantidad: input_value });
    }
  }

  console.log(categoriasSeleccionadas);

  return categoriasSeleccionadas;
}



//Eliminar componente
function eliminarEvento(event){
  event.preventDefault();
  const formulario = event.target.closest('form');
  if(confirm("¿Deseas eliminar este evento?")){
    console.log("El evento se eliminó de forma satisfactoria");
    formulario.submit();
  }else{
    console.log("Siga programando")
  }
}
 

function guardarEvento(e) {

let formularioCrear = document.getElementById("formulario");  
 

console.log("EL ID AL CREAR EL NUEVO EVENTO ES :",e)
  let nombreE = document.getElementById("input-evento-nombre-" + e).value;
  console.log("EL NOMBREEEEEEEEEE ES ;", nombreE)
  let fechaE = document.getElementById("input-evento-fecha-" + e).value;
  let categoriaE = obtenerCategoriasSeleccionadas();
  let ubicacionE = document.getElementById("input-evento-ubicacion-" + e).value;
  let horaInicioE = document.getElementById("input-evento-hora-inicio-" + e).value;
  let horaFinE = document.getElementById("input-evento-hora-fin-" + e).value;
  let capacidadE = document.getElementById("input-evento-capacidad-" + e).value;
  let organizadorE = document.getElementById("input-evento-organizador-" + e).value;
  let contactoOrganizadorE = document.getElementById("input-evento-contacto-organizador-" + e).value;
  let redesE = document.getElementById("input-evento-redes-" + e).value;
  let politicaCancelacionE = document.getElementById("input-evento-cancelacion-" + e).files[0];  // Es un archivo
  let descripcionE = document.getElementById("input-evento-descripcion-" + e).value;
  let imagenE = document.getElementById("input-evento-imagen-" + e).files[0];  // Es un archivo

  // Valida si hay campos vacíos
  
  
  if (!nombreE || !fechaE || !categoriaE || !ubicacionE || !horaInicioE || !horaFinE || !capacidadE || 
      !organizadorE || !contactoOrganizadorE || !redesE || !politicaCancelacionE || !descripcionE || !imagenE) {
    alert("Faltan datos");
    return;
  }
 
  if(!estado_establecido_categoria_entrada){
     alert("Aún no ha establecido las entradas en diversas categorías.");
     return;
  }

/*
  let datosEvento = {
    id: e,
    nombre: nombreE,
    fecha: fechaE,
    categoria: categoriaE,
    ubicacion: ubicacionE,
    horaInicio: horaInicioE,
    horaFin: horaFinE,
    capacidad: capacidadE,
    organizador: organizadorE,
    contactoOrganizador: contactoOrganizadorE,
    redes: redesE,
    politicaCancelacion: politicaCancelacionE.name, // Si deseas almacenar solo el nombre del archivo
    descripcion: descripcionE,
    imagen: imagenE.name // Solo guardamos el nombre del archivo
  };
*/
  //listaEventos.push(datosEvento);  // Guarda el evento en la lista

  // Actualizar el título del evento si es necesario
 

  formularioCrear.submit();

  verificadorEventoDesplegado = false; 
  document.getElementById("dangerEventoDesplegado_"+(ultimoId)).style.display="none";
}


//SCRIPTS DE VERIFICACIÓN DE LA HORA


function validarHora(e) {
  console.log("Se llegó a la hora inicio", e);
  let horaInicioInput = document.getElementById('input-evento-hora-inicio-' + e);
  let horaFinInput = document.getElementById('input-evento-hora-fin-' + e);

  // Deshabilitar el input de hora de fin hasta que se ingrese una hora en el de inicio
  horaInicioInput.addEventListener('input', function() {
    if (horaInicioInput.value) {
      console.log("Se habilitó para cambiar de hora");
      // Habilitar el input de hora de fin cuando se ingrese una hora de inicio
      horaFinInput.disabled = false;
    } else {
      console.log("Se deshabilitó para cambiar de hora");
      // Volver a deshabilitar el input si se borra la hora de inicio
      horaFinInput.disabled = true;
      horaFinInput.value = ''; // Limpiar el valor de la hora de fin
    }
  });

  // Validar la hora de fin respecto a la hora de inicio
  horaFinInput.addEventListener('input', function() {
    const horaInicio = horaInicioInput.value;
    const horaFin = horaFinInput.value;

    if (horaInicio && horaFin) {
      // Convertir las horas a objetos Date para compararlas
      const [horaI, minutoI] = horaInicio.split(':');
      const [horaF, minutoF] = horaFin.split(':');
      const fechaInicio = new Date(0, 0, 0, horaI, minutoI);
      const fechaFin = new Date(0, 0, 0, horaF, minutoF);

      if (fechaFin <= fechaInicio) {
        console.log('La hora de fin debe ser posterior a la hora de inicio.');
        alert('La hora de fin debe ser posterior a la hora de inicio.');
        horaFinInput.value = ""; // Limpiar la hora de fin si no es válida
      }
    }
  });
}


function subirImagen(input, imgId) {
  const file = input.files[0]; // Obtener el archivo seleccionado
  const imgElement = document.getElementById(imgId); // Obtener el elemento img dinámicamente
  console.log(imgElement);
  console.log("LLEGAMOS A IMAGEN")
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      imgElement.src = e.target.result; // Establecer la imagen en el src
    };
    reader.readAsDataURL(file); // Leer el archivo como URL
  }
}

    
function restringirMultiplesEventes(){
  if(verificadorEventoDesplegado==true){
    alert("Tiene un evento pendiente por completar!!");
    
    document.getElementById("dangerEventoDesplegado_"+(ultimoId)).style.display="flex"; //ESTO SE TIENE QUE BORRAR

  }else{ // Si se llega acá es que --> verificadorEventoDesplegado == false
    verificadorEventoDesplegado = true;



const url = '../controlador/Evento/controladorEvento.php';

// Los datos que quieres enviar
const data = {
    crear: true,
};

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



    crearEvento(); //El verificadorEventoDesplegado cambia de estado a false en "GUARDAR"
  }
}


function guardarEventoCategoria(e){
  obtenerCategoriasSeleccionadas();
  alert("Las categorías del evento se guardaron con Éxito")
}


function mostrarHistorial(){
  if(estadoMostrarHistorial){
    document.getElementById("tabla-historial").style.display="none";
    estadoMostrarHistorial=false;
  }else{
    document.getElementById("tabla-historial").style.display="block";
    estadoMostrarHistorial=true;
  } 
}

function confirmarDatosAlGuardar(){

}


function guardarDatosPreciosCategoria(){
  let estado = false;
  let listaPrecios = [];
  
  for (let index = 1; index <= 10; index++) {
    if(document.getElementById("cat"+index).checked){
      
if(document.getElementById("cat-venta-"+index).value!="" && document.getElementById("cat-preventa-"+index).value!=""){
let precios = {
        categoria: document.getElementById("nombre_categoria_evento_"+index).textContent,
        venta: document.getElementById("cat-venta-"+index).value,
        preventa: document.getElementById("cat-preventa-"+index).value,
      }
      listaPrecios.push(precios) 
      estado = true;
      estado_establecido_categoria_entrada = true;
      
}else{
  estado=false;
}}}

  if(estado){
    let preciosJSON = JSON.stringify(listaPrecios);
    insertarJsonCategoriasEntrada(preciosJSON);
  console.log(preciosJSON);
  }else{
    alert("Aún no ha completado todos los campos de los precios de las categorías de entrada");   
  }

}

function insertarJsonCategoriasEntrada(json){
document.getElementById("json_precios_categorias").innerHTML = '';
let input = document.createElement("input");
input.type="hidden";
input.value = json;
input.name="json";
document.getElementById("json_precios_categorias").appendChild(input);
}



const toggleSwitch = document.getElementById('toggleSwitch');
const switchLabel = document.getElementById('switchLabel');

function visibilizarEvento(e){


  const url = '../controlador/Evento/controladorVisibilizarEvento.php';

  // Los datos que quieres enviar
  
  
  console.log("Estamos switcheando!")
  if(document.getElementById("switchLabel_"+e).textContent == "Público"){
    document.getElementById("switchLabel_"+e).textContent = "Privado"
    console.log("Privado")
    const data = {
      estado: "Privado",
      id:e,
  };
  
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
  }else{
    document.getElementById("switchLabel_"+e).textContent = "Público"
    console.log("Publico")
    const data = {
      estado: "Público",
      id:e,
  };
  
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
  }

  document.addEventListener("DOMContentLoaded", function() {
    // Aquí colocas la función que se ejecutará al cargar la página
    establecerFuncionalidad();
});
  

  function establecerFuncionalidad(){
    ArrayDeDivsEventos.forEach(div => {
      index = div.id;
      let estado = document.getElementById("switchLabel_"+index).textContent;

      if(estado=="Público"){
        document.getElementById("switch_visibilidad_"+index).checked = true;
      }

      if(estado=="Privado"){
        document.getElementById("switch_visibilidad_"+index).checked = false;
      }
  })}

  function terminosCondiciones(){
    document.getElementById("terminos_condiciones").style.display="flex";

  }

  document.getElementById("terminos_condiciones").addEventListener('click',(event)=>{
    console.log("SI LLEGAMOS")
    if (event.target.id == "terminos_condiciones") {
      console.log("NO LLEGAMOS")
      document.getElementById("terminos_condiciones").style.display="none"; 
      //Acá vamos a cerrar el modal y vamos a formatear todos los campos
      /**
       * for (let indice = 1; indice <= 10; indice++) {
        document.getElementById("cat-venta-"+indice).value= "";
        document.getElementById("cat-preventa-"+indice).value= "";
        document.getElementById("cat"+indice).checked = false;
        document.getElementById("cat-venta-"+indice).style.display="none";
      document.getElementById("cat-preventa-"+indice).style.display="none";
      }
       */
    }
    
  })

  let contador = 0;

  // Agregar un nuevo término dinámicamente
  function agregarTerminoCondiciones() {
    contador++;
    let condicion = document.createElement("div");
    condicion.innerHTML = `
      <div class="mb-2">
        <input id="termino_${contador}" 
               class="border border-gray-300 rounded-lg p-1 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" 
               placeholder="Término y Condición ${contador}">
      </div>`;
    document.getElementById("section-terminos-condiciones").appendChild(condicion);
  }

  // Guardar los valores de los inputs dinámicos
  function guardarTerminos() {
    const contenedor = document.getElementById('section-terminos-condiciones');

    // Seleccionar todos los inputs con IDs que comiencen con "termino_"
    const inputs = contenedor.querySelectorAll('[id^="termino_"]');

    // Crear un array para almacenar los valores
    const valores = Array.from(inputs).map(input => input.value);

    // Mostrar los valores en la consola o usarlos como necesites
    console.log('Valores guardados:', valores);

    // Si necesitas guardar en una variable global, simplemente haz:
    // window.valoresGuardados = valores;
  }

function insertarJsonCategoriasEntrada(arry){
document.getElementById("json_terminos_condiciones").innerHTML = '';
let input = document.createElement("input");
input.type="hidden";
input.value = json;
input.name="json_terminos_condiciones";
document.getElementById("json_terminos_condiciones").appendChild(input);
}

