<?php
 include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Atencion al Ciudadano: <?php echo $rol ?></span>
        </div>
    </div>
    <div class="cont-registro">

<div class="container dos">

    <header>
       Remitir Beneficiario 
   
    </header>

    <form action="../php/procesamientoremitido.php" method="post" class="dos">
        <div class="form first">

        <?php
         /* session_start(); */
         include_once("../php/01-discapacitados.php");

            /*  if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
                 $cedulauser = $_SESSION['cedula']; 
                 $NombreUsuarioActivo = $_SESSION['nombre'];
             } */

             $cedula = $_REQUEST["cedula"];
             $aten =  new Discapacitados(1);

             $aten->setcedula($cedula);
             $registro = $aten->consultarDiscapacitados();

             if($registro){
        ?>

            <div class="details personal">
                <span class="title"></span>
                <div class="fields">

                <div class="input-field dos">
                        <label>Nombre</label>
                        <input type="text" placeholder="Ingresa el nombre " required id="nombre" name="nombre" value="<?php echo $registro["nombre"]." ".$registro["apellido"]  ?>">
                    </div>


                    <div class="input-field dos">
                        <label>Cedula</label>
                        <input type="number" placeholder="Ingresa la cedula " required id="cedula" name="cedula" value="<?php echo $registro["cedula"]?>" >
                    </div>


                    <div class="input-field dos">
                        <label>Departamento</label>
                        <select name="remitir" id="remitir">
                            <option value="1-Salud">D. Salud</option>
                            <option value="2-M. Vivie">Mision Vivienda</option>
                        </select>
                    </div>
                    <div class="input-field dos">
                        <label>Fecha</label>
                        <input type="date" placeholder="Ingresa la cedula " required id="fecha" name="fecha" readonly value="<?php echo date("Y-m-d")?>" >
                </div>

                </div>


                

            </div>




        </div>

        <button class="nextBtn" name="registro" id="registro">
            <span class="btnText">Remitir</span>
            <ion-icon name="send-outline"></ion-icon>
        </button>
        <?php }?>
    </form>

</div>
</div>
        <script src="../package/dist/sweetalert2.all.js"></script>
        <script src="../package/dist/sweetalert2.all.min.js"></script>

        <script type="text/javascript">
           
            $(function(){

                

                $("#registro").click(function(e){
                    
                    var valid = this.form.checkValidity();
                    if(valid){

                        /* Detalles personales */
                        var cedula = $("#cedula").val();
                        var nombre = $("#nombre").val();
                        var fecha = $("#fecha").val();
                        var remitir = $("#remitir").val();
                    
                       

                        

                            e.preventDefault();
                            $.ajax({
                            type: "POST",
                            cache: false,
		                    async:true,
                            url: "../php/procesamientoremitido.php",
                            data: {cedula: cedula, nombre: nombre, 
                                    fecha: fecha, remitir: remitir
                                    },
                            success: function(data){
                                Swal.fire({
                                icon: 'success',
                                title: data
                                }).then(function(){

                                    window.location = "01,5-atencionRecibida.php";
                                })
                            },
                            error: function(data){
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'Oops...',
                                    'text': "No se ha podido generar el registro"
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