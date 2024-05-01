<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
    <title>REGISTRO</title>
</head>
<body>
   <!--  <div class="cintillo">
        <div class="img-cintillo">
            <img src="/cintillo.png" alt="">
        </div>
    </div> -->
    <div class="supercontainer">
        <div class="container">

            <header>
                Registro de nuevo usuario
            </header>

            <form action="php/procesamientoregistro.php" method="post">
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
                                <input type="number" placeholder="Ingresa tu numero de Telefono" required name="telefono">
                            </div>
                            
                            <div class="input-field"> 
                                <label>Cedula</label>
                                <input type="number" placeholder="Ingresa tu Cedula" required name="cedula">
                            </div>

                            <div class="input-field"> 
                                <label>Password</label>
                                <input type="number" placeholder="ingresa contraseña" required name="contraseña" >
                            </div>

                            

                            <div class="input-field"> 
                                <label>Sexo</label>
                                <select name="sexo" require>
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                </select>
                            </div>

                           

                        </div>

                        <div class="details personal">
                            <span class="title">Detalles de estatus</span>
                            <div class="fields">

                                <div class="input-field"> 
                                    <label>Gerencia</label>
                                    <select name="gerencia" require>
                                        <option value="1Tec">Tecnologia</option>
                                        <option value="2Atc">Atencion Ciudadano</option>
                                        <option value="3Gtnd">Gestion y desarrollo social</option>
                                        <option value="4Gtno">Gestion operativa</option>
                                        <option value="5Logi">Gestion logistica y infrastructura</option>
                                    </select>
                                </div>
        
                                <div class="input-field"> 
                                    <label>Rol</label>
                                    <select name="rol" require>
                                        <option value="2coor">Coordinador</option>
                                        <option value="1adm">Administrador</option>
                                    </select>
                                </div>
    

                                <!-- <div class="input-field"> 
                                <label>Codigo Carnet</label>
                                <input type="text" placeholder="Ingresa tu nombre" required name="discapacidad"> -->
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