<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/heroicons@2.0.0/dist/heroicons.js"></script>
</head>

<body class="bg-gray-300 text-black">
    <!-- Header con el logo y el título -->
    <header class="bg-slate-800 py-4">
        <div class="container mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="../vista/admin/gestionUsuarios/img/logo_provint.png" alt="Logo" class="h-20 w-auto ml-6">
                <h1 class="text-3xl font-bold text-white">Gestión de Usuarios</h1>
            </div>
        </div>
    </header>

    <div class="container mx-auto p-4 sm:px-6 lg:px-8">
        
        <!-- Botón para abrir el modal y crear un nuevo usuario -->
        <button onclick="abrirModal()" class="bg-emerald-300 shadow-lg shadow-emerald-500/50 text-black font-bold py-2 px-4 rounded mb-4">Crear Usuario</button>
        <!-- </button>class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4">Crear Usuario</button> -->

        <!-- Tabla de usuarios -->
        <table class="table-auto w-full mb-6 text-center">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-700">Nombre de Usuario</th>
                    <th class="py-2 px-4 border-b border-gray-700">Rol</th>
                    <th class="py-2 px-4 border-b border-gray-700">DNI</th>
                    <th class="py-2 px-4 border-b border-gray-700">Correo Electrónico</th>
                    <th class="py-2 px-4 border-b border-gray-700">Número de Teléfono</th>
                    <th class="py-2 px-4 border-b border-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody id="usuariosTableBody"  class="text-black">
                <!-- Los datos se renderizarán aquí -->
            </tbody>
        </table>
        <!-- Agregar el contenedor de paginación -->
        <div id="paginacion" class="flex justify-center items-center mt-4">
        <!-- Los botones de paginación se renderizarán aquí -->
        </div>
    </div>

    <!-- Modal para crear/editar usuario -->
    <div id="modalUsuario" class="fixed z-10 inset-0 hidden overflow-y-auto transition-opacity duration-300 ease-in-out opacity-0">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full mx-auto">
                <h2 class="text-xl font-bold mb-4 text-gray-900" id="modalUsuarioTitle">Crear Usuario</h2>
                <form id="usuarioForm" class="space-y-4">
                        <div>
                            <label for="nombreUsuario" class="block text-gray-700 font-bold">Nombre de Usuario</label>
                            <input type="text" id="nombreUsuario" class="w-full border rounded py-2 px-3 text-gray-900" required>
                        </div>
                        <div>
                            <label for="contrasena" class="block text-gray-700 font-bold">Contraseña</label>
                            <input type="password" id="contrasena" class="w-full border rounded py-2 px-3 text-gray-900" required>
                        </div>
                        <div>
                            <label for="confirmarContrasena" class="block text-gray-700 font-bold">Confirmar Contraseña</label>
                            <input type="password" id="confirmarContrasena" class="w-full border rounded py-2 px-3 text-gray-900" required>
                        </div>
                        <div>
                            <label for="rol" class="block text-gray-700 font-bold">Rol</label>
                            <select id="rol" class="w-full border rounded py-2 px-3 text-gray-900" required>
                                <option value="0">Superadministrador</option>
                                <option value="1">Administrador</option>
                                <option value="2">Promotor</option>                                
                            </select>
                        </div>
                        <div>
                            <label for="dni" class="block text-gray-700 font-bold">DNI</label>
                            <input type="text" id="dni" class="w-full border rounded py-2 px-3 text-gray-900" 
                                   pattern="\d{8}" minlength="8" maxlength="8" required 
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                   title="El DNI debe tener exactamente 8 dígitos">
                        </div>
                        <!-- <div>
                            <label for="dni" class="block text-gray-700 font-bold">DNI</label>
                            <input type="text" id="dni" class="w-full border rounded py-2 px-3 text-gray-900" maxlength="8" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div> -->
                        <div>
                            <label for="correo" class="block text-gray-700 font-bold">Correo</label>
                            <input type="email" id="correo" class="w-full border rounded py-2 px-3 text-gray-900" required>
                        </div>
                        <div>
                            <label for="numero" class="block text-gray-700 font-bold">Número</label>
                            <input type="text" id="numero" class="w-full border rounded py-2 px-3 text-gray-900" 
                                   pattern="9\d{8}" minlength="9" maxlength="9" required 
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                   title="El número debe comenzar con 9 y tener 9 dígitos">
                        </div>
                        <!--<div>
                            <label for="numero" class="block text-gray-700 font-bold">Número</label>
                            <input type="text" id="numero" class="w-full border rounded py-2 px-3 text-gray-900" maxlength="9" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>-->
                        <div>
                            <label for="foto" class="block text-gray-700 font-bold">Subir Foto</label>
                            <input type="file" id="foto" accept="image/*" class="w-full border rounded py-2 px-3 text-gray-900">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
                        </div>
                    </form>
                    <button class="closeModal mt-4 text-red-500 font-bold">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../vista/admin/gestionUsuarios/scripts.js" defer></script> <!-- Tu archivo JavaScript -->
</body>
</html>


