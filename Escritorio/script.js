$(document).ready(function() {
  $('table').each(function() {
      // Aquí puedes realizar acciones con cada tabla

     $(this).DataTable() // Imprime el ID de la tabla
  });
  
 
});

console.log("Codigo para desplegar menu side-menu");

let lista_elementos = document.querySelectorAll(".ioncn-link")

lista_elementos.forEach(i => {
    i.addEventListener("click", ()=>{
        i.classList.toggle("down")

        let height = "0";
        let menu = i.nextElementSibling;
        console.log(menu.scrollHeight)

        if (menu.clientHeight == "0"){
            height = menu.scrollHeight
            console.log(height)
        }

        menu.style.height = `${height}px`
    })
})
/* ******************************************************* */
console.log("codigo para la barra del sidebar-toggle");

const body = document.querySelector("body");
        sidebar = body.querySelector(".sidebar")
        sidebarToggle = body.querySelector(".sidebar-toggle");
        console.log(sidebarToggle);

sidebarToggle.addEventListener("click", ()=>{
    sidebar.classList.toggle("close")
})


/* ******************************************************************** */

var inactivityTimeout = 300000; // Tiempo de inactividad en milisegundos (5 minutos)
var logoutUrl = "cerrarsesion.php"; // URL de la página de cierre de sesión

var inactivityTimer;

// Función para iniciar el temporizador de inactividad
function startInactivityTimer() {
  inactivityTimer = setTimeout(logoutUser, inactivityTimeout);
}

// Función para reiniciar el temporizador de inactividad
function resetInactivityTimer() {
  clearTimeout(inactivityTimer);
  startInactivityTimer();
}

// Función para desconectar al usuario
function logoutUser() {
  window.location.href = logoutUrl;
}

// Eventos para reiniciar el temporizador de inactividad
document.addEventListener("mousemove", resetInactivityTimer);
document.addEventListener("keydown", resetInactivityTimer);
document.addEventListener("click", resetInactivityTimer);
document.addEventListener("mousedown", resetInactivityTimer);
document.addEventListener("wheel", resetInactivityTimer);
// Iniciar el temporizador de inactividad al cargar la página
startInactivityTimer();



$(document).ready(function() {
  $('a.cedula').on("contextmenu", function(event) {
    // Prevenir el comportamiento predeterminado del clic derecho
    event.preventDefault();

    // Obtener el valor del elemento
    var valor = $(this).text();
    let color = $(this).css('color')

    // Copiar el valor al portapapeles
    navigator.clipboard.writeText(valor).then(function() {
      // Mostrar un mensaje informativo al usuario
      console.log("¡Valor copiado al portapapeles!");

      // Cambiar el texto del enlace a "Copiado"
      $(event.target).text("Copiado");
      $(event.target).css("color","red");

      // Después de un segundo, cambiar el texto del enlace de nuevo al valor original
      setTimeout(function() {
        $(event.target).text(valor);
        $(event.target).css("color", color);
        
      }, 1000);
    });
  });
});


