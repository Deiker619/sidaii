<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
    <title>SIDDAI-REGISTRO</title>
</head>
<body>
    <div class="cintillo">
        <div class="img-cintillo">
            <img src="/cintillo.png" alt="">
        </div>
    </div>
    <div class="supercontainer">
        <div class="container">

            <header>
                Registro de discapacitados
            </header>

            <form action="php/01-discapacitados.php" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Detalles Personales</span>
                        <div class="fields">


                            <div class="input-field"> 
                                <label>Nombre completo</label>
                                <input type="text" placeholder="Ingresa tu nombre" required name="nombre">
                            </div>
                            
                            
                            <div class="input-field"> 
                                <label>Email</label>
                                <input type="email" placeholder="Ingresa tu correo electronico" required name="email">
                            </div>
                            
                            <div class="input-field"> 
                                <label>Telefono</label>
                                <input type="tel" placeholder="Ingresa tu numero de Telefono" required name="telefono">
                            </div>
                            
                            <div class="input-field"> 
                                <label>Cedula</label>
                                <input type="number" placeholder="Ingresa tu Cedula" required name="cedula">
                            </div>

                            <div class="input-field"> 
                                <label>Codigo de Carnet</label>
                                <input type="number" placeholder="Ingresa el codigo de carnet" required name="cod_carnet">
                            </div>

                            <div class="input-field"> 
                                <label>Asistencia Tecnica</label>
                                <input type="text" placeholder="Ingresa tu nombre" required name="tipoasistencia">
                            </div>

                            <div class="input-field"> 
                                <label>Discapacidad</label>
                                <input type="text" placeholder="Ingresa tu nombre" required name="discapacidad">
                            </div>

                           

                            
                        </div>

                        <div class="details personal">
                            <span class="title">Detalles de ubicación</span>
                            <div class="fields">
        
        
                                <div class="input-field"> 
                                    <label>Estado</label>
                                    <input type="text" placeholder="Ingresa tu nombre" required name="estado">
                                </div>
        
                                <div class="input-field dos"> 
                                    <label>Direccion</label>
                                    <input type="text" placeholder="Ingresa tu Cedula" required name="direccion">
                                </div>

                            </div>
                        </div>

                        <button class="nextBtn" name="registro">
                            <span class="btnText">Registrar</span>
                            <ion-icon name="send-outline"></ion-icon>
                        </button>


                    </div>
                </div>

                


            </form>
        </div>
    </div> 

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>