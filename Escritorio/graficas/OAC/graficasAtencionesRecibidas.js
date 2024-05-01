const graficaxbrindada = document.querySelector("#graficaxbrindada").getContext("2d");

$.ajax({
    url: "graficas/OAC/graficas_recibidas.php",
    method: "GET",
    dataType: "json",
    success: function(data) {
        console.log(data);
        var nombre = [];
        var Recibidas = [];

        // Recorrer los datos y agregarlos a los arreglos
        for (var i = 0; i < data.length; i++) {
            var nombres = data[i].nombre;
            var Recibidass = data[i].Recibidas;

            nombre.push(nombres);
            Recibidas.push(Recibidass);
        }

        // Crear el gráfico después de obtener todos los datos
        new Chart(graficaxbrindada, {
            type: "bar",
            data: {
                labels: nombre,
                datasets: [{
                    label: "Tipo de atenciones dadas",
                    data: Recibidas,
                    borderColor: "#9dcee2", // Verde
                    backgroundColor: "#9dcee2", // Verde con opacidad
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Estadísticas de Ayudas Técnicas'
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 20,
                        fontColor: 'black'
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            fontColor: 'black'
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "rgba(0, 0, 0, 0.1)"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontColor: 'black'
                        }
                    }]
                }
            }
        });
    },
    error: function(xhr, status, error) {
        console.error("Error en la solicitud Ajax:", status, error);
    }
});
