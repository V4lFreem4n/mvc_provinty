<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informe de Eventos</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</head>
<body class="font-sans bg-gray-100 text-gray-800">
  <header class="bg-[#004f63] text-white py-5 px-8 flex items-center justify-between">
    <div class="flex items-center">
      <img src="../vista/admin/informe/img/logo_provint.png" alt="Logo" class="h-12 mr-4">
      <h1 class="text-2xl font-bold">INFORME DE EVENTOS</h1>
    </div>
  </header>

  <main class="px-8 py-10">
    
  <?php
  foreach($eventos as $evento){
    echo '<section class="bg-white shadow-lg rounded-lg p-6 mb-12 flex items-center justify-between">
      <div>
        <h2 class="text-[#004f63] font-bold text-xl mb-2">'.$evento['Titulo'].'</h2>
      </div>
      <div class="text-[#004f63] font-bold text-xl mb-2 ms-auto me-3 '; 
      if($evento['visibilidad']=="Público"){
        echo 'text-green-600';
      } else{
        echo 'text-slate-950';
      }
      echo'">'.$evento['visibilidad'].'</div>
      <a href="admin-estadisticas-evento.php?id='.$evento['ID_Evento'].'" class="bg-[#004f63] text-white py-2 px-4 rounded-md inline-block hover:bg-[#006a80]">
        <i class="fas fa-eye mr-2"></i>VER DETALLE DEL EVENTO
      </a>
    </section>';
  }
  ?>

  </main>

  <footer class="bg-[#006a80] text-white py-4 text-center">
    <div class="flex justify-center">
      <a href="#" class="text-white px-2 hover:bg-[#004f63] rounded-md">1</a>
      <a href="#" class="text-white px-2 hover:bg-[#004f63] rounded-md">2</a>
    </div>
  </footer>
</body>
</html>