


    
    <?php
        require_once("03-usuario.php");

      

             $user = new Usuario(1);
           
                $cedula = $_POST["cedule"];
                $pass = $_POST["contraseña"];
                $nombre = $_POST["nombrez"];
                $email = $_POST["emaile"];
                $telefono = $_POST["telefone"];
                $sexo = $_POST["sexos"];
                $gerencia = $_POST["gerencia"];
                $rol = $_POST["rol"];
                $coordinacion = $_POST["coordinacion"];
            $user->setcedula($cedula);

            $Consulta = $user->consultarUsuarios();
            

            if (!$Consulta){
               /* CARGAR DATOS DE user */
             $user->setcedula($cedula);
             $user->setpasswordd(password_hash($pass, PASSWORD_BCRYPT));
             $user->setnombre($nombre);
             $user->setemail($email);
             $user->settelefono($telefono);
             $user->setsexo ($sexo);
             $user->setgerencia($gerencia);
             $user->setrol($rol);

             if ($coordinacion) {
                $user->setcoordinacion($coordinacion);
                $Consulta = $user->insertarUsuariosDecoordinacion();
             }else{
                $Consulta = $user->insertarUsuarios();
             }
             
               /* ==================================== */

              

               if ($Consulta) {
                    echo "exitoso";
               }else{
                    echo "error";
               }


            }else{
                echo "existe";

            }







        /* 
                if ($user->insertaruserinistrador()){ //Si es verdadero el registro fue satisfactorio
                    echo "Se registro exitosamente ";
                }else{
                    echo "Hubo un error al registrar";
                } */
        
        
    
    
    ?>

