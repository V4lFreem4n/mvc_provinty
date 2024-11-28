<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle - Informe de Eventos</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/js/all.min.js"></script>
</head>
<body class="font-sans bg-gray-100 text-gray-800">
  <header class="bg-[#004f63] text-white py-5 px-8 flex items-center justify-between">
    <div class="flex items-center">
      <img src="../vista/admin/informe/img/logo_provint.png" alt="Logo" class="h-12 mr-4">
      <h1 class="text-2xl font-bold">DETALLE - INFORME DE EVENTOS</h1>
    </div>
    <button class="bg-white text-[#004f63] px-4 py-2 rounded-md flex items-center">
      <i class="fas fa-download mr-2"></i> DESCARGAR TODO
    </button>
  </header>

  <main class="px-8 py-10">
    <div class="bg-white shadow-md rounded-lg p-6 mb-8 grid grid-cols-3 gap-4">
      <div>
        <h2 class="text-[#004f63] font-bold text-xl mb-2">CLIENTE</h2>
      </div>
      <div>
        <p class="mb-4">Descripción del comentario</p>
      </div>
      <div class="flex flex-col items-end">
        <button class="bg-[#004f63] text-white px-4 py-2 rounded-md flex items-center mb-2">
          <i class="fas fa-download mr-2"></i> DESCARGAR
        </button>
        <div class="flex items-center text-xl text-orange-500">
          <i class="fas fa-star mr-1"></i>
          <i class="fas fa-star mr-1"></i>
          <i class="fas fa-star mr-1"></i>
          <i class="fas fa-star mr-1"></i>
          <i class="fas fa-star mr-1"></i>
        </div>
      </div>
    </div>

    <!-- Más secciones de eventos -->
  </main>

<!--
<footer class="bg-[#004f63] text-white py-4 text-center">
    <div class="flex justify-center">
      <a href="#" class="text-white px-2 hover:bg-[#006a80] rounded-md">1</a>
      <a href="#" class="text-white px-2 hover:bg-[#006a80] rounded-md">2</a>
    </div>
  </footer>  
-->
</body>
</html>

