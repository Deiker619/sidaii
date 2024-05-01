$("#inicio").click(function (e) {
  var valid = this.form.checkValidity();
  if (valid) {
    var cedula = $("#cedula").val();
    var contraseña = $("#contraseña").val();

    e.preventDefault();

    // Intenta iniciar sesión
    $.ajax({
      type: "POST",
      url: "php/procesamientologin.php",
      data: {
        cedula: cedula,
        contraseña: contraseña,
      },
      success: function (data) {
   
        if (data == true) {
          window.location = "Escritorio/index.php";
          localStorage.setItem("intentos", 0); // Reiniciar el número de intentos en el almacenamiento local
        } else {
          var intentos = localStorage.getItem("intentos") || 0;
          intentos++;
          localStorage.setItem("intentos", intentos);

          if (intentos >= 3) {
            $.ajax({
              type: "POST",
              url: "php/bloquearUsuario.php",
              data: {
                cedula: cedula,
              },
            });
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Has alcanzado el límite de intentos. Tu cuenta ha sido bloqueada.",
            });
            localStorage.setItem("intentos", 0); // Restablecer el contador a 0
          } else {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Verifique cédula o contraseña",
            });
          }
        }

        if (data.trim() == "bloqueado") {
          /* usuario bloqueado */
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Tu cuenta ha sido bloqueada por exceso de intentos",
            footer: "Comuniquese con el departamento de tecnologia",
          });
        }
      },
      error: function (data) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Verifique cédula o contraseña",
        });
      },
    });
  }
});
