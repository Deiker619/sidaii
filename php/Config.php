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

//Api Key 
define("API_KEY", ENV === "local"
	? "sk_sidaii_local_dev_2026"
	: (getenv("SIDAII_API_KEY") ?: "sk_cambiar_en_produccion")
);
define("API_RATE_LIMIT",	10); // max peticiones/minuto por IP
define("API_RATE_WINDOW",	60); // ventana en segundos

// Mail (SMTP) — usado por MailHelper para correos transaccionales
define("MAIL_HOST",		"smtp.gmail.com");
define("MAIL_PORT",		587);
define("MAIL_USERNAME",		"fmjghmail75@gmail.com");
define("MAIL_PASSWORD",		"*****");
define("MAIL_FROM",		"fmjghmail75@gmail.com");
define("MAIL_FROM_NAME",	"SIDAII - Registro Web");

// Rutas
define("BASE_URL",	ENV === "local" ? "http://localhost/sidaii" : "https://sidaii.fmjgh.gob.ve");
define("UPLOAD_PATH",	__DIR__ . "/../uploads");
