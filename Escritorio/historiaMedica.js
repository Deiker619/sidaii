/* ///////////////////////////////////////////////////////////// */

var artificio; /* Principal */
var artificio_para_medidas;
$("#art-pro").hide();
$("#or").hide();
$("#or-inf").hide();
$("#artificioO").prop("selectedIndex", 0);
$("#art-ort").hide();

mostrarArtificio();

function mostrarArtificio() {
  nivel_amp();
  artificio = $("input[name='artificio']").val();
  $("input[name='artificio']").change(function () {
    artificio = this.value;

    if (this.value == "-protesis") {
      $("#art-ort").hide();
      $("#or").hide();
      $("#or-inf").hide();
      $("#pro").show();

      $("#art-pro").show();
      $("#artificioO").prop("selectedIndex", 0);
      artificio = this.value;
      console.log(artificio);

      nivel_amp();
    }

    if (this.value == "-ortesis") {
      $("#art-ort").show();
      $("#art-pro").hide();
      $("#pro").hide();
      $("#artificioP").prop("selectedIndex", 0);
      artificio = this.value;
      console.log(artificio);

      /* valor */

      ortesis();
      /*   nivel_amp() = null; */
    }
  });
}
/* Ortesis superior */
var lado_afect;
var dis_or;
var or_afect;
var nervio_afect;
var a;
/* ----------- */

/* Ortesis inferior */

var clasificacion;
var cmppp;

/* ________________ */

/* ORTESIS */
function ortesis() {
  artificio_para_medidas = $("select[name='artificioO']").val();
  $("select[name='artificioO']").change(function () {
    console.log(this.value);
    if (this.value == "ort-super") {
      $("#or").show();
      $("#or-inf").hide();
      $("#hombro-div").hide();
      $("#antebrazo").hide();

      artificio_para_medidas = this.value;
      cmppp = null;
      clasificacion = null;
      selec_lado_afect();
    }

    if (this.value == "ort-infe") {
      $("#or-inf").show();
      $("#or").hide();
      artificio_para_medidas = this.value;
      lado_afect = null;
      dis_or = null;
      or_afect = null;
      nervio_afect = null;
      a = null;

      CMPP();
      clasifcacion();
    }
  });
}

function clasifcacion() {
  $("input[name='clasificacion']").change(function () {
    console.log(this.value);
    clasificacion = this.value;
  });
}

function CMPP() {
  $("input[name='CMPP']").change(function () {
    console.log(this.value);
    cmppp = this.value;
  });
}

/* Ortesis superior */

function selec_lado_afect() {
  lado_afect = $("select[name='op-lugar-afect']").val();
  $("select[name='op-lugar-afect']").change(function () {
    console.log(this.value);

    if (!this.value) {
      $("#hombro-div").hide();
      $("#antebrazo").hide();
    }
    if (this.value == "hombro") {
      $("#hombro-div").show();
      $("#antebrazo").hide();
      lado_afect = this.value;
      hbc();
    }
    if (this.value == "antebrazo") {
      $("#hombro-div").hide();
      $("#antebrazo").show();
      lado_afect = this.value;
      anbrz();
    }
  });
}

function hbc() {
  $("input[name='hbc']").change(function () {
    console.log(this.value);
    a = this.value;
  });
}

function anbrz() {
  $("input[name='anbrz']").change(function () {
    console.log(this.value);
    a = this.value;
  });
}
/* 1 */
$("input[name='dis-or']").change(function () {
  console.log(this.value);
  dis_or = this.value;
});

/* 2 */

$("input[name='or-afect']").change(function () {
  console.log(this.value);
  or_afect = this.value;
});
/* 3 */

$("input[name='nervio-afect']").change(function () {
  console.log(this.value);
  nervio_afect = this.value;
});
/* _____________________________________________________________________ */

/* ///////////////////////////////////////////////////////////// */

/* PROTESIS */
var nivel_actividad;
var nivel_ampu;
var lado_amp;
var nivel_amp_br;
var nivel_amp_pier;
var nivel_amp_pie;
var niveles_AMPU;
var forma;
var Cicatriz;
var piel;
var Musculatura;
var diseno_pro;
var t_rodilla;
var t_socket;
var t_pie;
var c_socket;
var Meto_suspension;

function nivel_amp() {
  $("#niveles_ampu_pier").hide();
  $("#niveles_ampu_br").hide();
  $("#niveles_ampu_pies").hide();
  $("select[name='nivel_amp']").change(function () {
    console.log(this.value);

    switch (this.value) {
      case "Brazo":
        $("#niveles_ampu_pier").hide();
        $("#niveles_ampu_pies").hide();
        $("#niveles_ampu_br").show();
        break;

      case "Pierna":
        $("#niveles_ampu_br").hide();
        $("#niveles_ampu_pies").hide();
        $("#niveles_ampu_pier").show();
        break;

      case "Pie":
        $("#niveles_ampu_pier").hide();
        $("#niveles_ampu_br").hide();
        $("#niveles_ampu_pies").show();
        break;
      default:
        $("#niveles_ampu_pier").hide();
        $("#niveles_ampu_br").hide();
        $("#niveles_ampu_pies").hide();

        break;
    }

    nivel_ampu = this.value;
  });
}

$("input[name='nivel_actividad']").change(function () {
  console.log(this.value);
  nivel_actividad = this.value;
});

$("input[name='fecha_amp']").change(function () {
  console.log(this.value);
  fecha_amp = this.value;
});
$("input[name='causa_amp']").change(function () {
  console.log(this.value);
  causa_amp = this.value;
});

$("input[name='lado_amp']").change(function () {
  console.log(this.value);
  lado_amp = this.value;
});

$("input[name='nivel_amp_br']").change(function () {
  console.log(this.value);
  niveles_AMPU = this.value;
});

$("input[name='nivel_amp_pier']").change(function () {
  console.log(this.value);
  niveles_AMPU = this.value;
});
$("input[name='nivel_amp_pie']").change(function () {
  console.log(this.value);
  niveles_AMPU = this.value;
});
$("input[name='Forma']").change(function () {
  console.log(this.value);
  forma = this.value;
});
$("input[name='Cicatriz']").change(function () {
  console.log(this.value);
  Cicatriz = this.value;
});
$("input[name='piel']").change(function () {
  console.log(this.value);
  piel = this.value;
});

$("input[name='Musculatura']").change(function () {
  console.log(this.value);
  Musculatura = this.value;
});
$("select[name='diseno_pro']").change(function () {
  console.log(this.value);
  diseno_pro = this.value;
});
$("input[name='t_rodilla']").change(function () {
  console.log(this.value);
  t_rodilla = this.value;
});
$("input[name='t_pie']").change(function () {
  console.log(this.value);
  t_pie = this.value;
});
$("input[name='t_socket']").change(function () {
  console.log(this.value);
  t_socket = this.value;
});
$("input[name='c_socket']").change(function () {
  console.log(this.value);
  c_socket = this.value;
});
$("input[name='Meto_suspension']").change(function () {
  console.log(this.value);
  Meto_suspension = this.value;
});
