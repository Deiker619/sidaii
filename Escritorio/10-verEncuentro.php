<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Desarrollo social: <?php echo $rol ?></span>
        </div>
    </div>


    <div class="cont-registro">

        <div class="container">

        <?php
         include_once("../php/05-encuentro.php");
             $numero = $_REQUEST["id"];
             $aten = new encuentro(1);

             $aten->setid($numero);
             $registro = $aten->consultarEncuentro();
        ?>

            <header>
            <?php echo"Codigo del taller: ".$numero ?>

            </header>
            
            
            <form action="" method="post" class="dos">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Detalles del taller</span>
                        <div class="fields">

                          <div class="input-field">
                                <label>Fecha de taller</label>
                                <input type="text" placeholder="Ingresa el nombre "  required readonly value="<?php echo $registro["fecha_encuentro"]?>" >
                            </div>


                            <div class="input-field">
                                <label>Estado</label>
                                <input type="text" placeholder="Ingresa el nombre "  required readonly value="<?php echo $registro["nombre_estado"]?>" >
                            </div>

                            <div class="input-field">
                                <label>Municipio</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly  value="<?php echo $registro["nombre"]?>" >
                            </div>

                            <div class="input-field">
                                <label>Parroquia</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly  value="<?php echo $registro["nombre_parroquia"]?>" >
                            </div>


                            <div class="input-field">
                                <label>actividad</label>
                                <input type="text" placeholder="Ingresa el nombre" required readonly value="<?php echo $registro["actividad"]?>" >
                            </div>

                        </div>

                    </div>
                </div>
                
                            
             </form>

            
           
        </div>
        <div class="tabla-atencion">
            <h2>Participantes</h2>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>cedula</th>
                        <th>fecha recibido</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include_once("../php/05-participante_encuentro.php");
                    $aten = new participante_encuentro(1);
                    $aten -> setencuentro($numero);
                    $consulta = $aten->consultarTodosParticipantes();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>

                                <td><?php echo $registros["id"] ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["apellido"] ?></td>
                                <td><?php echo $registros["cedula"] ?></td>
                                <td><?php echo $registros["fecha_recibido"] ?></td>
                                <td><a href="" class="eliminar">Eliminar Reg</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
        
        <script src="../package/dist/sweetalert2.all.js"></script>
        <script src="../package/dist/sweetalert2.all.min.js"></script>

        <script type="text/javascript">

            $(function(){
                $("#registro").click(function(e){
                    var valid = this.form.checkValidity();
                    if(valid){
                        var cedula = $("#cedula").val();
                        var nombre = $("#nombre").val();
                        var apellido = $("#apellido").val();
                        var numero_jornada = $("#numero_jornada").val();
                        var discapacidad = $("#discapacidad").val();
                        var tipo_ayuda_tec = $("#tipo_ayuda_tec").val();
                       
                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "02,2-jornadaAsignada.php",
                            
                            data: {cedula: cedula, nombre: nombre, apellido: apellido,discapacidad: discapacidad, numero_jornada: numero_jornada, tipo_ayuda_tec: tipo_ayuda_tec},

                            success: function(data){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Asignacion de atencion',
                                'text': 'Se asigno asistencia correctamente',
                               
                                }).then(function(){
                                    window.location = "02-AsignarJornada.php?id=<?php echo $numero ?>";
                                  /*  $("#cedula").attr("readonly","readonly");
                                   $("#nombre").attr("readonly","readonly");
                                   $("#apellido").attr("readonly","readonly");
                                   $("#numero_jornada").attr("readonly","readonly");
                                   $("#discapacidad").attr("readonly","readonly");
                                   $("#tipo_ayuda_tec").attr("readonly","readonly");
                                   */

                                })
                            },
                            error: function(data){
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'Oops...',
                                    'text': data
                                })
                            }
                        })
                        

                    }
                })
            })
               
        </script>
<?php
include_once("parteabajo.php");
?>

        