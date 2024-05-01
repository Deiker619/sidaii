
$(document).ready(function() {
    $('#atencion').DataTable();
    $('#atencionE').DataTable();
    $('#atencionU').DataTable();
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