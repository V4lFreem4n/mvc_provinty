<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script async src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
  
</head>
<body>
  
  <div id="panel-stats" style="display:block">
    <div class="bg-teal-500 p-1"></div>
    <div class="bg-white p-2 flex">
    <p class="font-bold">Monitoreo del Evento :</p><p class="ml-1">Nombre del evento</p><p class="ml-auto">ID: <p class="font-bold">1231</p></p>      
    </div>
    <div class="bg-blue-200 p-1"></div>
    <div class="bg-slate-100 p-2">
      <div class="border border-slate-300">
        <div class="grid grid-cols-4">
          
          <!-- Columna 1 (1/4) -->
          <div class="col-span-1 border border-slate-300">
            <div class="border border-slate-300">
              <div class="flex"><p class="mx-auto">Total recaudado</p></div>
              <div class="flex"><p class="mx-auto font-bold">S/. 23000</p></div>
            </div>
            
            <!-- Sub-grid para columnas dentro de la primera columna -->
            <div class="border border-slate-300 grid grid-cols-2">
              <div class="border border-slate-300 col-span-1">
                <div class="flex"><p class="mx-auto">Entradas vendidas</p></div>
                <div class="flex"><p class="mx-auto font-bold">5188</p></div>
              </div>
              
              <div class="border border-slate-300 col-span-1">
                <div class="flex"><p class="mx-auto">Tasa de ocupación</p></div>
                <div class="flex"><p class="mx-auto font-bold">12%</p></div>
              </div>
            </div>
            <div class="border border-slate-300">
                <canvas id="linear-graph"></canvas>
            </div>
          </div>
          
          <!-- Columna 2 (1/4) -->
          <div class="col-span-1 border border-slate-300">
            
            <div class="border border-slate-300">
              <div class="flex"><p class="mx-auto">Promedio de Calificación de los usuarios</p></div>
              <div class="flex"><p class="mx-auto font-bold">3.5</p></div>
            </div>

            <div class="border border-slate-300">
              <div class="flex"><p class="mx-auto">Total de Calificaciones</p></div>
              <div class="flex"><p class="mx-auto font-bold">125</p></div>
            </div>

            <div class="border border-slate-300">
              <canvas id="pie-graph"></canvas>
            </div>
            
            <div class="border border-slate-300">
              <div class="flex"><p class="mx-auto">Promedio de Tiempo de compra (min)</p></div>
              <div class="flex"><p class="mx-auto font-bold">23</p></div>
            </div>

            <div class="border border-slate-300">
              <div class="flex"><p class="mx-auto">Total de cancelaciones</p></div>
              <div class="flex"><p class="mx-auto font-bold">493</p></div>
            </div>

          </div>
          
          <!-- Columna 3 (1/2) -->
          <div class="col-span-2 border border-slate-300">
            
            <div class="border border-slate-300">
              <div class="flex"><p class="mx-auto">Tendencia de venta de entradas</p></div>
            </div>
            <div class="border border-slate-300">
            <canvas id="linear-ventas-tiempo"></canvas>
          </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <button id="download-btn" class="bg-red-300 hover:bg-red-400 p-1 rounded mb-2 ml-2">Descargar como PDF</button>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
  document.getElementById("download-btn").addEventListener("click", function() {
            // Seleccionar el contenido a capturar
            const content = document.getElementById("panel-stats");

            // Usar html2canvas para capturar la imagen
            html2canvas(content).then(canvas => {
                // Convertir el canvas a una imagen
                const imgData = canvas.toDataURL('image/png');
                
                // Crear un documento PDF
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF();
                
                // Agregar la imagen al PDF
                pdf.addImage(imgData, 'PNG', 10, 10, 190, 0); // 190 es el ancho ajustado del PDF A4

                // Descargar el PDF
                pdf.save("captura.pdf");
            });
        });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = ["General","VIP","SUPER VIP","NIÑOS VIP"];
const data = {
  labels: labels,
  datasets: [{
    label: 'Tasas de ventas de entradas (%)',
    data: [15, 59, 80, 100],
    fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  }]
};
    let linearGrafico = document.getElementById("linear-graph").getContext("2d");
    let myLinearChart = new Chart(linearGrafico, {
        type: 'line',
        data:data,
    })



    const dataPie = {
  labels: [
    '1 estrella',
    '2 estrellas',
    '3 estrellas',
    '4 estrellas',
    '5 estrellas'
  ],
  datasets: [{
    label: 'Reseñas de los usuarios',
    data: [300, 50, 100,24,73],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(127, 193, 84)',
      'rgb(186, 84, 193)'
    ],
    hoverOffset: 4
  }]
};
    let pieGraph = document.getElementById("pie-graph").getContext("2d");
    let myPieGraph = new Chart(pieGraph, {
      type: 'doughnut',
  data: dataPie,
    })




    const etiquetas = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

const dataTiempo = {
  labels: etiquetas,
  datasets: [{
    label: 'Total de ventas de entradas por mes',
    data: [67, 94, 108, 131, 320, 379, 477, 536, 636, 771, 795, 874],
    fill: false,
    borderColor: 'rgb(89, 182, 93)',
    tension: 0.1
  },
 {
    label: 'Total de cancelaciones por mes',
    data: [7, 9, 10, 31, 30, 7, 47, 36, 63, 71, 95, 87],
    fill: false,
    borderColor: 'rgb(201, 76, 68)',
    tension: 0.1
  }
]
};
    let linearGraficoTiempoVentas = document.getElementById("linear-ventas-tiempo").getContext("2d");
    let myLinearChartVentasTiempo = new Chart(linearGraficoTiempoVentas, {
        type: 'line',
        data:dataTiempo,
    })
</script>
</html>
