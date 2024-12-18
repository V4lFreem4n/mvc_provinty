<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Gestión de Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/heroicons@2.0.0/dist/heroicons.js"></script>
</head>

<body class="bg-gray-900 text-white">

    <!-- Header con el logo y el título -->
    <header class="bg-gray-800 py-4">
        <div class="container mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="../vista/admin/gestionUsuarios/img/logo.png" alt="Logo" class="h-20 w-auto ml-6">
                <h1 class="text-3xl font-bold text-white">Gestión de Usuarios</h1>
            </div>
        </div>
    </header>

    <div class="container mx-auto p-4">
        <button id="crearUsuarioBtn"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4">
            Crear Usuario
        </button>

        <!-- Contenedor que hace la tabla desplazable en pantallas pequeñas -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-800 text-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-700">Foto</th>
                        <th class="py-2 px-4 border-b border-gray-700">Nombre de Usuario</th>
                        <th class="py-2 px-4 border-b border-gray-700">Correo</th>
                        <th class="py-2 px-4 border-b border-gray-700">Contraseña</th>
                        <th class="py-2 px-4 border-b border-gray-700">Rol</th>
                        <th class="py-2 px-4 border-b border-gray-700">DNI</th>
                        <th class="py-2 px-4 border-b border-gray-700">Número</th>
                        <th class="py-2 px-4 border-b border-gray-700">Acciones</th>
                    </tr>
                    
                </thead>
                <tbody id="usuariosTableBody" class="bg-gray-700">
                
                        <?php
                        foreach($usuarios as $usuario){
                            echo '<tr class="py-2 px-4 border-b border-gray-700 text-center"><td><img src="" alt="Foto" class="h-12 w-12 rounded-full object-cover"></td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">'.$usuario['Nombre'].' '.$usuario['Apellido'].'</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">correo no disponible</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">********</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">'.$usuario['Rol'].'</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">'.$usuario['DNI'].'</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">numero no disponible</td>
                <td class="py-2 px-4 border-b border-gray-700 text-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2" onclick="editarUsuario('.$usuario['ID_Usuario'].')">Editar</button>
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="confirmarEliminarUsuario('.$usuario['ID_Usuario'].')">Eliminar</button>
                    <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded" onclick="toggleEstadoUsuario('.$usuario['ID_Usuario'].')">${usuario.activo ? "Desactivar" : "Activar"}</button>
                </tr>';
                        }
                        ?>
                    
                </tbody>
            </table>
        </div>

        <!-- Modal para crear/editar usuario -->
        <div id="modalUsuario"
            class="fixed z-10 inset-0 hidden overflow-y-auto transition-opacity duration-300 ease-in-out opacity-0">
            <!--<div id="modalUsuario" class="fixed z-10 inset-0 hidden overflow-y-auto"> -->
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full mx-auto">
                    <h2 class="text-xl font-bold mb-4 text-gray-900" id="modalUsuarioTitle">Crear Usuario</h2>
                    <form id="usuarioForm" class="space-y-4" action="../controlador/Usuario/controladorCrearUsuario.php" method="POST">
    <div>
        <label for="nombreUsuario" class="block text-gray-700 font-bold">Nombre de Usuario</label>
        <input type="text" id="nombreUsuario" name="nombreUsuario" class="w-full border rounded py-2 px-3 text-gray-900" required>
    </div>
    <div>
        <label for="contrasena" class="block text-gray-700 font-bold">Contraseña</label>
        <input type="password" id="contrasena" name="contrasena" class="w-full border rounded py-2 px-3 text-gray-900" required>
    </div>
    <div>
        <label for="rol" class="block text-gray-700 font-bold">Rol</label>
        <select id="rol" name="rol" class="w-full border rounded py-2 px-3 text-gray-900" required>
            <option value="Administrador">Administrador</option>
            <option value="Promotor">Promotor</option>
        </select>
    </div>
    <div>
        <label for="dni" class="block text-gray-700 font-bold">DNI</label>
        <input type="text" id="dni" name="dni" class="w-full border rounded py-2 px-3 text-gray-900" maxlength="8" required>
    </div>
    <div>
        <label for="correo" class="block text-gray-700 font-bold">Correo</label>
        <input type="email" id="correo" name="correo" class="w-full border rounded py-2 px-3 text-gray-900" required>
    </div>
    <div>
        <label for="numero" class="block text-gray-700 font-bold">Número</label>
        <input type="text" id="numero" name="numero" class="w-full border rounded py-2 px-3 text-gray-900" maxlength="9" required>
    </div>
    <div>
        <label for="foto" class="block text-gray-700 font-bold">Subir Foto</label>
        <input type="file" id="foto" name="foto" accept="image/*" class="w-full border rounded py-2 px-3 text-gray-900" required>
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

    <script src="../vista/admin/gestionUsuarios/scripts.js"></script>

</body>

</html>