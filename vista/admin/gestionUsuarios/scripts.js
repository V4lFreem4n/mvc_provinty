document.addEventListener("DOMContentLoaded", function () {
    const crearUsuarioBtn = document.getElementById("crearUsuarioBtn");
    const modal = document.getElementById("modalUsuario");
    const modalUsuarioTitle = document.getElementById("modalUsuarioTitle");
    const usuarioForm = document.getElementById("usuarioForm");
    const usuariosTableBody = document.getElementById("usuariosTableBody");
    const dniInput = document.getElementById("dni");
    const fotoInput = document.getElementById("foto");
    let usuarioEnEdicion = null;
    let usuarios = [];


    /*function mostrarError(campo, mensaje) {
        const errorElem = document.getElementById(campo.id + 'Error');
        if (errorElem) {
            errorElem.textContent = mensaje;
            errorElem.classList.remove('hidden');
        }
        campo.focus();
    }*/
    // Función para mostrar errores en campos específicos
    function mostrarError(campo, mensaje) {
        alert(mensaje);
        campo.focus();
        return;
    }

    // Cerrar modal al presionar "Esc"
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape" && !modal.classList.contains("hidden")) {
            modal.classList.add("hidden");
        }
    });

    // Función para cerrar el modal
    document.querySelectorAll(".closeModal").forEach(button => {
        button.addEventListener("click", function () {
            modal.classList.add("hidden");
        });
    });

    // Función para confirmar la eliminación de un usuario
    window.confirmarEliminarUsuario = function (index) {
        if (confirm("¿Desea eliminar el usuario?")) {
            usuarios.splice(index, 1); // Eliminar usuario
            renderUsuarios();
            alert("Usuario eliminado correctamente.");
        } else {
            alert("Usuario no eliminado.");
        }
    };

    // Función para activar/desactivar usuario
    window.toggleEstadoUsuario = function (index) {
        const usuario = usuarios[index];
        usuario.activo = !usuario.activo;  // Cambiar el estado de activo/inactivo
        console.log("Se está renderizando al usuario")
        renderUsuarios();
    };

    // Función para abrir el modal para crear un usuario
    crearUsuarioBtn.addEventListener("click", function () {
        modal.classList.remove("hidden");
        setTimeout(() => {
            modal.classList.add("opacity-100");
        }, 10);
        modalUsuarioTitle.textContent = "Crear Usuario";
        usuarioEnEdicion = null;
        //usuarioForm.reset();
        dniInput.disabled = false;  // Habilitar el campo de DNI al crear
    });

    // Validaciones para DNI y Número
    document.getElementById("dni").addEventListener("input", function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    document.getElementById("numero").addEventListener("input", function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 0 && this.value[0] !== '9') this.value = '9' + this.value.slice(1);
    });

    // Manejar el formulario de usuario
    /*usuarioForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const nombreUsuario = document.getElementById("nombreUsuario").value;
        const contrasena = document.getElementById("contrasena").value;
        const rol = document.getElementById("rol").value;
        const dni = dniInput.value;
        const correo = document.getElementById("correo").value;
        const numero = document.getElementById("numero").value;

        // Validaciones de formato
        if (dni.length !== 8) {
            mostrarError(dniInput, "El DNI debe contener 8 dígitos numéricos.");
            return;
        }
        if (numero.length !== 9 || numero[0] !== '9') {
            mostrarError(document.getElementById("numero"), "El número debe comenzar con '9' y tener 9 dígitos.");
            return;
        }
        if (!/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Za-z]).{10,}/.test(contrasena)) {
            mostrarError(document.getElementById("contrasena"), "La contraseña debe tener al menos 10 caracteres, incluyendo un número, una letra y un símbolo.");
            return;
        }

        // Verificar duplicados (DNI, correo, número o nombre de usuario) solo al crear
        if (usuarioEnEdicion === null) {
            const esDuplicado = usuarios.some(u =>
                u.dni === dni || u.correo === correo || u.numero === numero || u.nombreUsuario === nombreUsuario
            );
            if (esDuplicado) {
                mostrarError(document.getElementById("correo"), "Ya existe un usuario con el mismo DNI, correo, número o nombre de usuario.");
                return;
            }
        } else {
            const esDuplicadoEdicion = usuarios.some((u, index) =>
                index !== usuarioEnEdicion &&
                (u.correo === correo || u.numero === numero || u.nombreUsuario === nombreUsuario)
            );
            if (esDuplicadoEdicion) {
                mostrarError(document.getElementById("correo"), "Ya existe un usuario con el mismo correo, número o nombre de usuario.");
                return;
            }
        }



        const fotoURL = fotoInput.files.length > 0 ? URL.createObjectURL(fotoInput.files[0]) : '';

        // Agregar o editar usuario
        if (usuarioEnEdicion === null) {
            const nuevoUsuario = { id: Date.now(), nombreUsuario, contrasena, rol, dni, correo, numero, fotoURL };
            usuarios.push(nuevoUsuario);
        } else {
            usuarios[usuarioEnEdicion] = { ...usuarios[usuarioEnEdicion], nombreUsuario, contrasena, rol, correo, numero, fotoURL };
        }

        modal.classList.add("hidden");
        //renderUsuarios();
    });
*/
    // Renderizar la tabla de usuarios
    function renderUsuarios() {
        console.log("Acá debe de aparecernos una nueva fila con el usuario")
        usuariosTableBody.innerHTML = "";
        usuarios.forEach((usuario, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td class="py-2 px-4 border-b border-gray-700 text-center"><img src="${usuario.fotoURL}" alt="Foto" class="h-12 w-12 rounded-full object-cover"></td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">${usuario.nombreUsuario}</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">${usuario.correo}</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">********</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">${usuario.rol}</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">${usuario.dni}</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">${usuario.numero}</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2" onclick="editarUsuario(${index})">Editar</button>
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="confirmarEliminarUsuario(${index})">Eliminar</button>
                    <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded" onclick="toggleEstadoUsuario(${index})">${usuario.activo ? "Desactivar" : "Activar"}</button>
                </td>
            `;
            usuariosTableBody.appendChild(row);
        });
    }


    /* Renderizar la tabla de usuarios
    function renderUsuarios() {
        usuariosTableBody.innerHTML = "";
        usuarios.forEach((usuario, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td class="py-2 px-4 border-b border-gray-700 text-center"><img src="${usuario.fotoURL}" alt="Foto" class="h-12 w-12 rounded-full object-cover"></td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">${usuario.nombreUsuario}</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">${usuario.correo}</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">********</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">${usuario.rol}</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">${usuario.dni}</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">${usuario.numero}</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2" onclick="editarUsuario(${index})">Editar</button>
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="eliminarUsuario(${index})">Eliminar</button>
                </td>
            `;
            usuariosTableBody.appendChild(row);
        });
    }*/

    // Función para editar usuario
    window.editarUsuario = function (index) {
        usuarioEnEdicion = index;
        const usuario = usuarios[index];
        document.getElementById("nombreUsuario").value = usuario.nombreUsuario;
        document.getElementById("contrasena").value = usuario.contrasena;
        document.getElementById("rol").value = usuario.rol;
        dniInput.value = usuario.dni;
        dniInput.disabled = true; // Deshabilitar el campo de DNI
        document.getElementById("correo").value = usuario.correo;
        document.getElementById("numero").value = usuario.numero;
        modal.classList.remove("hidden");
        modalUsuarioTitle.textContent = "Editar Usuario";
    };

    // Función para eliminar usuario
    window.eliminarUsuario = function (index) {
        usuarios.splice(index, 1);
        renderUsuarios();
    };
    // Crear el objeto de datos
    const usuarioData = {
        nombreUsuario,
        contrasena,
        rol,
        dni,
        correo,
        numero
    };

    // Realizar una solicitud POST a la API para guardar el usuario
   /**
    *  fetch("guardar-usuario.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(usuarioData)
    })
        .then(response => {
            if (response.ok) {
                alert("Usuario guardado correctamente");
                modal.classList.add("hidden");
                renderUsuarios();  // Renderizar usuarios nuevamente tras la actualización
            } else {
                alert("Error al guardar el usuario");
            }
        })
        .catch(error => {
            console.error("Error al realizar la solicitud:", error);
            alert("Error al guardar el usuario");
        });
   */
});







