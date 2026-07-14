const campSexo = document.querySelector("#campSexo").getContext("2d");
const campEdad = document.querySelector("#campEdad").getContext("2d");
const campDiscGeneral = document.querySelector("#campDiscGeneral").getContext("2d");
const campDiscEspecifica = document.querySelector("#campDiscEspecifica").getContext("2d");

$(document).ready(function () {
  cargarCampSexo();
});
function cargarCampSexo() {
  $.ajax({
    type: "POST",
    url: "graficas/graficasEstadales/graficasCampSexo.php",
    dataType: "json",
    success: function (sexo) {
      var sexos = [];
      var cantidades = [];

      for (var i = 0; i < sexo.length; i++) {
        sexos.push(sexo[i].sexos);
        cantidades.push(sexo[i].cantidades);
      }

      new Chart(campSexo, {
        type: "line",
        data: {
          labels: sexos,
          datasets: [
            {
              label: "Personas por sexo",
              data: cantidades,
              borderColor: "#fcb404",
              borderWidth: 2,
              Fill: false,
              cubicInterpolationMode: "default",
            },
          ],
        },
        options: {
          responsive: true,
          bezierCurve: "Smooth",
          interaction: {
            intersect: false,
          },
        },
      });
    },
  });
}

$(document).ready(function () {
  cargarCampEdad();
});
function cargarCampEdad() {
  $.ajax({
    type: "POST",
    url: "graficas/graficasEstadales/graficasCampEdad.php",
    dataType: "json",
    success: function (edad) {
      var edades = [];
      var cantidades = [];

      for (var i = 0; i < edad.length; i++) {
        edades.push(edad[i].edad);
        cantidades.push(edad[i].cantidades);
      }

      new Chart(campEdad, {
        type: "line",
        data: {
          labels: edades,
          datasets: [
            {
              label: "Personas por edad",
              data: cantidades,
              borderColor: "#38b000",
              borderWidth: 2,
              Fill: false,
              cubicInterpolationMode: "default",
            },
          ],
        },
        options: {
          responsive: true,
          bezierCurve: "Smooth",
          interaction: {
            intersect: false,
          },
        },
      });
    },
  });
}

$(document).ready(function () {
  cargarCampDiscapacidadGeneral();
});
function cargarCampDiscapacidadGeneral() {
  $.ajax({
    type: "POST",
    url: "graficas/graficasEstadales/graficasCampDiscapacidadGeneral.php",
    dataType: "json",
    success: function (discapacidad) {
      var discapacidades = [];
      var cantidades = [];

      for (var i = 0; i < discapacidad.length; i++) {
        discapacidades.push(discapacidad[i].nombre_discapacidad);
        cantidades.push(discapacidad[i].cantidades);
      }

      new Chart(campDiscGeneral, {
        type: "line",
        data: {
          labels: discapacidades,
          datasets: [
            {
              label: "Personas por discapacidad general",
              data: cantidades,
              borderColor: "#0e9cd4",
              borderWidth: 2,
              Fill: false,
              cubicInterpolationMode: "default",
            },
          ],
        },
        options: {
          responsive: true,
          bezierCurve: "Smooth",
          interaction: {
            intersect: false,
          },
        },
      });
    },
  });
}

$(document).ready(function () {
  cargarCampDiscapacidadEspecifica();
});
function cargarCampDiscapacidadEspecifica() {
  $.ajax({
    type: "POST",
    url: "graficas/graficasEstadales/graficasCampDiscapacidadEspecifica.php",
    dataType: "json",
    success: function (discapacidad) {
      var discapacidades = [];
      var cantidades = [];

      for (var i = 0; i < discapacidad.length; i++) {
        discapacidades.push(discapacidad[i].discapacidad);
        cantidades.push(discapacidad[i].cantidades);
      }

      new Chart(campDiscEspecifica, {
        type: "line",
        data: {
          labels: discapacidades,
          datasets: [
            {
              label: "Personas por discapacidad específica",
              data: cantidades,
              borderColor: "#0e9cd4",
              borderWidth: 2,
              Fill: false,
              cubicInterpolationMode: "default",
            },
          ],
        },
        options: {
          responsive: true,
          bezierCurve: "Smooth",
          interaction: {
            intersect: false,
          },
        },
      });
    },
  });
}
