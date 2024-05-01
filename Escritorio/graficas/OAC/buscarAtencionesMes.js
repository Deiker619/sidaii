function BuscarAtencionesMes() {
    Swal.fire({
        title: 'Carga de solicitud a este beneficiario/a?',
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
                    <select name="año" id="año" require>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                </div>
            </div>`,
        denyButtonText: 'No Buscar',
    }).then((result) => {
        if (result.isConfirmed) {
            var IDmes = $('#mes option:selected').val();
            var IDaño = $('#año option:selected').val();
            console.log(IDmes, IDaño);
            $.ajax({
                type: 'POST',
                url: 'graficas/OAC/BuscarAtencionesMes.php',
                dataType: 'json',
                data: {
                    IDmes: IDmes,
                    IDaño: IDaño,
                },
                success: function (data) {
                    console.log(data);
                    console.log(data)
                        var meses = [];
                        var años = [];
                        var nombre_meses =[];
                        var cantidades =[]
                
                        for (var i = 0; i < data.length; i++) {
                            var mes = data[i].mes;
                            var año  = data[i].año
                            var nombre_mes= data[i].nombre_mes
                            var cantidadRegistro =data[i].cantidad_registros
                            
                
                            meses.push(mes);
                            años.push(año);
                            nombre_meses.push(nombre_mes);
                            cantidades.push(cantidadRegistro);
                        }

                        if (data.length>0) {
                            
                      
                        Swal.fire({
                            icon: 'success',
                            title: "Reporte mensual",
                            html: `<b>Mes: </b>${data[0].nombre_mes}
                                    <br><b>Año: </b>${data[0].año}\n<br>
                                    <b>Cantidad de registros </b>${data[0].cantidad_registros}<br>`,
                            showCloseButton: true, // Mostrar el botón de cerrar
                            showConfirmButton: false, // Ocultar el botón de confirmar
                            footer:'<a href="reportes/reporteMensualOAC.php?mes=' + data[0].nro_mes + '&año=' + data[0].año + '">Descargar PDF</a>'

                        }).then(function () {
                            window.location = "01,2-atenciones.php";
                        });
                    }
                        

                        if (data.length==0) {
                            Swal.fire({
                                icon: 'error',
                                title: "No se encontraron datos"
                            }).then(function() {
                                window.location = "01,2-atenciones.php";
                            })
                        }
                },
                error: function (data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data,
                    });
                },
            });
        } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info');
        }
    });
}
