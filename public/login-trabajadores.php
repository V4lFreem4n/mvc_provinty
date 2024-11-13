<?php
 
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <style>
        .header-bg {
            background: linear-gradient(135deg, #1a365d 0%, #2563eb 100%);
            border-radius: 0.5rem 0.5rem 4rem 4rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .logo-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 1rem;
            padding: 0.5rem;
        }

        .cursor-effect {
            position: absolute;
            width: 5px;
            height: 5px;
            background-color: white;
            border-radius: 50%;
            animation: star-twinkle 1s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes star-twinkle {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(2); opacity: 0.5; }
            100% { transform: scale(1); opacity: 0; }
        }

        .shape-1, .shape-2 {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .shape-1 {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            top: 20%;
            left: 10%;
            animation: shape-move 10s linear infinite;
        }

        .shape-2 {
            width: 50px;
            height: 50px;
            transform: rotate(45deg);
            bottom: 10%;
            right: 15%;
            animation: shape-move 8s linear infinite;
        }

        @keyframes shape-move {
            0% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(20px, 20px) rotate(180deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-900 via-blue-600 to-green-500 flex items-center justify-center min-h-screen p-4">
    <div class="container bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <!-- Header Section with Logo and Title -->
        <div class="header-bg p-6 mb-8 relative">
            <div class="flex items-center justify-between">
                <div class="logo-container">
                    <img src="../vista/admin/gestionUsuarios/img/logo_provint.png" alt="Company Logo" class="h-12 w-auto"/>
                </div>
                <h1 class="text-2xl font-bold text-white tracking-wider transform hover:scale-105 transition-transform duration-300 sm:text-3xl">
                    INICIAR SESIÓN
                </h1>
            </div>
        </div>


        <?php if ($error): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">

            <p><?php echo $error; ?></p>
        </div>
    <?php endif; ?>


        <!-- Login Form -->
        <div class="px-8 pb-8">
            

            <form action="../controlador/Usuario/login/validar_login.php" method="POST">
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>Credencial
                    </label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-2 border-b-2 border-gray-300 focus:border-blue-500 outline-none transition-colors duration-300"
                           placeholder="Ingrese tu correo electrónico">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Contraseña
                    </label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2 border-b-2 border-gray-300 focus:border-blue-500 outline-none transition-colors duration-300"
                           placeholder="Ingrese tu contraseña">
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                         
                    </div>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-300">
                        ¿Olvidó su contraseña?
                    </a>
                </div>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold py-3 px-4 rounded-full hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:shadow-outline transform hover:scale-105 transition-all duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i>LOGIN
                </button>
            </form>
        </div>
    </div>

    <div class="shape-1"></div>
    <div class="shape-2"></div>

    <script>
        document.addEventListener('mousemove', (e) => {
            const cursor = document.createElement('div');
            cursor.classList.add('cursor-effect');
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
            document.body.appendChild(cursor);
            setTimeout(() => {
                cursor.remove();
            }, 1000);
        });
    </script>
</body>
</html>