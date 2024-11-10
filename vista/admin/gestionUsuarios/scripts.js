// Variable para almacenar los usuarios obtenidos desde la base de datos
let usuarios = [];
let usuarioEnEdicion = null;
let paginaActual = 1;
let totalPaginas = 1;

// Función para abrir el modal de creación/edición de usuario
function abrirModal() {
    // Resetear el formulario
    document.getElementById('usuarioForm').reset();

    // Resetear el estado de edición
    usuarioEnEdicion = null;

    // Actualizar el título para nuevo usuario
    document.getElementById('modalUsuarioTitle').textContent = 'Crear Usuario';

    // Habilitar el campo DNI para nuevo usuario
    document.getElementById('dni').disabled = false;

    // La contraseña es requerida para nuevos usuarios
    document.getElementById('contrasena').required = true;
    document.getElementById('confirmarContrasena').required = true;

    // Mostrar el modal
    const modal = document.getElementById('modalUsuario');
    modal.classList.remove('hidden', 'opacity-0');
    modal.classList.add('opacity-100');

    /*document.getElementById('usuarioForm').reset(); // Limpiar los campos del formulario
    document.getElementById('dni').disabled = false; // Habilitar el campo del DNI
    usuarioEnEdicion = null;
    const modal = document.getElementById('modalUsuario');
    modal.classList.remove('hidden', 'opacity-0');
    modal.classList.add('opacity-100');*/
}

// Cerrar modal al presionar "Esc"
document.addEventListener("keydown", function (event) {
    const modal = document.getElementById('modalUsuario'); // Asegurarse de obtener el modal correcto
    if (event.key === "Escape" && !modal.classList.contains("hidden")) {
        cerrarModal(); // Llama a la función para cerrar el modal
    }
});

// Función para cerrar el modal
function cerrarModal() {
    const modal = document.getElementById('modalUsuario'); // Cambié 'modal' por 'modalUsuario'
    modal.classList.add('hidden', 'opacity-0'); // Ocultar modal
    usuarioEnEdicion = null; // Reiniciar el estado de edición
}

// Event listener para cerrar el modal al hacer clic en "Cerrar"
document.querySelector('.closeModal').addEventListener('click', cerrarModal);

// Event listener para enviar el formulario (validación básica)
document.getElementById('usuarioForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const contrasena = document.getElementById('contrasena').value;
    const confirmarContrasena = document.getElementById('confirmarContrasena').value;
    //const dni = document.getElementById('dni').value;
    //const numero = document.getElementById('numero').value;

    
    //const contrasena = document.getElementById('contrasena').value;
    // Validar contraseña
    const regex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{10,}$/;

    if (!regex.test(contrasena)) {
        alert('La contraseña debe tener al menos 10 caracteres, incluir alfanuméricos y símbolos.');
        return;
    }

    // Validar confirmación de contraseña
    if (contrasena !== confirmarContrasena) {
        alert('Las contraseñas no coinciden.');
        return;
    }

    guardarUsuario(); // Llama a la función para manejar el envío
});

//Función para obtener todos los usuarios desde la base de datos
function obtenerUsuarios(pagina = 1) {
    const formData = new FormData();
    formData.append('accion', 'obtener');
    formData.append('pagina', pagina);

    fetch('../modelo/usuarios.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        usuarios = data.usuarios;
        totalPaginas = data.totalPaginas;
        paginaActual = data.paginaActual;
        renderUsuarios();
        renderPaginacion();
    })
    .catch(error => {
        console.error('Error al obtener usuarios:', error.message); // Mensaje de error
        console.error('Detalles completos del error:', error); // Muestra el objeto completo del error
    });
}


// Agrega la función para renderizar la paginación:
function renderPaginacion() {
    const paginacionDiv = document.getElementById('paginacion');
    paginacionDiv.innerHTML = '';
    
    // Botón anterior
    const btnAnterior = document.createElement('button');
    btnAnterior.innerText = 'Anterior';
    btnAnterior.classList.add('bg-blue-500', 'text-white', 'px-4', 'py-2', 'rounded', 'mr-2');
    btnAnterior.disabled = paginaActual === 1;
    btnAnterior.onclick = () => obtenerUsuarios(paginaActual - 1);
    
    // Botón siguiente
    const btnSiguiente = document.createElement('button');
    btnSiguiente.innerText = 'Siguiente';
    btnSiguiente.classList.add('bg-blue-500', 'text-white', 'px-4', 'py-2', 'rounded', 'ml-2');
    btnSiguiente.disabled = paginaActual === totalPaginas;
    btnSiguiente.onclick = () => obtenerUsuarios(paginaActual + 1);
    
    // Información de página actual
    const paginaInfo = document.createElement('span');
    paginaInfo.innerText = `Página ${paginaActual} de ${totalPaginas}`;
    paginaInfo.classList.add('mx-4');
    
    paginacionDiv.appendChild(btnAnterior);
    paginacionDiv.appendChild(paginaInfo);
    paginacionDiv.appendChild(btnSiguiente);
}

