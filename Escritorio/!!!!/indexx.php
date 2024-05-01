<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="estilo.css">

    <!-- Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/ css/line.css">

    <title>Dashboard</title>
</head>

<body>
<?php
session_start();
include_once("../php/03-usuario.php");
   $user = new Usuario(1);

   if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
       $cedulauser = $_SESSION['cedula']; 
       $NombreUsuarioActivo = $_SESSION['nombre'];
       $rol = $_SESSION["rol"];
   }
?>

    <nav class="sidebar">
        <!-- Cabecero de la barra lateral, logo y nombres -->
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="logo.png" alt="logo">
                </span>
                
                <div class="text header-text">
                    <span class="name">Conapdis</span>
                    <span class="profession"> Fundacion-mision </span>
                    
                </div>
            </div>
            
            <!-- <i class='bx bxs-chevrons-right'></i> -->
            
        </header>

        
        
        <!-- Botones del dashboard -->
        <ul class="nav-links">

            <!-- Boton 1: Dashboard -->
            <li>
                <a href="#">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link-name">Dashboard</span>
                </a>
            </li>
            <!-- Boton 2: categorias -->
            <li>
                <div class="ioncn-link">
                    <a href="#">
                        <i class='bx bx-collection'></i>
                        <span class="link-name">Categorias</span>
                    </a>
                    <i class='bx bx-chevron-up'></i>
                </div>

                <!-- Submenus de un boton -->
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Categorias</a></li>
                    <li><a href="#">Registro</a></li>
                    <li><a href="#">Usuarios    </a></li>
                </ul>
            </li>

            <!-- Boton 3: libros -->
            <li>
                <div class="ioncn-link">
                    <a href="#">
                        <i class='bx bx-book'></i>
                        <span class="link-name">Atc. Ciudadano</span>
                    </a>
                    <i class='bx bx-chevron-up'></i>
                    
                </div>
                <!-- Submenus de un boton -->
                <ul class="sub-menu">
                    <li><a href="atencionCiu.php">Registro Discapacitados</a></li>
                    <li><a href="#">Example</a></li>
                    <li><a href="#">Algo mas</a></li>
                    
                </ul>
            </li>
            <!-- Copias -->
            <!-- Boton 1: Dashboard -->
            <li>
                <a href="../registro.php">
                    <i class='bx bx-message-alt-add'></i>
                    <span class="link-name">Ejemplo</span>
                </a>
            </li>
            
            <!-- Boton 2: categorias -->
            <li>
                <div class="ioncn-link">
                    <a href="#">
                        <i class='bx bxs-coin-stack'></i>
                        <span class="link-name">Logística e Infraestructura</span>
                    </a>
                    <i class='bx bx-chevron-up'></i>
                </div>
                <!-- Submenus de un boton -->
                <ul class="sub-menu">
                    <li><a href="logisticaInfra.php">Órtesis y Prótesis</a></li>
                    <li><a href="logisticaInfra.php">Audiometría</a></li>
                    <li><a href="logisticaInfra.php">Infraestructura</a></li>
                </ul>
            </li>
            
            <!-- Boton 3: libros -->
            <li>
                <div class="ioncn-link">
                    <a href="#">
                        <i class='bx bx-dna'></i>
                        <span class="link-name">Indicador</span>
                    </a>
                    <i class='bx bx-chevron-up'></i>
                    
                </div>
                 <!-- Submenus de un boton -->
                 <ul class="sub-menu">
                     
                     <li><a href="#">Ejemplo</a></li>
                     <li><a href="#">Example</a></li>
                     <li><a href="#">Algo mas</a></li>
                     
                    </ul>
                </li>
                
                <!-- Boton 1: Dashboard -->
                <li>
                    <a href="#">
                        <i class='bx bxs-bell-plus'></i>
                        <span class="link-name">Algun indicador</span>
                    </a>
                </li>
                
                <!-- Boton 2: categorias -->
                <li>
                    <div class="ioncn-link">
                        <a href="#">
                            <i class='bx bx-child' ></i>
                            <span class="link-name">Categorias</span>
                        </a>
                        <i class='bx bx-chevron-up'></i>
                    </div>
                    <!-- Submenus de un boton -->
                    <ul class="sub-menu">
                        
                        <li><a href="#">Registro</a></li>
                        <li><a href="#">Usuarios    </a></li>
                    </ul>
                </li>

                <!-- Boton 3: libros -->
                <li>
                    <div class="ioncn-link">
                        <a href="#">
                            <i class='bx bx-signal-5' ></i>
                            <span class="link-name">Book</span>
                        </a>
                        <i class='bx bx-chevron-up'></i>
                        
                    </div>
                    <!-- Submenus de un boton -->
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Book</a></li>
                        <li><a href="#">Ejemplo</a></li>
                        <li><a href="#">Example</a></li>
                        <li><a href="#">Algo mas</a></li>
                        
                    </ul>
                </li>
                
                
                
            </ul>
            
        </nav>
        
        <!-- End de sidebar -->

        <!-- The Menu -->
        <main class="menu-dash">
            <div class="top">
                
                <i class='bx bx-menu sidebar-toggle'></i>

                <div class="busqueda">
                    <i class='bx bx-search-alt bx-rotate-90' ></i>
                    <input type="text" placeholder="Busca aqui">
                </div>

    
                <!-- Usuario: perfil -->
                <li>
                    <div class="ioncn-link">
                        <a href="#">
                            <img src="profile.png" alt="">
                            <span class="link_name"><?php echo $NombreUsuarioActivo ?></span>
                        </a>
                        <i class='bx bx-chevron-up'></i>
                        
                    </div>
                    <!-- Submenus de un boton -->
                    <ul class="sub-menu">
                        <li><a href="#">Ejemplo</a></li>
                        <li><a href="#">Example</a></li>
                        <li><a href="#">Ejemplo</a></li>
                        
                        
                    </ul>
                </li>


             </div>
            
            <div class="dash-contenido">
                <div class="overview">
                    <div class="titulo">
                        <i class='bx bxs-dashboard'> </i>
                       <span class="link-name">Dashboard: <?php echo $rol ?></span>
                    </div>
                </div>

                <!-- Cajas de informacion del dash -->
                <div class="boxes">
                    <div class="box box1">
                        <i class='bx bx-first-aid'></i>
                        <span class="link-name">Asistencias </span>
                        <span class="number">50,120</span>
                    </div>

                    <div class="box box2">
                        <i class='bx bxs-user-badge'></i>
                        <span class="link-name">Carnetizaciones </span>
                        <span class="number">50,120</span>
                    </div>

                    <div class="box box3">
                        <i class='bx bx-group'></i>
                        <span class="link-name">Discapacitados </span>
                        <span class="number">50,120</span>
                    </div>

                   
                </div>


                <!-- estadisticas -->
        
                <!-- <canvas id="chart"></canvas> -->
                
                
                


            </div>
        </main>
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="main.js"></script>
</body>
</html>