<!DOCTYPE html>
<html lang="es">


<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <!--  <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- JQuery -->

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous">
    </script>

    <!-- CSS -->
    <link rel="stylesheet" href="estilo.css">

    <link rel="stylesheet" href="dash.css">

    <link rel="stylesheet" href="02-buttons/01-buttons.css">

    <!-- Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<!-- fontawesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Icons -->
    <!--   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/ css/line.css"> -->

    <!--  Loader-->



    <title>Dashboard</title>
    <link rel="icon" href="Logo.ico">
</head>

<body>
    <?php
    session_start();
    include_once("../php/03-usuario.php");
    $user = new Usuario(1);

    if (isset($_SESSION['cedula'])) {  // Si el usuario inicio sesion correctamente
        $cedulauser = $_SESSION['cedula'];

        $NombreUsuarioActivo = $_SESSION['nombre'];
        $rol = $_SESSION["rol"];
        $gerencia = $_SESSION['gerencia'];
        $coordi = $_SESSION["coordinacion"];
    } else {
        function redireccionar($url)
        {
            ob_start();   // Se utiliza para solucionar el error de  headers already sent 
            $host = $_SERVER['HTTP_HOST'];  //Devuelve la direccion web: Ejemplo: www.cantv.net
            //echo "Host: ".$host."<br>";
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); //Devuelve el Directorio desde donde se esta ejecutando la pagina que invoca la funcion.
            //echo "Uri: ".$uri."<br>";
            header("Location: http://$host$uri/$url"); //Redirecciona a la Pagina Solicitada
            ob_flush();  // Se utiliza para solucionar el error de  headers already sent 
        }

        redireccionar("../index.php");
    }
    

    switch ($rol) {
        case "1adm":
            $rol = "Administrador";
            break;
        case "2coor":
            $rol = "Coordinador";
            break;
        case "3supe":
            $rol = "Superusuario";
            break;
        default:
            // Caso por defecto si ninguna de las condiciones anteriores se cumple
            break;
    }

    ?>

    <nav class="sidebar">
        <!-- Cabecero de la barra lateral, logo y nombres -->
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="logo3.png" alt="logo">
                </span>

                <div class="text header-text">
                    <span class="name">Fundacion Misión José Gregorio Hernandez</span>
                    <span class="profession"></span>

                </div>
            </div>

            <!-- <i class='bx bxs-chevrons-right'></i> -->

        </header>



        <!-- Botones del dashboard -->
        <ul class="nav-links">

            <!-- Boton 1: Dashboard -->
            <li>
                <a href="index.php">
                    <i class='bx bxs-chart'></i>
                    <span class="link-name">Resumen</span>
                </a>
            </li>
            <!-- Boton 2: categorias -->
            <?php
            if ($gerencia == "4Gtno" || $rol == "Superusuario") {
            ?>
                <li>
                    <div class="ioncn-link">
                        <a>
                            <i class='bx bxs-user-voice'></i>
                            <span class="link-name">Operación Estadal</span>
                        </a>
                        <i class='bx bx-chevron-up'></i>
                    </div>

                    <!-- Submenus de un boton -->
                    <ul class="sub-menu">
                        <?php if ($rol != "coorA") { ?>
                            <li><a href="01-atencionCiu.php">Registro beneficiario</a></li>
                        <?php } ?>
                        <?php if ($rol == "Coordinador") { ?>
                            <li><a href="14,1-verCoodinacion.php?coordinacion=<?php echo $coordi?>">Ver mi Coordinacion</a></li>
                        <?php }?>

                        <?php if ($rol == "Administrador" || $rol == "Superusuario"  ) { ?>
                            <li><a href="14-coordinacionesEstadales.php">Coordinaciones estadales</a></li>
                        <?php }?>
                        <!-- <li><a href="14-coordinacionesEstadales.php">Coordinaciones estadales</a></li> -->
                        <li><a href="02-jornadas.php">Jornadas</a></li>
                        <li><a href="12-D-escuela-comunitaria.php">Talleres</a></li>
                        <li><a href="10-encuentros.php">Encuentros</a></li>
                        <li><a href="13-proteccionSocial.php">Proteccion social</a></li>

                    </ul>
                </li>
            <?php
            }
            ?>

            <!-- Boton 3: libros -->
            <?php
            if ($gerencia == "2Atc" || $rol == "Superusuario") {
            ?>
                <li>

                    <div class="ioncn-link">
                        <a>
                            <i class='bx bx-handicap'></i>
                            <span class="link-name">Atención al Ciudadano</span>
                        </a>
                        <i class='bx bx-chevron-up'></i>

                    </div>
                    <!-- Submenus de un boton -->
                    <ul class="sub-menu">
                        <li><a href="01-atencionCiu.php">Registro beneficiario</a></li>
                        <li><a href="01,2-atenciones.php">Solicitudes para OAC</a></li>
                        
                        
                        <li><a href="02-jornadas.php">Jornadas</a></li>
                        <li><a href="10-encuentros.php">Encuentros</a></li>

                    </ul>

                </li>
            <?php

            }
            ?>
            <!-- Copias -->
            <!-- Boton 1: Dashboard -->
            <?php
            if ($rol == "Administrador" || $rol == "Superusuario") {
            ?>
                <li>
                    <a href="03-registro.php">
                        <i class='bx bxs-user'></i>
                        <span class="link-name">Registro Usuarios</span>
                    </a>
                </li>
            <?php
            }
            ?>

            <!-- Boton 2: categorias -->

            <?php
            if ($gerencia == "5Logi" || $rol == "Superusuario") {
            ?>
                <li>
                    <div class="ioncn-link">
                        <a>
                            <i class='bx bx-id-card'></i>
                            <span class="link-name">Logística e Infraestructura</span>
                        </a>
                        <i class='bx bx-chevron-up'></i>
                    </div>
                    <!-- Submenus de un boton -->
                    <ul class="sub-menu">
                        <li><a href="01-atencionCiu.php">Registro beneficiario</a></li>
                        <li><a href="04-ortesisyProtesis.php">Órtesis y Prótesis</a></li>
                        <li><a href="06-reparacionArtificio.php">Reparaciones artificio</a></li>
                        <li><a href="07-audiometria.php">Audiometría</a></li>
                        <li><a href="01-remitidos_a.php">Remitidos</a></li>

                    </ul>
                </li>

            <?php
            }
            ?>

            <!-- Boton 3: libros -->
            <?php
            if ($gerencia == "3Gtnd" || $rol == "Superusuario") {
            ?>
                <li>
                    <div class="ioncn-link">
                        <a>
                            <i class='bx bx-group'></i>
                            <span class="link-name">Desarrollo Social</span>
                        </a>
                        <i class='bx bx-chevron-up'></i>

                    </div>
                    <!-- Submenus de un boton -->
                    <ul class="sub-menu">
                        <li><a href="01-atencionCiu.php">Registro beneficiario</a></li>
                        <li><a href="08-desarrolloSocial-solicitudes.php">Solicitudes taller</a></li>
                        <li><a href="09-desarrolloS-encuentros.php">Solicitudes encuentros</a></li>
                        <li><a href="12-D-escuela-comunitaria.php">Talleres</a></li>
                        <li><a href="10-encuentros.php">Encuentros</a></li>
                        <li><a href="12-D-escuela-comunitaria.php">Escuela Comunitaria</a></li>
                        <li><a href="09-desarrollo-remitidos.php">Remitidos</a></li>


                    </ul>
                </li>
            <?php
            }
            ?>
            <?php
            if ($rol == "Superusuario") {
            ?>
                <li>
                    <div class="ioncn-link">
                        <a>
                            <i class='bx bxs-check-shield'></i>
                            <span class="link-name">Tecnología</span>
                        </a>
                        <i class='bx bx-chevron-up'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a href="tecnologia.php">Usuarios</a></li>
                    </ul>

                </li>
            <?php
            }
            ?>

            <!-- Boton 1: Dashboard -->
            <!-- <li>
                    <a href="#">
                        <i class='bx bxs-bell-plus'></i>
                        <span class="link-name">Algun indicador</span>
                    </a>
                </li> -->

            <!-- Boton 2: categorias -->
            <?php
            if ($rol == "Superusuario" || $gerencia == "6Plan") {
            ?>
                 <li>
                <div class="ioncn-link">
                    <a>
                    <i class='bx bx-stats'></i>
                        <span class="link-name">Planificación y presupuesto</span>
                    </a>
                    <i class='bx bx-chevron-up'></i>
                </div>
                <!-- Submenus de un boton-->
                <ul class="sub-menu">

                    <li><a href="16-planificacionOAC.php">Atención al ciudadano</a></li>
                    <li><a href="#">Operacion estadal </a></li>
                 
                </ul>
            </li>

            <?php
            }
            ?>
           

            <!-- Boton 3: libros -->
            <!-- <li>
                    <div class="ioncn-link">
                        <a>
                            <i class='bx bx-signal-5' ></i>
                            <span class="link-name">Book</span>
                        </a>
                        <i class='bx bx-chevron-up'></i>
                        
                    </div> -->
            <!-- Submenus de un boton -->
            <!-- <ul class="sub-menu">
                        <li><a href="#">Ejemplo</a></li>
                        <li><a href="#">Example</a></li>
                        <li><a href="#">Algo mas</a></li>
                        
                    </ul> 
                </li> -->



        </ul>

    </nav>

    <!-- End de sidebar -->

    <!-- The Menu -->
    <main class="menu-dash">
        <div class="top">

            <i class='bx bx-menu sidebar-toggle'></i>

            <div class="busqueda">

                <input type="text" id="input_search" placeholder="Ingresa cedula..">

                <a href="#" class="search" id="search"><i class='bx bx-search-alt bx-rotate-90'></i></a>


            </div>



            <!-- Usuario: perfil -->
            <li>
                <div class="ioncn-link">
                    <a><?php
                            if($_SESSION["profile_photo"]){
                                $ruta = "fotos_perfil/". $_SESSION["profile_photo"];
                            }else{
                                $ruta = "profile.png";
                            }
                        ?>
                        <div class="img-profi">
                             <img src="<?php echo $ruta ?>" alt="">
                        </div>
                        <span class="link_name" id="user_active"><?php echo $NombreUsuarioActivo ?></span>
                    </a>
                    <i class='bx bx-chevron-up'></i>

                </div>
                <!-- Submenus de un boton -->
                <ul class="sub-menu">
                    <li><a href="__MiPerfil.php">Perfil</a></li>
                    <li><a href="__CambioContraseña.php">Cambio contraseña</a></li>
                    <li><a href="cerrarsesion.php">Cerrar sesion</a></li>
                    


                </ul>
            </li>


        </div>
        <!-- javascript del loader -->
        <div class="action">
            <span class="abrir" onclick="actionToggle()">+</span>
            <div class="action_container">
                <div class="contenedor_action">

                    <div class="action_header">
                        <div class="search">
                            <div class="search-box">
                                <form class="action_form">
                                    <div class="search-field">
                                        <input placeholder="Ingresa cualquier dato (nombre, apellido, cedula)" class="input2" type="text" id="prueba" required>
                                        <div class="search-box-icon">
                                            <button class="btn-icon-content" id="buscar">
                                                <i class="search-icon">
                                                    <i class='bx bx-right-arrow-alt'></i>
                                                </i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <script>
                                $(function() {



                                    $("#buscar").click(function(e) {

                                        var valid = this.form.checkValidity();
                                        if (valid) {

                                            /* Detalles personales */
                                            var busqueda = $("#prueba").val();
                                            console.log(busqueda);

                                            e.preventDefault()
                                            $.ajax({
                                                type: "POST",
                                                url: "parteprueba.php",
                                                data: {
                                                    busqueda: busqueda,

                                                },
                                                success: function(data) {
                                                    document.getElementById('resultados').innerHTML = data;
                                                },
                                                error: function(data) {
                                                    Swal.fire({
                                                        'icon': 'error',
                                                        'title': 'Oops...',
                                                        'text': "No se ha podido generar la busqueda"
                                                    })
                                                }
                                            })
                                        }
                                    })
                                })
                            </script>

                        </div>

                        <!--  <div class="otras_opciones">

                            <button class="opciones_button">
                                <span>Atenciones</span>
                                <i class='bx bx-chevron-down'></i>
                            </button>

                            <button class="opciones_button">
                                <span>Atenciones</span>
                                <i class='bx bx-chevron-down'></i>
                            </button>
                            <button class="opciones_button">
                                <span>Atenciones</span>
                                <i class='bx bx-chevron-down'></i>
                            </button>



                        </div> -->


                        <!-- <div class="radio-inputs">
                                    <label class="radio">
                                        <input type="radio" name="radio" selected checked="">
                                        <span class="name">Atenciones</span>
                                    </label>

                                    <label class="radio">
                                        <input type="radio" name="radio" selected checked="">
                                        <span class="name">Busqueda SIGCA</span>
                                    </label>



                                </div> -->
                        <!--   <label for="radio-inputs" class="nombre_accion">SELECCIONE:</label>
                                <div class="radio-inputs" name="radio-inputs">
                                    <label class="radio">
                                        <input type="radio" name="radio" checked="">
                                        <span class="name">Por dia</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="radio">
                                        <span class="name">Por mes</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="radio">
                                        <span class="name">Por año</span>
                                    </label>



                                </div>

                                <form class="form-radio">
                                    <div class="input-radio">
                                        <label for="">Dia inicio</label><br>
                                        <input type="date">
                                    </div>


                                    <div class="input-radio">
                                        <label for="">Dia Final</label><br>
                                        <input type="date">
                                    </div>
                                    


                                </form>

                                <canvas id="chart2" style="height:400px"></canvas>-->


                    </div>

                    <div class="resultados" id="resultados">


                    </div>
                </div>

            </div>


        </div>

        <script type="text/javascript">
            function actionToggle() {
                var action = document.querySelector('.action');
                action.classList.toggle('active')
            }

            $(document).ready(function() {
                $('#result').DataTable();

            });
        </script>