function renderUsuarios() {
    const tablaUsuarios = document.getElementById('usuariosTableBody');
    tablaUsuarios.innerHTML = ''; // Limpiar la tabla antes de agregar usuarios

    usuarios.forEach((usuario, index) => {
        const fila = document.createElement('tr');
        // Añadir la clase 'bg-gray-600' solo si el usuario no está activo
        // Y 'hover:bg-gray-700' siempre que el usuario esté activo o no
        fila.classList.add(usuario.activo ? 'hover:bg-teal-300' : 'bg-gray-400', 'text-black');//text-gray-400

        fila.innerHTML = `
            <td class="py-2 px-4">${usuario.nombre_usuario}</td>
            <td class="py-2 px-4">${usuario.rol}</td>
            <td class="py-2 px-4">${usuario.dni}</td>
            <td class="py-2 px-4">${usuario.correo}</td>
            <td class="py-2 px-4">${usuario.numero_telefono}</td>
            <td class="py-2 px-4 text-center">
                <button class="bg-blue-500 shadow-lg shadow-blue-500/50 text-white font-bold py-1 px-2 rounded" onclick="editarUsuario(${index})">Editar</button>
                <button class="bg-red-500 shadow-lg shadow-red-500/50 text-white font-bold py-1 px-2 rounded ml-2" onclick="confirmarEliminarUsuario(${index})">Eliminar</button>
                <button class="${usuario.activo ? 'bg-emerald-300' : 'bg-gray-500'} hover:bg-green-700 text-black font-bold py-1 px-2 rounded ml-2" onclick="cambiarEstadoUsuario(${index})">
                    ${usuario.activo ? 'Desactivar' : 'Activar'}
                </button>
            </td>
        `;
        //class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded

        tablaUsuarios.appendChild(fila);
    });
}

function cambiarEstadoUsuario(index) {
    // Cambiar el estado del usuario (activar o desactivar)
    usuarios[index].activo = !usuarios[index].activo;
    renderUsuarios(); // Volver a renderizar los usuarios para reflejar el cambio visual
}

// Función para crear o editar un usuario
function guardarUsuario() {
    const formData = new FormData();
    const nombreUsuario = document.getElementById('nombreUsuario').value;
    const contrasena = document.getElementById('contrasena').value;
    const rol = document.getElementById('rol').value;
    const dni = document.getElementById('dni').value;
    const correo = document.getElementById('correo').value;
    const numero = document.getElementById('numero').value;

    // Crear un objeto FormData con los valores del formulario
    //const formData = new FormData();
    formData.append('nombreUsuario', nombreUsuario);
    formData.append('contrasena', contrasena);
    formData.append('rol', rol);
    formData.append('dni', dni);
    formData.append('correo', correo);
    formData.append('numero', numero);

    /* Solo incluir la contraseña si se está creando un nuevo usuario o si se ha ingresado una nueva contraseña en edición
    if (!usuarioEnEdicion || contrasena.length > 0) {
        formData.append('contrasena', contrasena);
    }*/

    // Si estamos editando un usuario, agregar el ID y cambiar la acción
    if (usuarioEnEdicion !== null) {
        // Modo edición
        formData.append('accion', 'editar');
        formData.append('id', usuarios[usuarioEnEdicion].id);
        // Solo incluir la contraseña si se ha ingresado una nueva
        if (contrasena.trim() !== '') {
            formData.append('contrasena', contrasena);
        }
    } else {
        // Modo creación
        formData.append('accion', 'crear');
        formData.append('contrasena', contrasena);
    }

    // Enviar los datos al servidor
    fetch('../modelo/usuarios.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            cerrarModal();
            obtenerUsuarios(); // Recargar la lista de usuarios
        }
    })
    .catch(error => console.error('Error al guardar usuario:', error));
}

// Función para cargar los datos del usuario seleccionado en el formulario y habilitar la edición
function editarUsuario(index) {
    const usuario = usuarios[index];
    usuarioEnEdicion = index;

    // Actualizar el título del modal
    document.getElementById('modalUsuarioTitle').textContent = 'Editar Usuario';

    document.getElementById('nombreUsuario').value = usuario.nombre_usuario;
    document.getElementById('contrasena').value = ''; // Dejar vacío por seguridad
    document.getElementById('confirmarContrasena').value = ''; // También vacío
    document.getElementById('rol').value = usuario.rol;
    document.getElementById('dni').value = usuario.dni;
    document.getElementById('dni').disabled = true; // Deshabilitar el DNI al editar
    document.getElementById('correo').value = usuario.correo;
    document.getElementById('numero').value = usuario.numero_telefono;

    // En modo edición, la contraseña y su confirmación son opcionales
    document.getElementById('contrasena').required = false;
    document.getElementById('confirmarContrasena').required = false;

    // Mostrar el modal
    const modal = document.getElementById('modalUsuario');
    modal.classList.remove('hidden', 'opacity-0');
    modal.classList.add('opacity-100');
    
    /*usuarioEnEdicion = index;
    document.getElementById('modalUsuarioTitle').textContent = 'Editar Usuario';
    abrirModal();*/
}

// Función para confirmar la eliminación de un usuario
function confirmarEliminarUsuario(index) {
    if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
        eliminarUsuario(index);
    }
}

// Función para eliminar un usuario
function eliminarUsuario(index) {
    const id = usuarios[index].id;

    fetch('../modelo/usuarios.php', {
        method: 'POST',
        body: new URLSearchParams({ accion: 'eliminar', id: id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            obtenerUsuarios(); // Recargar la lista de usuarios
        }
    })
    .catch(error => console.error('Error al eliminar usuario:', error));
}

// Función para activar o desactivar un usuario
function cambiarEstadoUsuario(index) {
    const usuario = usuarios[index];
    const nuevoEstado = usuario.activo == 1 ? 0 : 1; // Cambiar el estado
    //const nuevoEstado = usuario.activo ? 0 : 1; // Cambiar el estado

    fetch('../modelo/usuarios.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            accion: 'activar_desactivar',
            id: usuario.id,
            activo: nuevoEstado
        })
    })
    
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            usuario.activo = nuevoEstado; // Actualizar el estado en el array local
            renderUsuarios(); // Volver a renderizar la tabla
            //obtenerUsuarios(); // Recargar la lista de usuarios
        }
    })
    .catch(error => console.error('Error al cambiar estado del usuario:', error));
}

// Evento para cargar los usuarios al inicio
document.addEventListener("DOMContentLoaded", obtenerUsuarios);