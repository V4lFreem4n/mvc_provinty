<?php
 
  // Imprime la información de la sesión para ver si contiene los datos esperados.
 

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login-trabajadores.php");
    //header("Location: X");
    exit();
}

// Conexión a la base de datos
//$conexion = new mysqli("localhost", "victor", "victor", "provintybd");

//if ($conexion->connect_error) {
    //die("Error de conexión: " . $conexion->connect_error);
//}
/*
// Obtener información del usuario
$usuario_id = $_SESSION['usuario_id'];
$query = "SELECT nombre_usuario, rol, foto_url FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
*/

// Definir acceso según rol
$accesos = [
    'superadministrador' => ['resumen', 'informes', 'eventos', 'usuarios'],//'superadministrador'
    'administrador' => ['resumen', 'informes', 'eventos'], //'administrador'
    'promotor' => ['eventos'] //'promotor'
];

$menu_items = $accesos[$_SESSION['rol']];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provinti-Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            width: 250px;
        }
        
        .show {
            display: block;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
        
        .menu-item {
            transition: all 0.3s ease;
        }
        
        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-b from-teal-900 to-teal-700">
    <!-- Encabezado -->
    <header class="bg-teal-800 p-4 shadow-lg">
        <nav class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="../vista/admin/gestionUsuarios/img/logo_provint.png" alt="Logo" class="h-20 w-auto ml-6">
            </div>
            <div class="flex items-center space-x-6">
                <?php foreach ($menu_items as $item): ?>
                    <a href="#" class="menu-item text-white hover:text-teal-200 px-3 py-2 uppercase">
                        <?php echo ucfirst($item); ?>
                    </a>
                <?php endforeach; ?>
                
                <!-- Barra de búsqueda -->
                <div class="relative">
                    <input type="search" class="bg-teal-700 text-white rounded-full py-1 px-4 focus:outline-none focus:ring-2 focus:ring-teal-300 w-48" placeholder="Buscar...">
                </div>
                
                <!-- Icono de notificación -->
                <button class="text-white hover:text-teal-200 relative">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">3</span>
                </button>
                
                <!-- Icono de usuario con dropdown -->
                <div class="relative">
                    <button id="userDropdown" class="text-white hover:text-teal-200 flex items-center space-x-2">
                        <?php //if ($usuario['foto_url']): ?>
                            <img src="<?php //echo htmlspecialchars($usuario['foto_url']); ?>" alt="Perfil" class="w-8 h-8 rounded-full">
                        <?php //else: ?>
                            <i class="fas fa-user-circle text-2xl"></i>
                        <?php //endif; ?>
                    </button>
                    
                    <!-- Dropdown menu -->
                    <div id="userMenu" class="dropdown bg-white rounded-lg shadow-xl p-4" style="z-index: 100;">
                        <div class="flex items-center space-x-3 border-b pb-3">
                            <?php //if ($usuario['foto_url']): ?>
                                <img src="<?php //echo htmlspecialchars($usuario['foto_url']); ?>" alt="Perfil" class="w-12 h-12 rounded-full">
                            <?php //else: ?>
                                <i class="fas fa-user-circle text-4xl text-teal-700"></i>
                            <?php //endif; ?>
                            <div>
                                <p class="font-semibold text-gray-800"><?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
                                <p class="text-sm text-gray-600"><?php echo ucfirst($_SESSION['rol']); ?></p>
                            </div>
                        </div>
                        <div class="mt-3 space-y-2">
                            <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-teal-600 py-2">
                                <i class="fas fa-user-cog"></i>
                                <span>Perfil</span>
                            </a>
                            <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-teal-600 py-2">
                                <i class="fas fa-cog"></i>
                                <span>Configuración</span>
                            </a>
                            <hr class="my-2">
                            <a href="../controlador/Usuario/logout.php" class="flex items-center space-x-2 text-red-600 hover:text-red-700 py-2">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Cerrar Sesión</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenido principal -->
    <main class="max-w-7xl mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (in_array('resumen', $menu_items)): ?>
            <!-- Tarjeta de resumen -->
            <div class="bg-white bg-opacity-10 rounded-lg p-6 col-span-1 row-span-2 card-hover backdrop-blur-sm">
                <div class="h-full flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-2 mb-4">
                            <i class="fas fa-chart-line text-2xl text-white"></i>
                            <h2 class="text-2xl font-bold text-white">RESUMEN</h2>
                        </div>
                        <p class="text-teal-100 mb-4">
                            Obtén una visión general de los eventos, usuarios y más con estadísticas en la bitácora digital.
                        </p>
                    </div>
                    <button class="bg-white text-teal-700 px-6 py-2 rounded-full w-max hover:bg-teal-50 transition-colors flex items-center space-x-2">
                        <span>Acceder</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <?php endif; ?>

            <?php if (in_array('informes', $menu_items)): ?>
            <!-- Tarjeta de informes -->
            <div class="bg-white bg-opacity-10 rounded-lg p-6 col-span-1 md:col-span-2 card-hover backdrop-blur-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="flex items-center space-x-2 mb-4">
                            <i class="fas fa-file-alt text-2xl text-white"></i>
                            <h2 class="text-2xl font-bold text-white">INFORMES</h2>
                        </div>
                        <p class="text-teal-100 mb-4">
                            Accede a información detallada sobre el rendimiento de tus eventos, ingresos por ventas y análisis de datos.
                        </p>
                    </div>
                    <button class="bg-white text-teal-700 px-6 py-2 rounded-full border border-teal-700 hover:bg-teal-700 hover:text-white transition-colors flex items-center space-x-2">
                        <span>Acceder</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <?php endif; ?>

            <?php if (in_array('eventos', $menu_items)): ?>
            <!-- Tarjeta de eventos -->
            <div class="bg-white bg-opacity-10 rounded-lg p-6 card-hover backdrop-blur-sm">
                <div class="flex items-center space-x-2 mb-4">
                    <i class="fas fa-calendar-alt text-2xl text-white"></i>
                    <h2 class="text-2xl font-bold text-white">EVENTOS</h2>
                </div>
                <p class="text-teal-100 mb-4">
                    Gestiona todos los aspectos relacionados con los eventos: descripción, precios de boletos y más.
                </p>
                <button class="bg-white text-teal-700 px-6 py-2 rounded-full hover:bg-teal-50 transition-colors flex items-center space-x-2">
                    <span><a href="./admin-crear-evento.php">Acceder</a></span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
            <?php endif; ?>

            <?php if (in_array('usuarios', $menu_items)): ?>
            <!-- Tarjeta de usuarios -->
            <div class="bg-white bg-opacity-10 rounded-lg p-6 card-hover backdrop-blur-sm">
                <div class="flex items-center space-x-2 mb-4">
                    <i class="fas fa-users text-2xl text-white"></i>
                    <h2 class="text-2xl font-bold text-white">USUARIOS</h2>
                </div>
                <p class="text-teal-100 mb-4">
                    Administra las cuentas de los usuarios, incluyendo clientes, organizadores de eventos y personal administrativo.
                </p>
                <button class="bg-white text-teal-700 px-6 py-2 rounded-full border border-teal-700 hover:bg-teal-700 hover:text-white transition-colors flex items-center space-x-2">
                    <span>Acceder</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sección de bienvenida -->
        <div class="mt-8 text-center text-white">
            <h3 class="text-xl mb-2">¡Te damos la bienvenida, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h3>
            <p class="text-teal-100 mb-4">
                Aquí podrás gestionar tus eventos, revisar informes y controlar las ventas de manera eficiente.
            </p>
            <button class="bg-teal-500 text-white px-8 py-3 rounded-full hover:bg-teal-400 transition-colors flex items-center mx-auto">
                <i class="fas fa-edit mr-2"></i>
                Empieza aquí
            </button>
        </div>
    </main>

    <script>
        // Toggle dropdown menu
        const userDropdown = document.getElementById('userDropdown');
        const userMenu = document.getElementById('userMenu');

        userDropdown.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenu.classList.toggle('show');
        });

        // Cerrar el dropdown cuando se hace clic fuera
        document.addEventListener('click', (e) => {
            if (!userDropdown.contains(e.target) && !userMenu.contains(e.target)) {
                userMenu.classList.remove('show');
            }
        });
    </script>
</body>
</html>
