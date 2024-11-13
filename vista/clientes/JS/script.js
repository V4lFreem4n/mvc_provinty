// Establece la fecha del evento
var eventDate = new Date("October 05, 2024 13:00:00").getTime();

// Selecciona el elemento countdown
var countdownElement = document.getElementById('countdown');

// Crea un nuevo elemento de imagen
var countdownImage = document.createElement('img');

// Establece la ruta de la imagen y otras propiedades
countdownImage.src = 'img/tempo.jpg'; 
countdownImage.alt = 'Temporizador';
countdownImage.classList.add('countdown-image'); 

// Inserta la imagen en el elemento countdown (solo la primera vez)
countdownElement.appendChild(countdownImage); 
// Actualiza la cuenta regresiva cada segundo
var countdownInterval = setInterval(function() {

    // Obtiene la fecha y hora actual
    var now = new Date().getTime();

    // Calcula la diferencia entre la fecha del evento y ahora
    var timeLeft = eventDate - now;

    // Calcula los días, horas, minutos y segundos restantes
    var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
    var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

    // Muestra la cuenta regresiva en el HTML, manteniendo la imagen
    countdownElement.innerHTML = ""; // Limpia solo el texto
    countdownElement.appendChild(countdownImage); // Vuelve a agregar la imagen
    countdownElement.innerHTML += "Falta " + days + "D, " + hours + "Hr, " + minutes + "Min"; // Agrega el texto

    // Si la cuenta regresiva ha terminado, muestra un mensaje
    if (timeLeft < 0) {
        clearInterval(countdownInterval);
        countdownElement.innerHTML = "¡El evento ha comenzado!";
    }

}, 1000);
