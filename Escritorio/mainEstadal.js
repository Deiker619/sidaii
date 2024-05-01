/* const chart = document.querySelector("#chart").getContext("2d"); */
const graficasXestados = document.querySelector("#graficasXestados").getContext("2d");
const graficasXdiscapacidadES = document.querySelector("#graficasXdiscapacidadES").getContext("2d");
const chart = document.querySelector("#bar-chart2").getContext("2d");
const chart4 = document.querySelector("#bar-chart3").getContext("2d");
const graficaporedad = document.querySelector("#graficaporedad").getContext("2d");
const graficasXdiscapacidad = document.querySelector("#graficasXdiscapacidad").getContext("2d");
const grafica_sexo = document.querySelector("#grafica_sexo").getContext("2d");
const grafica_tipoayuda = document.querySelector("#grafica_tipoayuda").getContext("2d");

$(document).ready(function () {
  /*   $("#estado").val("101-Distc"); */
  cargarGraficaXayuda();
});
function cargarGraficaXayuda() {
  $.ajax({
    type: "POST",
    url: "graficas/graficasEstadales/graficasxayudatecnica.php",
    dataType: "json",
    success: function (ayuda) {
      var nombre_tipoayuda = [];
      var cantidad = [];
      
      console.log(ayuda);

      // Recorrer los datos y agregarlos a los arreglos
      for (var i = 0; i < ayuda.length; i++) {
        var ayudas = ayuda[i].nombre_tipoayuda;
        var cantidadess = ayuda[i].cantidad;

        nombre_tipoayuda.push(ayudas);
        cantidad.push(cantidadess);
    }
      console.log(ayuda);

      new Chart(grafica_tipoayuda, {
        type: "line",
        data: {
          labels: nombre_tipoayuda,
          datasets: [
            {
              label: "Por ayuda tecnica",
              data: cantidad,
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
          animation: {
            onComplete: () => {
              delayed = true;
            }
          },
          delay: (context) =>{
            let delay = 0;
            if(context.type ==='data' && context.mode ==='default' & !delayed){
              delay = context.dataIndex * 300 + context.dataIndex * 100;
            }
            return delay;
          }
        },
      });
    },
  });
}

$(document).ready(function () {
  /*   $("#estado").val("101-Distc"); */
  cargarGraficaXestado();
});
function cargarGraficaXestado() {
  $.ajax({
    type: "POST",
    url: "graficas/graficasEstadales/graficasXestados.php",
    success: function (data) {
      var valores = eval(data);
      var Dtt = valores[0];
      var Amaz = valores[1];
      var Anz = valores[2];
      var Apu = valores[3];
      var Ara = valores[4];
      var Bari = valores[5];
      var Boli = valores[6];
      var Carbb = valores[7];
      var Coje = valores[8];
      var Delt = valores[9];
      var Fal = valores[10];
      var Gua = valores[11];
      var Lar = valores[12];
      var Miran = valores[13];
      var Mona = valores[14];
      var Nva = valores[15];
      var Portu = valores[16];
      var Sucr = valores[17];
      var Tach = valores[18];
      var Truj = valores[19];
      var Varg = valores[20];
      var Yara = valores[21];
      var Zul = valores[22];

      new Chart(graficasXestados, {
        type: "line",
        PointStyle: "cross",
        data: {
          labels: [
            "Dtt.C",
            "Amaz",
            "Anz",
            "Apu",
            "Ara",
            "Bari",
            "Boli",
            "Carbb",
            "Coje",
            "Delt",
            "Fal",
            "Gua",
            "Lar",
            "Miran",
            "Mona",
            "Nva.Es",
            "Portu",
            "Sucr",
            "Tach",
            "Truj",
            "Varg",
            "Yara",
            "Zul",
          ],
          datasets: [
            {
              label: "Atenciones totales por estado",
              data: [
                Dtt,
                Amaz,
                Anz,
                Apu,
                Ara,
                Bari,
                Boli,
                Carbb,
                Coje,
                Delt,
                Fal,
                Gua,
                Lar,
                Miran,
                Mona,
                Nva,
                Portu,
                Sucr,
                Tach,
                Truj,
                Varg,
                Yara,
                Zul,
              ],
              borderColor: "#38b000",
              borderWidth: 2,
              Fill: false,
              cubicInterpolationMode: "monotone",
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
  /*   $("#estado").val("101-Distc"); */
  cargarGraficaXmes();
});
function cargarGraficaXmes() {
  $.ajax({
    type: "POST",
    url: "graficas/graficasEstadales/graficasXmes.php",
    success: function (mes) {
      var valore = eval(mes);
      var ene = valore[0];
      var feb = valore[1];
      var mar = valore[2];
      var abr = valore[3];
      var may = valore[4];
      var jun = valore[5];
      var jul = valore[6];
      var ago = valore[7];
      var sep = valore[8];
      var oct = valore[9];
      var nov = valore[10];
      var dic = valore[11];

      new Chart(chart4, {
        type: "line",
        data: {
          labels: [
            "En",
            "fe",
            "ma",
            "ab",
            "may",
            "jun",
            "jul",
            "ago",
            "sep",
            "oct",
            "nov",
            "dic",
          ],
          datasets: [
            {
              label: "Atenciones por mes",
              data: [
                ene,
                feb,
                mar,
                abr,
                may,
                jun,
                jul,
                ago,
                sep,
                oct,
                nov,
                dic,
              ],
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
  /*   $("#estado").val("101-Distc"); */
  cargarGraficaXdiscapacidad();
});
function cargarGraficaXdiscapacidad() {
  $.ajax({
    type: "POST",
    url: "graficas/graficasEstadales/graficasXDiscapacidadEs.php",
    dataType: "json",
    success: function (discapacidad) {
      var discapacidades = [];
      var cantidades = [];
      
      console.log(discapacidad);

      // Recorrer los datos y agregarlos a los arreglos
      for (var i = 0; i < discapacidad.length; i++) {
        var discap = discapacidad[i].discapacidad;
        var cantid = discapacidad[i].cantidades;

        discapacidades.push(discap);
        cantidades.push(cantid);
    }

      

      new Chart(graficasXdiscapacidadES, {
        type: "line",
        data: {
          labels: discapacidades,
          datasets: [
            {
              label: "Atenciones por discapacidad especifica",
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
  /*   $("#estado").val("101-Distc"); */
  cargarGraficaXdiscapacidadg();
});
function cargarGraficaXdiscapacidadg() {
  $.ajax({
    type: "POST",
    url: "graficas/graficasEstadales/graficasXdiscapacidad.php",
    dataType: "json",
    success: function (discapacidad) {
      var discapacidades = [];
      var cantidades = [];
      
      console.log(discapacidad);

      // Recorrer los datos y agregarlos a los arreglos
      for (var i = 0; i < discapacidad.length; i++) {
        var discap = discapacidad[i].nombre_discapacidad;
        var cantid = discapacidad[i].cantidades;

        discapacidades.push(discap);
        cantidades.push(cantid);
    }

      

      new Chart(graficasXdiscapacidad, {
        type: "line",
        data: {
          labels: discapacidades,
          datasets: [
            {
              label: "Atenciones por discapacidad general",
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
  /*   $("#estado").val("101-Distc"); */
  cargarGraficaXaño();
});
function cargarGraficaXaño() {
  $.ajax({
    type: "POST",
    url: "graficas/graficasEstadales/graficasXaño.php",
    success: function (year) {
      var valors = eval(year);
      var años = valors[0];
      console.log(años);

      let tiempo = new Date();
      let año = tiempo.getFullYear();
      console.log(año);

      new Chart(chart, {
        type: "bar",
        data: {
          labels: [año],
          datasets: [
            {
              label: "Asistencias por año",
              data: [años],
              borderColor: "#38b000",
              backgroundColor: "rgba(56, 176, 0, 0.2)",
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
  /*   $("#estado").val("101-Distc"); */
  cargarGraficaXsexo();
});
function cargarGraficaXsexo() {
  $.ajax({
    type: "POST",
    url: "graficas/graficasEstadales/graficasXsexo.php",
    dataType: "json",
    success: function (sexo) {
      var sexos = [];
      var cantidades = [];
      
      console.log(sexo);

      // Recorrer los datos y agregarlos a los arreglos
      for (var i = 0; i < sexo.length; i++) {
        var s = sexo[i].sexos;
        var c = sexo[i].cantidades;

        sexos.push(s);
        cantidades.push(c);


    }

    console.log(sexos)


      new Chart(grafica_sexo, {
        type: "line",
        data: {
          labels: sexos,
          datasets: [
            {
              label: "Asistencias por sexo",
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
  /*   $("#estado").val("101-Distc"); */
  cargarGraficaXedad();
});
function cargarGraficaXedad() {
  $.ajax({
    type: "POST",
    url: "graficas/graficasEstadales/graficasXedad.php",
    dataType: "json",
    success: function (edad) {
      var edadd = [];
      var cantidadesx = [];
      
      console.log(edad);

      // Recorrer los datos y agregarlos a los arreglos
      for (var i = 0; i < edad.length; i++) {
        var edaddd = edad[i].edad;
        var cantidadess = edad[i].cantidades;

        edadd.push(edaddd);
        cantidadesx.push(cantidadess);
    }
      console.log(cantidadesx);

      new Chart(graficaporedad, {
        type: "line",
        data: {
          labels: edadd,
          datasets: [
            {
              label: "Por edad",
              data: cantidadesx,
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