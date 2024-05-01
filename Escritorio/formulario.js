const openModal = document.querySelector(".search");
const modal = document.querySelector(".modal");
const closeModal = document.querySelector(".modal__close");

openModal.addEventListener("click", (e) => {
  e.preventDefault();
  

  var input_search = $("#input_search").val();
 


        e.preventDefault();
        const busqueda = $.ajax({
          type: "POST",
          url: "--Busqueda.php",
          dataType: "text",
          async: false,
          data: {
            input_search: input_search,
          },
        }).responseText;
          document.getElementById("resumen__search").innerHTML = busqueda;

          modal.classList.add("modal_show");
          console.log("abierto");
          console.log(input_search);
      });

closeModal.addEventListener("click", (e) => {
  e.preventDefault();
  modal.classList.remove("modal_show");
  $('#input_search').val('');
});

$(document).ready(function () {
  /*   $("#estado").val("101-Distc"); */
  recargarLista();

  $("#estado").change(function () {
    recargarLista();
  });
});
function recargarLista() {
  $.ajax({
    type: "POST",
    url: "datos.php",
    data: "estado=" + $("#estado").val(),
    success: function (r) {
      $("#lista2").html(r);
      recargarListaPa();

      $("#municipio").change(function () {
        recargarListaPa();
      });

      function recargarListaPa() {
        $.ajax({
          type: "POST",
          url: "datosParroquias.php",
          data: "municipio=" + $("#municipio").val(),
          success: function (p) {
            $("#lista3").html(p);
          },
        });
      }
    },
  });
}

$(document).ready(function () {
  /*   $("#estado").val("101-Distc"); */
  recargarDiscapacidad();
  
  $("#discapacidad").change(function () {
    recargarDiscapacidad();
  });
});

function recargarDiscapacidad(){
  $.ajax({
    type: "POST",
    url: "datosDiscapacidades.php",
    data: "general=" + $("#discapacidad").val(),
    success: function (r) {
      $("#discapacidadE").html(r);
     
    }
  })

}
  

$(document).ready(function() {
  // Evento para detectar cambios en el campo de fecha de nacimiento
  $('#fecha_naci').change(function() {
    var fecha_naci = $(this).val(); // Obtener el valor del campo de fecha de nacimiento
    console.log(fecha_naci);
    var hoy = new Date(); // Obtener la fecha actual
    var fechaNacimientoArray = fecha_naci.split('-'); // Dividir la fecha de nacimiento en un array [año, mes, día]
    console.log(fechaNacimientoArray);
    var fechaNacimientoDate = new Date(fechaNacimientoArray[0], fechaNacimientoArray[1] - 1, fechaNacimientoArray[2]); // Crear un objeto de fecha de nacimiento

    var edad = hoy.getFullYear() - fechaNacimientoDate.getFullYear(); // Calcular la diferencia de años
    var mes = hoy.getMonth() - fechaNacimientoDate.getMonth(); // Calcular la diferencia de meses

    // Si el mes actual es menor al mes de nacimiento o si los meses son iguales pero el día actual es menor al día de nacimiento, restamos un año
    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimientoDate.getDate())) {
      edad--;
    }

    // Mostrar la edad en el elemento con id "resultadoEdad"
    $('#edad').val(edad);
  });
});

$(document).ready(function(){ /* 22/8/2023   */
  menor();
  
  $("#label-chk").hide();

  /* funcion para los checkbox de toma de medidas */

function menor(){
  $("#cbx2").change(function() {

    if(this.checked){
      console.log("oculta")
      $("#chk-menor").hide();
      $("#chk-menor2").hide();
      $("#chk-hijo").hide();
      $("#label-chk").show();
      $("#cedula").attr("placeholder", "Ejemplo: 30165406"+"1");
      $("#hijos").val("0");
      console.log( $("#hijos").val())
      

    }else{
      console.log("muestra")
      $("#chk-menor").show();
      $("#chk-menor2").show()
      $("#chk-hijo").show();
      
     
      $("#label-chk").hide();
      $("#cedula").attr("placeholder", "Ingrese la cedula sin puntos ni letras");
     
      


    }
      
  });
}})
