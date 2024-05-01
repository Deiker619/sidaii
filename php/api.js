function conapdis() {
  var inputValue = "";

  const { value: atencion } = Swal.fire({
    title: "Introduce la cedula para buscar en Conpadis",
    input: "text",
    inputLabel: "Introduce la cedula a buscar y registrar",
    inputValue: inputValue,
    showCancelButton: true,
    inputValidator: (value) => {
      if (!value) {
        return "Debes escribir algo";
      }
      if (value) {
        conexionApi(value);
        const Toast = Swal.mixin({
          toast: true,
          position: "bottom-start",
          showConfirmButton: false,
          timerProgressBar: true,
          didOpen: (toast) => {
            Swal.showLoading();
          },
        });

        Toast.fire({
          icon: "success",
          title: "Espera mientras recibimos respuesta",
        });
      }
    },
  });
}

async function conexionApi(a) {
  var apiUrl = "http://sistema.conapdis.gob.ve/API/";

  // Crea un objeto para los datos que deseas enviar en el cuerpo de la solicitud
  const requestData = {
    token: "f881ede039a464679de49b5fc6dc6553cf9cdb83",
    modulo: "Datos",
    cedula: a /* 10722053 */,
  };

  await fetch(apiUrl, {
    method: "POST",
    headers: {
      Accept: "*/*",
      "User-Agent": "Thunder Client (https://www.thunderclient.com)",
      "Content-Type": "application/json",
    },
    body: JSON.stringify(requestData), // Convierte los datos a formato JSON
  })
    .then(async function (response) {
      // Comprobamos si la respuesta de la API es exitosa (código 200 OK)
      if (!response.ok) {
        throw new Error("Error en la solicitud HTTP: " + response.status);
      }

      const datos = await response.json(); // Parseamos la respuesta JSON
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        customClass: {
          background: "#f03e31",
        },
      });
      if (datos.consult) {
        Toast.fire({
          icon: "success",
          title: datos.consult.nombres,
          html:
            "<b>Nombres: </b>" +
            datos.consult.nombres +
            "<br>" +
            "<b>Apellidos: </b>" +
            datos.consult.apellidos +
            "<br>" +
            "<b>Cedula: </b>" +
            datos.consult.cedula +
            "<br>" +
            "<b>Certificado: </b>" +
            datos.consult.Num_Certf +
            "<br>" +
            "<b>F-Nacimiento: </b>" +
            datos.consult.fecha_nacimiento +
            "<br>" +
            "<b>Sexo: </b>" +
            datos.consult.sexo +
            "<br>" +
            "<b>Estado civil: </b>" +
            datos.consult.estado_civil +
            "<br>" +
            "<b>Estado: </b>" +
            datos.consult.estado +
            "<br>" +
            "<b>Municipio: </b>" +
            datos.consult.municipio +
            "<br>" +
            "<b>Parroquia: </b>" +
            datos.consult.parroquia +
            "<br>" +
            "<b>Email: </b>" +
            datos.consult.correo_electronico +
            "<br>" +
            "<b>Discapacidad: </b>" +
            datos.consult.discapacidad +
            "<br>",
        });
  
        $("#cedula").val(datos.consult.cedula);
        $("#nombre").val(datos.consult.nombres);
        $("#apellido").val(datos.consult.apellidos);
        $("#telefono").val(datos.consult.telefono1);
        $("#fecha_naci").val(datos.consult.fecha_nacimiento);
        $("#carnet").val(datos.consult.Num_Certf);
        $("#email").val(datos.consult.correo_electronico);
      } else {
        Toast.fire({
          icon: "error",
          title: "No se encuentra la cedula",
        });
      }
      console.log(datos);
      

     
    })
    .catch(function (error) {
      console.error("Hubo un error:", error);
      const Toast = Swal.mixin({
        toast: true,
        position: "bottom-start",
        showConfirmButton: false,
        customClass: {
          background: "#f03e31",
        },
      });

      Toast.fire({
        icon: "error",
        title: "Se ha producido un error",
        text: "Falla en la comunicacion con CONAPDIS",
      });
    });
}

// Función para hacer una solicitud GET a la API
/* 
function conapdis() {
  var inputValue = "";

  const { value: atencion } = Swal.fire({
    title: "Introduce la cedula para buscar en Conpadis",
    input: "text",
    inputLabel: "Introduce la cedula a buscar y registrar",
    inputValue: inputValue,
    showCancelButton: true,
    inputValidator: (value) => {
      if (!value) {
        return "Debes escribir algo";
      }
      if (value) {
        conexionApi(value);
      }
    },
  });
}

async function conexionApi(a) {
  var apiUrl = `https://api.themoviedb.org/3/movie/${a}?api_key=c7f99338f598d05d279e42827b3f52ba&language=es-MX`;

  await fetch(apiUrl,{
    method: 'GET',
    headers: {
      'Accept': 'application/json', // Especifica el tipo de respuesta que esperas (JSON en este caso).
      // Otros encabezados si es necesario.
    },
  })
    .then(async function (response) {
      // Comprobamos si la respuesta de la API es exitosa (código 200 OK)
      if (!response.ok) {
        throw new Error("Error en la solicitud HTTP: " + response.status);
      }

      const datos = await response.json(); // Parseamos la respuesta JSON
      console.log(datos);
      Swal.fire({
        icon: "success",
        title: datos.title
      });
    })

    .catch(function (error) {
      console.error("Hubo un error:", error);
    });
}

 */
