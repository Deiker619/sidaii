function BuscarCampMensual() {
    Swal.fire({
        title: 'Generar reporte mensual de campamentos',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Buscar reporte',
        confirmButtonColor: '#1AA83E',
        html: `<div class="search-reports" style="display: flex; justify-content: center">
                <div class="reports-contenedor">
                    <label>Elige el mes</label><br>
                    <select name="mes" id="mes" require>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select><br>
                </div>
                <div class="reports-contenedor">
                    <label>Año</label><br>
                    <select name="anio" id="anio" require>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026" selected>2026</option>
                    </select>
                </div>
            </div>`,
        denyButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            var IDmes = $('#mes option:selected').val();
            var IDanio = $('#anio option:selected').val();

            $.ajax({
                type: 'POST',
                url: 'graficas/graficasEstadales/buscarCampMensual.php',
                dataType: 'json',
                data: {
                    IDmes: IDmes,
                    IDanio: IDanio,
                },
                success: function (data) {
                    if (data.length > 0) {
                        var totalRegistros = data[0].total_registros;

                        Swal.fire({
                            icon: 'success',
                            title: "Reporte mensual de campamentos",
                            html: `<b>Mes: </b>${data[0].nombre_mes}
                                    <br><b>Año: </b>${data[0].anio}
                                    <br><b>Total de personas: </b>${totalRegistros}`,
                            showCloseButton: true,
                            showConfirmButton: false,
                            footer: '<a href="reportes/reporteCampMensualOP.php?mes=' + IDmes + '&anio=' + IDanio + '">Descargar PDF</a>'
                        });
                    }

                    if (data.length == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: "No se encontraron datos",
                            text: "No hay personas en campamentos para el período seleccionado"
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "No se pudo completar la petición",
                    });
                },
            });
        } else if (result.isDenied) {
            Swal.fire('Cancelado', '', 'info');
        }
    });
}
