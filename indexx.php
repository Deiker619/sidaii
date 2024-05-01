<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
    <title>Iniciar Sesion </title>
</head>

<body>
    <div class="cintillo">
        <div class="img-cintillo">
            <img src="cintillo2.jpg" alt="">
        </div>
    </div>
    <div class="supercontainer">
        <div class="container">
            <header>
                Iniciar Sesion en el Sistema
            </header>
            <form action="" method="post">
                <div class="details personal">
                    <span class="title">Datos de acceso</span>
                    <div class="fields">

                        <div class="input-field">
                            <label for="cedula">Numero de cedula</label>
                            <input type="number" placeholder="Ingresa tu cedula" required name="cedula" id="cedula">
                        </div>

                        <div class="input-field">
                            <label for="contraseña">Contraseña</label>
                            <input type="password" placeholder="Ingresa tu contraseña" required id="contraseña" name="contraseña">
                        </div>

                    </div>
                </div>

                <button class="nextBtn" id="inicio">
                    <span class="btnText">Iniciar Sesion</span>
                </button>


        </div>
    </div>




    </form>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="package/dist/sweetalert2.all.js"></script>
    <script src="package/dist/sweetalert2.all.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#inicio").click(function(e) {
                var valid = this.form.checkValidity();
                if (valid) {
                    var cedula = $("#cedula").val();
                    var contraseña = $("#contraseña").val();

                    console.log(cedula, contraseña);


                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "php/procesamientologin.php",
                        data: {
                            cedula: cedula,
                            contraseña: contraseña
                        },
                        success: function(data) {
                            if (data == true) {
                                window.location = "Escritorio/index.php";
                            }else{
                                Swal.fire({
                                'icon': 'error',
                                'title': 'Oops...',
                                'text': "Verifique cedula o contraseña"
                            })

                            }
                        },
                        error: function(data) {
                            Swal.fire({
                                'icon': 'error',
                                'title': 'Oops...',
                                'text': "Verifique cedula o contraseña"
                            })
                        }
                    })


                }
            })
        })
    </script>

</body>

</html>