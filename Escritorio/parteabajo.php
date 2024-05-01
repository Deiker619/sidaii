                <!-- estadisticas -->

                <!-- <canvas id="chart"></canvas> -->



                <section class="modal">


                    <div class="modal__container">
                        <div class="modal__header">
                            <a href="" class="modal__close">Cerrar</a>
                        </div>
                        <h4>Resultados de busqueda:</h4>

                        <div class="resumen" id="resumen__search" style="margin-top: 0; flex-direction:column; align-items:normal">


                        </div>


                    </div>

                </section>


              






                <div class="footer__info container">
                    <span class="footer_copy">
                        &#169; FMJGH. Gobierno Bolivariano de Venezuela <img src="ve.png">
                    </span>







                    <br><br>
                    <div class="footer__privacy">
                        <a>Presidenta: Soraida Ramirez</a>
                        <a>Ente adscrito al Despacho de la Presidencia</a>
                    </div>

                </div>

                </div>


                </main>
                <script src="script.js"></script>
               
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="formulario.js"></script>
                <script src="formulario2.js"></script>
                <!-- Graficas -->
          <!--       <script src="main.js"></script>
                <script src="graficas_ayudas_tec/graficas.js"></script> -->

                <script>
                    function toggleZoomScreen() {
                        document.body.style.zoom = "90%";
                    }

                    toggleZoomScreen()
                </script>


                <script>
                    // Función para almacenar la posición actual antes de recargar la página
                    window.addEventListener('beforeunload', function() {
                        // Obtener la posición actual del scroll vertical
                        var scrollPos = window.scrollY;
                        sessionStorage.setItem('scrollPosition', scrollPos);
                    });

                    // Función para restaurar la posición después de que la página se recargue
                    window.addEventListener('load', function() {
                        // Verificar si hay una posición almacenada
                        if (sessionStorage.getItem('scrollPosition')) {
                            // Obtener la posición almacenada
                            var scrollPos = parseInt(sessionStorage.getItem('scrollPosition'));
                            // Restaurar la posición del scroll vertical
                            window.scrollTo(0, scrollPos);
                            // Eliminar la posición almacenada para futuras recargas
                            sessionStorage.removeItem('scrollPosition');
                        }
                    });
                </script>

                </body>

                </html>