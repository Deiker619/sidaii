$(document).ready(function () {
  $("#rif-emprendimiento").hide();

  mostrarRif();

  $("#respuesta-rif").change(function () {
    mostrarRif();
  });
});

function mostrarRif() {
  if ($("#respuesta-rif").val() == "si") {
    $("#rif-emprendimiento").show();
  } else {
    $("#rif-emprendimiento").hide();
  }
}

$(document).ready(function () {
  $("#nombre-cuidador").hide();
  $("#cedula-cuidador").hide();
  mostrarContenido();

  $("#respuesta-cuidador").change(function () {
    mostrarContenido();
  });
});

function mostrarContenido() {
  if ($("#respuesta-cuidador").val() == "si") {
    $("#nombre-cuidador").show();
    $("#cedula-cuidador").show();
  } else {
    $("#nombre-cuidador").hide();
    $("#cedula-cuidador").hide();
  }
}

/* ============================================================ */
$(document).ready(function () {
  $("#nombre-emprendimiento").hide();
  $("#rif-emprendimiento").hide();
  $("#area-comercial").hide();
  $("#credito-bancario").hide();
  mostrarEmprendimiento();

  $("#respuesta-emprendimiento").change(function () {
    mostrarEmprendimiento();
  });
});

function mostrarEmprendimiento() {
  if ($("#respuesta-emprendimiento").val() == "si") {
    $("#nombre-emprendimiento").show();
    $("#area-comercial").show();
    $("#credito-bancario").show();
    $("#rifff").show();
  } else {
    $("#nombre-emprendimiento").hide();
    $("#rif-emprendimiento").hide();
    $("#area-comercial").hide();
    $("#credito-bancario").hide();
    $("#rifff").hide();
  }
}

$(document).ready(function () {
  $("#nombre-banco").hide();
  mostrarBanco();

  $("#respuesta-banco").change(function () {
    mostrarBanco();
  });
});

function mostrarBanco() {
  if ($("#respuesta-banco").val() == "si") {
    $("#nombre-banco").show();
  } else {
    $("#nombre-banco").hide();
  }
}

$(document).ready(function () {
  $("#nombre-institucional").hide();
  mostrarInstitucion();

  $("#respuesta-institucional").change(function () {
    mostrarInstitucion();
  });
});

function mostrarInstitucion() {
  if ($("#respuesta-institucional").val() == "si") {
    $("#nombre-institucional").show();
  } else {
    $("#nombre-institucional").hide();
  }
}
/* ///////////////////////////////////////////////////////////// */
$(document).ready(function () {
  $("#indigenas").hide();
  mostrarEtnia();

  $("#etnia").change(function () {
    mostrarEtnia();
  });
});

function mostrarEtnia() {
  if ($("#etnia").val() == "si") {
    $("#indigenas").show();
  } else {
    $("#indigenas").hide();
  }
}


$(document).ready(function () {
  $("#entrega_tecnica").hide();
  $("#entrega_orientado").hide();
  atenciones();

  /* funcion para los checkbox de toma de medidas */

  function atenciones() {
    $("input[name='atencion_especial']").change(function () {
      console.log(this.value + ":" + this.checked);
      if (this.value == "-orientado") {
        $("#entrega_remitir").hide();
        $("#entrega_tecnica").hide();
        $("#entrega_orientado").show();
        $("#remit").prop("selectedIndex", 0);
        $("#motivo").val("");
        $("#atencion_recibida").prop("selectedIndex", 0);
      }

      if (this.value == "-ayudatec") {
        $("#entrega_remitir").hide();
        $("#entrega_orientado").hide();
        $("#entrega_tecnica").show();
        $("#remit").prop("selectedIndex", 0);
        $("#descrip_orientacion").val("");
      }

      if (this.value == "-remitido") {
        $("#entrega_remitir").show();
        $("#entrega_orientado").hide();
        $("#entrega_tecnica").hide();
        $("#atencion_recibida").prop("selectedIndex", 0);
        $("#descrip_orientacion").val("");
      }
    });
  }
});
