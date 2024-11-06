<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
  <style>
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
      0% {
        transform: scale(1);
        opacity: 1;
      }
      50% {
        transform: scale(2);
        opacity: 0.5;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    .blur-bg {
      filter: blur(5px);
    }

    .shape-1 {
      position: absolute;
      width: 100px;
      height: 100px;
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      top: 20%;
      left: 10%;
      animation: shape-move 10s linear infinite;
    }

    .shape-2 {
      position: absolute;
      width: 50px;
      height: 50px;
      background-color: rgba(255, 255, 255, 0.2);
      transform: rotate(45deg);
      bottom: 10%;
      right: 15%;
      animation: shape-move 8s linear infinite;
    }

    @keyframes shape-move {
      0% {
        transform: translate(0, 0);
      }
      50% {
        transform: translate(20px, 20px);
      }
      100% {
        transform: translate(0, 0);
      }
    }

    @media (max-width: 767px) {
      .container {
        padding: 1rem;
      }
    }
  </style>
</head>
<body class="bg-gradient-to-r from-blue-500 to-green-500 flex items-center justify-center h-screen relative overflow-hidden">
    <div class="container bg-white rounded-lg shadow-lg p-8 w-full max-w-md relative">
      <img src="img/logo_provint.png" alt="Company Logo" class="absolute top-4 left-4 w-12 h-12" />
      <h1 class="text-2xl font-bold mb-6 text-center sm:text-3xl">INICIAR SESIÓN</h1>
      <form action="../controlador/Usuario/controladorVerificarUsuario.php" method="post">
        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-bold mb-2">
            <i class="fas fa-envelope mr-2"></i>Usuario
          </label>
          <input type="text" id="email" name="usuario" class="shadow appearance-none border-b border-gray-300 focus:border-blue-500 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingresar su credencial">
        </div>
        <div class="mb-4">
          <label for="password" class="block text-gray-700 font-bold mb-2">
            <i class="fas fa-lock mr-2"></i>Contaseña
          </label>
          <input type="password" id="password" name="password" class="shadow appearance-none border-b border-gray-300 focus:border-blue-500 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingresar su contraseña">
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300 rounded">
            <label for="remember" class="ml-2 text-gray-700">Recuérdame</label>
          </div>
          <a href="#" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">¿Olvidó su contraseña?</a>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline w-full mt-4 flex items-center justify-center">
          <i class="fas fa-sign-in-alt mr-2"></i>INICIAR SESIÓN
        </button>
      </form>
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