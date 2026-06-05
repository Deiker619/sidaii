<?php
/* // Variables Postgresql
define(	"SRV",	"localhost");
define(	"USR",	"fran");
define(	"PAS",	"pacopepe");
define(	"BDN",	"proyecto"); */

// Variables Mysql
define(	"SRV",	"localhost");
define(	"USR",	"fmjgh");
define(	"PAS",	"misionfmjgh");
define(	"BDN",	"conapdis");


define("ENV", file_exists(__DIR__ . "/.env.local") ? "local" : "production");

// API Key para conectar WordPress → SIDAII
// En local usa clave predefinida, en producción usa variable de entorno
define("API_KEY", ENV === "local"
	? "sk_sidaii_local_dev_2026"
	: (getenv("SIDAII_API_KEY") ?: "sk_cambiar_en_produccion")
);
define("API_RATE_LIMIT",	10); // max peticiones/minuto por IP
define("API_RATE_WINDOW",	60); // ventana en segundos

// Rutas
define("BASE_URL",	ENV === "local" ? "http://localhost/sidaii" : "https://sidaii.fmjgh.gob.ve");
define("UPLOAD_PATH",	__DIR__ . "/../uploads");
