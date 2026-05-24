<?php
/**
* Plugin Name: Formulario de Registro de Beneficiarios FMJGH
* Description: Formulario de registro para el Sistema Integral de Desarrollo para Personas con Discapacidad - CONAPDIS
* Version: 3.0.1
* Author: Sistema de Discapacidad
* Requires PHP: 7.4
*/
if (!defined('ABSPATH')) {
	exit;
}
define('BENEFICIARIO_VERSION', '3.1.0');
define('BENEFICIARIO_UPLOAD_DIR', 'beneficiarios_documentos');
define('CONAPDIS_DB_NAME', 'conapdis');
define('SIDAII_API_URL', defined('WP_SIDAII_API_URL') ? WP_SIDAII_API_URL : 'http://localhost/sidaii/php/api_conapdis.php');
define('SIDAII_API_KEY', defined('WP_SIDAII_API_KEY') ? WP_SIDAII_API_KEY : 'sk_sidaii_local_dev_2026');

class CONAPDIS_Beneficiario_Form {
	private static $instance = null;
	private $tabla_beneficiarios;
	private $tabla_documentos;
	private $db_conapdis;

	public static function get_instance() {
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->tabla_beneficiarios = 'beneficiario';
		$this->tabla_documentos    = 'conapdis_documentos';
		$this->inicializar_db_conapdis();
		$this->init_hooks();
	}

	private function inicializar_db_conapdis() {
		global $wpdb;
		try {
			$this->db_conapdis = new wpdb(DB_USER, DB_PASSWORD, CONAPDIS_DB_NAME, DB_HOST);
			if (!empty($this->db_conapdis->connect_error)) {
				throw new Exception('Connection failed');
			}
			$this->db_conapdis->set_charset($this->db_conapdis->dbh, defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4');
			$this->tabla_beneficiarios = 'beneficiario';
			$this->tabla_documentos    = 'conapdis_documentos';
		} catch (Exception $e) {
			error_log('CONAPDIS: Usando base de datos WordPress por error de conexión: ' . $e->getMessage());
			$this->db_conapdis = $wpdb;
			$prefix = !empty($wpdb->prefix) ? $wpdb->prefix : 'wp_';
			$this->tabla_beneficiarios = $prefix . 'beneficiario';
			$this->tabla_documentos    = $prefix . 'conapdis_documentos';
		}
	}

	private function verificar_o_crear_db_conapdis() {
		global $wpdb;
		$db_exists = $wpdb->get_var("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'conapdis'");
		if (!$db_exists) {
			$wpdb->query("CREATE DATABASE IF NOT EXISTS `conapdis` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
		}
		$this->inicializar_db_conapdis();
		$this->recrear_tabla_completa();
	}

	/**
	* Recrea la tabla completa con todas las columnas necesarias
	*/
	private function recrear_tabla_completa() {
		if (empty($this->db_conapdis)) return;
		$this->validar_nombres_tablas();
		$charset_collate = $this->db_conapdis->get_charset_collate();
		
		// Verificar si la tabla existe
		$tabla_existe = $this->db_conapdis->get_var(
			$this->db_conapdis->prepare("SHOW TABLES LIKE %s", $this->tabla_beneficiarios)
		);
		
		if ($tabla_existe) {
			// Hacer backup de datos existentes si los hay
			$backup_tabla = $this->tabla_beneficiarios . '_backup_' . date('Ymd_His');
			$this->db_conapdis->query("CREATE TABLE IF NOT EXISTS `{$backup_tabla}` LIKE `{$this->tabla_beneficiarios}`");
			$this->db_conapdis->query("INSERT INTO `{$backup_tabla}` SELECT * FROM `{$this->tabla_beneficiarios}`");
			// Eliminar tabla existente
			$this->db_conapdis->query("DROP TABLE IF EXISTS `{$this->tabla_beneficiarios}`");
			error_log("CONAPDIS: Tabla antigua respaldada como '{$backup_tabla}' y eliminada.");
		}

		// Crear tabla con estructura completa
		$sql_beneficiarios = "CREATE TABLE `{$this->tabla_beneficiarios}` (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			nombre varchar(100) NOT NULL,
			apellido varchar(100) NOT NULL,
			cedula varchar(20) NOT NULL,
			nacionalidad varchar(2) DEFAULT 'V',
			correo varchar(100) DEFAULT NULL,
			telefono varchar(20) DEFAULT NULL,
			fecha_nacimiento date NOT NULL,
			edad int(3) DEFAULT NULL,
			sexo varchar(1) DEFAULT 'M',
			numero_hijos int(2) DEFAULT 0,
			estado_civil varchar(20) DEFAULT NULL,
			pertenece_etnia varchar(2) DEFAULT 'no',
			etnia varchar(50) DEFAULT NULL,
			estado varchar(100) NOT NULL,
			municipio varchar(100) NOT NULL,
			distrito varchar(100) NOT NULL,
			direccion text NOT NULL,
			tipo_discapacidad varchar(100) NOT NULL,
			numero_certificado varchar(50) DEFAULT NULL,
			tipo_atencion_solicitada varchar(100) DEFAULT NULL,
			tipo_ayuda_tecnica varchar(100) DEFAULT NULL,
			recibe_bono_jose_gregorio varchar(2) DEFAULT 'no',
			cuidador_nombre varchar(100) DEFAULT NULL,
			cuidador_cedula varchar(20) DEFAULT NULL,
			nivel_academico varchar(50) DEFAULT NULL,
			profesion_oficio varchar(100) DEFAULT NULL,
			labora_actualmente varchar(2) DEFAULT 'no',
			tiene_emprendimiento varchar(2) DEFAULT 'no',
			nombre_emprendimiento varchar(100) DEFAULT NULL,
			rif_emprendimiento varchar(20) DEFAULT NULL,
			area_comercial varchar(50) DEFAULT NULL,
			tiene_credito_bancario varchar(2) DEFAULT 'no',
			nombre_banco varchar(100) DEFAULT NULL,
			usuario_registrador varchar(100) DEFAULT NULL,
			estado_registro enum('pendiente','aprobado','rechazado') DEFAULT 'pendiente',
			fecha_registro datetime DEFAULT CURRENT_TIMESTAMP,
			fecha_actualizacion datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			ip_registro varchar(45) DEFAULT NULL,
			PRIMARY KEY (id),
			UNIQUE KEY idx_cedula (cedula),
			KEY idx_estado (estado),
			KEY idx_fecha_registro (fecha_registro)
		) {$charset_collate}";
		
		$resultado = $this->db_conapdis->query($sql_beneficiarios);
		if ($resultado !== false) {
			error_log('CONAPDIS: Tabla beneficiario recreada exitosamente con estructura completa.');
			// Restaurar datos del backup si existían
			if ($tabla_existe && isset($backup_tabla)) {
				$columnas_backup = $this->db_conapdis->get_results("DESCRIBE `{$backup_tabla}`");
				$columnas_backup_nombres = array();
				foreach ($columnas_backup as $col) {
					$columnas_backup_nombres[] = $col->Field;
				}
				$columnas_insert = array();
				foreach (array('id', 'nombre', 'apellido', 'cedula', 'nacionalidad', 'correo', 'telefono', 'estado', 'municipio', 'direccion', 'tipo_discapacidad', 'fecha_registro') as $col) {
					if (in_array($col, $columnas_backup_nombres)) {
						$columnas_insert[] = $col;
					}
				}
				if (!empty($columnas_insert)) {
					$columnas_str = implode(', ', $columnas_insert);
					$this->db_conapdis->query("INSERT IGNORE INTO `{$this->tabla_beneficiarios}` ({$columnas_str}) SELECT {$columnas_str} FROM `{$backup_tabla}`");
					error_log('CONAPDIS: Datos restaurados desde backup.');
				}
			}
		} else {
			error_log('CONAPDIS Error al crear tabla: ' . $this->db_conapdis->last_error);
		}

		// Crear tabla de documentos
		$tabla_documentos_existe = $this->db_conapdis->get_var(
			$this->db_conapdis->prepare("SHOW TABLES LIKE %s", $this->tabla_documentos)
		);
		if (!$tabla_documentos_existe) {
			$sql_documentos = "CREATE TABLE IF NOT EXISTS `{$this->tabla_documentos}` (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				beneficiario_id bigint(20) NOT NULL,
				tipo_documento enum('cedula','informe_medico','fotografia','solicitud') NOT NULL,
				nombre_archivo varchar(255) NOT NULL,
				ruta_archivo varchar(500) NOT NULL,
				tamano_archivo int(11) DEFAULT NULL,
				fecha_subida datetime DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (id),
				KEY idx_beneficiario (beneficiario_id)
			) {$charset_collate};";
			$this->db_conapdis->query($sql_documentos);
			error_log('CONAPDIS: Tabla documentos creada exitosamente.');
		}
	}

	/**
	* Verificar y reparar la estructura de la tabla
	*/
	private function verificar_y_reparar_estructura() {
		if (empty($this->db_conapdis)) return;
		
		$tabla_existe = $this->db_conapdis->get_var(
			$this->db_conapdis->prepare("SHOW TABLES LIKE %s", $this->tabla_beneficiarios)
		);
		
		if (!$tabla_existe) {
			$this->recrear_tabla_completa();
			return;
		}

		// Verificar columnas críticas (incluye numero_certificado para evitar errores de INSERT)
		$columnas_criticas = array('tipo_discapacidad', 'fecha_nacimiento', 'direccion', 'numero_hijos', 'numero_certificado');
		$columnas_faltantes = array();
		$columnas = $this->db_conapdis->get_results("DESCRIBE `{$this->tabla_beneficiarios}`");
		$columnas_existentes = array();
		foreach ($columnas as $col) {
			$columnas_existentes[] = $col->Field;
		}
		
		foreach ($columnas_criticas as $columna) {
			if (!in_array($columna, $columnas_existentes)) {
				$columnas_faltantes[] = $columna;
			}
		}

		if (!empty($columnas_faltantes)) {
			error_log("CONAPDIS: Faltan columnas críticas: " . implode(', ', $columnas_faltantes));
			$this->recrear_tabla_completa();
		}
	}

	private function validar_nombres_tablas() {
		if (empty($this->tabla_beneficiarios)) {
			$prefix = !empty($this->db_conapdis->prefix) ? $this->db_conapdis->prefix : 'wp_';
			$this->tabla_beneficiarios = $prefix . 'beneficiario';
		}
		if (empty($this->tabla_documentos)) {
			$prefix = !empty($this->db_conapdis->prefix) ? $this->db_conapdis->prefix : 'wp_';
			$this->tabla_documentos = $prefix . 'conapdis_documentos';
		}
	}

	private function init_hooks() {
		register_activation_hook(__FILE__, array($this, 'activar_plugin'));
		register_deactivation_hook(__FILE__, array($this, 'desactivar_plugin'));
		add_shortcode('formulario_beneficiario', array($this, 'renderizar_formulario'));
		add_shortcode('conapdis_formulario', array($this, 'renderizar_formulario'));
		add_action('wp_ajax_beneficiario_submit', array($this, 'procesar_formulario'));
		add_action('wp_ajax_nopriv_beneficiario_submit', array($this, 'procesar_formulario'));
		add_action('wp_ajax_verificar_cedula', array($this, 'verificar_cedula_existente'));
		add_action('wp_ajax_nopriv_verificar_cedula', array($this, 'verificar_cedula_existente'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
		add_filter('body_class', array($this, 'add_body_classes'));
		add_action('admin_init', array($this, 'admin_init_hook'));
	}

	public function admin_init_hook() {
		if (current_user_can('manage_options')) {
			$this->verificar_y_reparar_estructura();
		}
	}

	public function activar_plugin() {
		$this->verificar_o_crear_db_conapdis();
		$this->verificar_y_reparar_estructura();
		$upload_dir = wp_upload_dir();
		$beneficiario_dir = $upload_dir['basedir'] . '/' . BENEFICIARIO_UPLOAD_DIR;
		if (!file_exists($beneficiario_dir)) {
			wp_mkdir_p($beneficiario_dir);
			$htaccess_content = "# Protección de archivos de beneficiarios CONAPDIS
<FilesMatch '\.(pdf|jpg|jpeg|png)$'>
Order Allow,Deny
Deny from all
</FilesMatch>
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
</IfModule>";
			file_put_contents($beneficiario_dir . '/.htaccess', $htaccess_content);
			file_put_contents($beneficiario_dir . '/index.php', '<?php // Silence is golden');
		}
		update_option('beneficiario_db_version', BENEFICIARIO_VERSION);
	}

	public function desactivar_plugin() {}

	public function add_body_classes($classes) {
		global $post;
		if (is_a($post, 'WP_Post') &&
			(has_shortcode($post->post_content, 'formulario_beneficiario') ||
			has_shortcode($post->post_content, 'conapdis_formulario'))) {
			$classes[] = 'conapdis-form-page';
		}
		return $classes;
	}

	public function enqueue_assets() {
		global $post;
		if (is_a($post, 'WP_Post') &&
			(has_shortcode($post->post_content, 'formulario_beneficiario') ||
			has_shortcode($post->post_content, 'conapdis_formulario'))) {
			wp_enqueue_script('sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', array(), '11.0', true);
			wp_enqueue_script('jquery');
			wp_localize_script('jquery', 'beneficiario_ajax', array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'api_url' => SIDAII_API_URL,
				'api_key' => SIDAII_API_KEY,
				'nonce' => wp_create_nonce('beneficiario_nonce'),
				'max_file_size' => 5 * 1024 * 1024,
				'allowed_types' => array('pdf', 'jpg', 'jpeg', 'png')
			));
		}
	}

	private function limpiar_cedula($cedula) {
		if (empty($cedula)) return '';
		$cedula = strtoupper(trim($cedula));
		$cedula = preg_replace('/^[VE]/i', '', $cedula);
		$cedula = preg_replace('/[^0-9]/', '', $cedula);
		return $cedula;
	}

	private function cedula_existe($cedula) {
		$cedula_limpia = $this->limpiar_cedula($cedula);
		if (empty($cedula_limpia)) return false;
		return (bool) $this->db_conapdis->get_var(
			$this->db_conapdis->prepare(
				"SELECT id FROM {$this->tabla_beneficiarios} WHERE cedula = %s LIMIT 1",
				$cedula_limpia
			)
		);
	}

	public function renderizar_formulario() {
		ob_start();
		?>
		<style>
		.conapdis-form-container { max-width: 100%; margin: 0; padding: 0; background: transparent; }
		.conapdis-form-wrapper { background: #fff; border-radius: 8px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); padding: 30px; margin: 20px 0; }
		.conapdis-header { text-align: center; margin-bottom: 30px; padding: 25px 20px; background: linear-gradient(135deg, #1e3a5f 0%, #2d5a87 100%); color: white; border-radius: 8px; }
		.conapdis-header h1 { font-size: 1.8rem; margin: 0 0 10px; color: white !important; }
		.conapdis-header p { margin: 0; opacity: 0.9; }
		.conapdis-card { background: #fff; border-radius: 8px; margin-bottom: 25px; border: 1px solid #e5e5e5; overflow: hidden; }
		.conapdis-card-header { background: #f8f9fa; padding: 15px 20px; border-bottom: 1px solid #e5e5e5; }
		.conapdis-card-header h2 { font-size: 1.2rem; margin: 0; color: #1e3a5f; }
		.conapdis-card-header p { margin: 5px 0 0; font-size: 0.85rem; color: #666; }
		.conapdis-card-body { padding: 20px; }
		.conapdis-form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
		.conapdis-form-group { display: flex; flex-direction: column; }
		.conapdis-form-group.full-width { grid-column: 1 / -1; }
		.conapdis-form-group label { font-weight: 600; margin-bottom: 8px; color: #333; font-size: 0.9rem; }
		.conapdis-form-group label .required { color: #d9534f; }
		.conapdis-form-group input, .conapdis-form-group select, .conapdis-form-group textarea { padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 0.95rem; width: 100%; background: #fff; transition: border-color 0.2s; }
		.conapdis-form-group input:focus, .conapdis-form-group select:focus, .conapdis-form-group textarea:focus { outline: none; border-color: #1e3a5f; box-shadow: 0 0 0 2px rgba(30,58,95,0.1); }
		.conapdis-checkbox-group { display: flex; align-items: center; gap: 10px; margin-top: 8px; }
		.conapdis-checkbox-group input[type="checkbox"] { width: 18px; height: 18px; }
		.conapdis-checkbox-group label { margin-bottom: 0; font-weight: normal; }
		.conapdis-etnia-section { margin-top: 15px; padding: 15px; background: #f8f9fa; border-radius: 6px; border: 1px solid #e5e5e5; }
		.conapdis-file-item { display: flex; align-items: center; padding: 12px; background: #f8f9fa; border: 1px solid #e5e5e5; border-radius: 6px; margin-bottom: 10px; }
		.conapdis-file-item label { margin-bottom: 0; flex: 1; cursor: pointer; font-weight: 500; }
		.conapdis-file-item input[type="file"] { border: none; padding: 0; width: auto; }
		.conapdis-file-status { font-size: 0.75rem; margin-top: 5px; }
		.conapdis-file-status.valid { color: #28a745; }
		.conapdis-file-status.invalid { color: #dc3545; }
		.conapdis-cedula-status { font-size: 0.75rem; margin-top: 5px; min-height: 20px; }
		.conapdis-cedula-status.valid { color: #28a745; }
		.conapdis-cedula-status.invalid { color: #dc3545; }
		.conapdis-cedula-status.checking { color: #ffc107; }
		.conapdis-btn { display: inline-flex; align-items: center; justify-content: center; padding: 14px 32px; font-size: 1rem; font-weight: 600; border: none; border-radius: 4px; cursor: pointer; transition: all 0.2s; background: linear-gradient(135deg, #1e3a5f 0%, #2d5a87 100%); color: white; }
		.conapdis-btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(30,58,95,0.3); color: white; }
		.conapdis-btn:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }
		.conapdis-submit-container { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e5e5; }
		.conapdis-loading { display: none; text-align: center; padding: 30px; }
		.conapdis-spinner { border: 4px solid #f3f3f3; border-top: 4px solid #1e3a5f; border-radius: 50%; width: 40px; height: 40px; animation: conapdis-spin 1s linear infinite; margin: 0 auto 15px; }
		@keyframes conapdis-spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
		.conapdis-spinner-small { display: inline-block; width: 12px; height: 12px; border: 2px solid #ffc107; border-top-color: #856404; border-radius: 50%; animation: conapdis-spin 0.8s linear infinite; margin-right: 5px; }
		.conapdis-field-hidden { display: none; }
		.conapdis-hint { font-size: 0.7rem; color: #6c757d; margin-top: 4px; }
		.conapdis-documents-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; }
		.conapdis-document-item { background: #f8f9fa; border: 1px solid #e5e5e5; border-radius: 8px; padding: 15px; }
		.conapdis-document-item label { font-weight: 600; color: #1e3a5f; display: block; margin-bottom: 10px; }
		.conapdis-document-item .required { color: #d9534f; }
		@media (max-width: 768px) { .conapdis-form-wrapper { padding: 15px; } .conapdis-form-grid { grid-template-columns: 1fr; } .conapdis-header h1 { font-size: 1.4rem; } .conapdis-documents-grid { grid-template-columns: 1fr; } }
		.conapdis-loading-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 99999; justify-content: center; align-items: center; }
		.conapdis-loading-content { background: white; padding: 30px; border-radius: 10px; text-align: center; min-width: 200px; }
		.conapdis-form-group input.conapdis-valid { border-color: #28a745; background-color: #f0fff4; }
		.conapdis-form-group input.conapdis-invalid { border-color: #dc3545; background-color: #fff5f5; }
		.conapdis-error-message { font-size: 0.7rem; color: #dc3545; margin-top: 4px; display: none; }
		.conapdis-error-message.visible { display: block; }
		fieldset { margin-top: 20px; padding: 15px; border-radius: 8px; border: 1px solid #ddd; }
		legend { padding: 0 10px; color: #666; font-weight: 500; }
		</style>
		<div class="conapdis-form-container">
			<div class="conapdis-form-wrapper">
				<div class="conapdis-header">
					<h1>Registro de Beneficiarios FMJGH</h1>
					<p>Sistema Integral de Desarrollo para Personas con Discapacidad</p>
					<p style="font-size: 0.9rem; margin-top: 10px;">Fundación Misión José Gregorio Hernández</p>
				</div>
				<div class="conapdis-loading-overlay" id="conapdisLoadingOverlay">
					<div class="conapdis-loading-content">
						<div class="conapdis-spinner"></div>
						<p>Procesando registro...</p>
					</div>
				</div>
				<form id="conapdisForm" method="post" enctype="multipart/form-data">
					<!-- Datos Personales -->
					<div class="conapdis-card">
						<div class="conapdis-card-header"><h2>📋 Datos Personales</h2></div>
						<div class="conapdis-card-body">
							<div class="conapdis-form-grid">
								<div class="conapdis-form-group">
									<label for="nombre">Nombre <span class="required">*</span></label>
									<input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
								</div>
								<div class="conapdis-form-group">
									<label for="apellido">Apellido <span class="required">*</span></label>
									<input type="text" id="apellido" name="apellido" placeholder="Ingrese su apellido" required>
								</div>
								<div class="conapdis-form-group">
									<label for="cedula">Cédula de Identidad <span class="required">*</span></label>
									<input type="text" id="cedula" name="cedula" placeholder="Ej: 12345678" required>
									<span class="conapdis-hint">Ingrese solo números (se eliminarán automáticamente letras V/E, puntos y guiones).</span>
									<div class="conapdis-cedula-status" id="cedulaStatus"></div>
								</div>
								<div class="conapdis-form-group">
									<label for="nacionalidad">Nacionalidad <span class="required">*</span></label>
									<select id="nacionalidad" name="nacionalidad" required>
										<option value="V">Venezolano</option>
										<option value="E">Extranjero</option>
									</select>
								</div>
								<div class="conapdis-form-group">
									<label for="correo">Correo Electrónico</label>
									<input type="email" id="correo" name="correo" placeholder="correo@ejemplo.com">
								</div>
								<div class="conapdis-form-group">
									<label for="telefono">Teléfono <span class="required">*</span></label>
									<input type="tel" id="telefono" name="telefono" placeholder="04121234567" required>
								</div>
								<div class="conapdis-form-group">
									<label for="fechaNacimiento">Fecha de Nacimiento <span class="required">*</span></label>
									<input type="date" id="fechaNacimiento" name="fechaNacimiento" required>
								</div>
								<div class="conapdis-form-group">
									<label for="edad">Edad</label>
									<input type="number" id="edad" name="edad" placeholder="Edad" readonly>
								</div>
								<div class="conapdis-form-group">
									<label for="sexo">Sexo <span class="required">*</span></label>
									<select id="sexo" name="sexo" required>
										<option value="M">Masculino</option>
										<option value="F">Femenino</option>
									</select>
								</div>
								<div class="conapdis-form-group">
									<label for="numeroHijos">Número de Hijos</label>
									<input type="number" id="numeroHijos" name="numeroHijos" value="0" min="0">
								</div>
								<div class="conapdis-form-group">
									<label for="estadoCivil">Estado Civil</label>
									<select id="estadoCivil" name="estadoCivil">
										<option value="soltero/a">Soltero/a</option>
										<option value="casado/a">Casado/a</option>
										<option value="divorciado/a">Divorciado/a</option>
										<option value="viudo/a">Viudo/a</option>
									</select>
								</div>
							</div>
							<div class="conapdis-etnia-section">
								<label>¿Pertenece a una etnia indígena?</label>
								<div class="conapdis-checkbox-group">
									<input type="checkbox" id="perteneceEtnia" name="perteneceEtnia">
									<label for="perteneceEtnia">Sí, pertenezco a una etnia indígena</label>
								</div>
								<div id="etniaSelectContainer" style="display: none; margin-top: 15px;">
									<label for="etnia">Etnia</label>
									<select id="etnia" name="etnia">
										<option value="">Seleccione su etnia</option>
										<option value="Wayúu">Wayúu</option>
										<option value="Warao">Warao</option>
										<option value="Pemón">Pemón</option>
										<option value="Yanomami">Yanomami</option>
										<option value="Kariña">Kariña</option>
										<option value="Piaroa">Piaroa</option>
										<option value="Ye'kuana">Ye'kuana</option>
										<option value="Añú">Añú</option>
										<option value="Cumanagoto">Cumanagoto</option>
										<option value="Chaima">Chaima</option>
										<option value="Otra">Otra</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<!-- Dirección de Residencia -->
					<div class="conapdis-card">
						<div class="conapdis-card-header"><h2>📍 Dirección de Residencia</h2></div>
						<div class="conapdis-card-body">
							<div class="conapdis-form-grid">
								<div class="conapdis-form-group">
									<label for="estado">Estado <span class="required">*</span></label>
									<select id="estado" name="estado" required>
										<option value="">Seleccione estado</option>
									</select>
								</div>
								<div class="conapdis-form-group">
									<label for="municipio">Municipio <span class="required">*</span></label>
									<select id="municipio" name="municipio" disabled>
										<option value="">Seleccione municipio</option>
									</select>
								</div>
								<div class="conapdis-form-group">
									<label for="parroquia">Parroquia <span class="required">*</span></label>
									<select id="parroquia" name="parroquia" disabled>
										<option value="">Seleccione parroquia</option>
									</select>
								</div>
								<div class="conapdis-form-group full-width">
									<label for="direccion">Dirección / Calle / Casa <span class="required">*</span></label>
									<textarea id="direccion" name="direccion" rows="3" placeholder="Ingrese su dirección completa" required></textarea>
								</div>
							</div>
						</div>
					</div>
					<!-- Tipo de Discapacidad -->
					<div class="conapdis-card">
						<div class="conapdis-card-header"><h2>🩺 Tipo de Discapacidad</h2></div>
						<div class="conapdis-card-body">
							<div class="conapdis-form-grid">
								<div class="conapdis-form-group">
									<label for="tipoDiscapacidad">Tipo de Discapacidad <span class="required">*</span></label>
									<select id="tipoDiscapacidad" name="tipoDiscapacidad" required>
										<option value="">Cargando...</option>
									</select>
								</div>
								<div class="conapdis-form-group">
									<label for="numeroCertificado">Número de Certificado</label>
									<input type="text" id="numeroCertificado" name="numeroCertificado" placeholder="Ej: CERT-12345">
								</div>
								<div class="conapdis-form-group">
									<label for="tipoAtencionSolicitada">Tipo de Atención Solicitada <span class="required">*</span></label>
									<select id="tipoAtencionSolicitada" name="tipoAtencionSolicitada" required>
										<option value="">Seleccione</option>
										<option value="Atención a través de coordinación estadal">Atención a través de coordinación estadal</option>
										<option value="Atención a través de OAC">Atención a través de OAC</option>
										<option value="Cita laboratorio órtesis y prótesis">Cita laboratorio órtesis y prótesis</option>
										<option value="Reparación Artificio">Reparación Artificio</option>
										<option value="Audiometría">Audiometría</option>
										<option value="Rehabilitación">Rehabilitación</option>
										<option value="Participante de taller">Participante de taller</option>
										<option value="Participante de encuentro">Participante de encuentro</option>
									</select>
								</div>
								<div class="conapdis-form-group conapdis-field-hidden" id="ayudaTecnicaBox">
									<label for="tipoAyudaTecnica">Tipo de Ayuda Técnica a Otorgar</label>
									<select id="tipoAyudaTecnica" name="tipoAyudaTecnica">
										<option value="">Seleccione</option>
										<option value="No requiere ayuda">No requiere ayuda</option>
										<option value="Silla de ruedas estándar">Silla de ruedas estándar</option>
										<option value="Silla de ruedas ergonómica">Silla de ruedas ergonómica</option>
										<option value="Silla de ruedas reclinable">Silla de ruedas reclinable</option>
										<option value="Silla de ruedas pediátrica">Silla de ruedas pediátrica</option>
										<option value="Silla de ruedas bariátrica">Silla de ruedas bariátrica</option>
										<option value="Silla a motor">Silla a motor</option>
										<option value="Muletas">Muletas</option>
										<option value="Andadera">Andadera</option>
										<option value="Bastón">Bastón</option>
										<option value="Prótesis">Prótesis</option>
										<option value="Órtesis">Órtesis</option>
										<option value="Audífono">Audífono</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<!-- Documentos Requeridos -->
					<div class="conapdis-card">
						<div class="conapdis-card-header">
							<h2>📎 Documentos Requeridos</h2>
							<p>Adjunte los siguientes documentos en formato PDF, JPG o PNG. Tamaño máximo: 5MB por archivo.</p>
						</div>
						<div class="conapdis-card-body">
							<div class="conapdis-documents-grid">
								<div class="conapdis-document-item">
									<label>1. Cédula de Identidad <span class="required">*</span></label>
									<input type="file" id="doc_cedula" name="doc_cedula" accept=".pdf,.jpg,.jpeg,.png" required>
									<span class="conapdis-hint">Copia de cédula (ambos lados si es posible)</span>
									<div class="conapdis-file-status" id="doc_cedula_status"></div>
								</div>
								<div class="conapdis-document-item">
									<label>2. Informe Médico <span class="required">*</span></label>
									<input type="file" id="doc_informe" name="doc_informe" accept=".pdf,.jpg,.jpeg,.png" required>
									<span class="conapdis-hint">Documento que certifique la condición médica</span>
									<div class="conapdis-file-status" id="doc_informe_status"></div>
								</div>
								<div class="conapdis-document-item">
									<label>3. Fotografía Cuerpo Entero <span class="required">*</span></label>
									<input type="file" id="doc_foto" name="doc_foto" accept=".pdf,.jpg,.jpeg,.png" required>
									<span class="conapdis-hint">Foto reciente cuerpo entero</span>
									<div class="conapdis-file-status" id="doc_foto_status"></div>
								</div>
								<div class="conapdis-document-item">
									<label>4. Documento de Solicitud <span class="required">*</span></label>
									<input type="file" id="doc_solicitud" name="doc_solicitud" accept=".pdf,.jpg,.jpeg,.png" required>
									<span class="conapdis-hint">Formato de solicitud firmado</span>
									<div class="conapdis-file-status" id="doc_solicitud_status"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- Datos Adicionales -->
					<div class="conapdis-card">
						<div class="conapdis-card-header"><h2>ℹ️ Datos Adicionales</h2></div>
						<div class="conapdis-card-body">
							<fieldset>
								<legend>Cuidador o Representante</legend>
								<div class="conapdis-form-grid">
									<div class="conapdis-form-group">
										<label for="tieneCuidador">¿Posee cuidador o representante?</label>
										<select id="tieneCuidador" name="tieneCuidador">
											<option value="no">No</option>
											<option value="si">Sí</option>
										</select>
									</div>
									<div class="conapdis-form-group conapdis-field-hidden" id="cuidadorNombreContainer">
										<label for="cuidadorNombre">Nombre del cuidador o representante</label>
										<input type="text" id="cuidadorNombre" name="cuidadorNombre" placeholder="Ingrese el nombre">
									</div>
									<div class="conapdis-form-group conapdis-field-hidden" id="cuidadorCedulaContainer">
										<label for="cuidadorCedula">Cédula del cuidador o representante</label>
										<input type="text" id="cuidadorCedula" name="cuidadorCedula" placeholder="Ingrese la cédula">
									</div>
								</div>
							</fieldset>
							<fieldset>
								<legend>Formación y Empleo</legend>
								<div class="conapdis-form-grid">
									<div class="conapdis-form-group">
										<label for="nivelAcademico">Nivel académico</label>
										<select id="nivelAcademico" name="nivelAcademico">
											<option value="Ninguno">Ninguno</option>
											<option value="Educación preescolar">Educación preescolar</option>
											<option value="Educación primaria">Educación primaria</option>
											<option value="Educación secundaria">Educación secundaria</option>
											<option value="Técnico Superior">Técnico Superior</option>
											<option value="Educación superior">Educación superior</option>
										</select>
									</div>
									<div class="conapdis-form-group">
										<label for="profesion">Profesión u oficio</label>
										<input type="text" id="profesion" name="profesion" placeholder="Ingrese su profesión u oficio">
									</div>
									<div class="conapdis-form-group">
										<label for="labora">¿Labora actualmente?</label>
										<select id="labora" name="labora">
											<option value="no">No</option>
											<option value="si">Sí</option>
										</select>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<legend>Emprendimiento</legend>
								<div class="conapdis-form-grid">
									<div class="conapdis-form-group">
										<label for="tieneEmprendimiento">¿Posee emprendimiento?</label>
										<select id="tieneEmprendimiento" name="tieneEmprendimiento">
											<option value="no">No</option>
											<option value="si">Sí</option>
										</select>
									</div>
									<div class="conapdis-form-group conapdis-field-hidden" id="nombreEmprendimientoContainer">
										<label for="nombreEmprendimiento">Nombre del emprendimiento</label>
										<input type="text" id="nombreEmprendimiento" name="nombreEmprendimiento">
									</div>
									<div class="conapdis-form-group conapdis-field-hidden" id="rifEmprendimientoContainer">
										<label for="rifEmprendimiento">RIF del emprendimiento</label>
										<input type="text" id="rifEmprendimiento" name="rifEmprendimiento">
									</div>
									<div class="conapdis-form-group conapdis-field-hidden" id="areaComercialContainer">
										<label for="areaComercial">Área comercial</label>
										<select id="areaComercial" name="areaComercial">
											<option value="">Seleccione</option>
											<option value="Textil">Textil</option>
											<option value="Alimentos">Alimentos</option>
											<option value="Artesanal">Artesanal</option>
											<option value="Transporte">Transporte</option>
										</select>
									</div>
									<div class="conapdis-form-group conapdis-field-hidden" id="creditoBancarioContainer">
										<label for="tieneCreditoBancario">¿Usó crédito bancario?</label>
										<select id="tieneCreditoBancario" name="tieneCreditoBancario">
											<option value="no">No</option>
											<option value="si">Sí</option>
										</select>
									</div>
									<div class="conapdis-form-group conapdis-field-hidden" id="nombreBancoContainer">
										<label for="nombreBanco">Nombre del banco</label>
										<input type="text" id="nombreBanco" name="nombreBanco">
									</div>
								</div>
							</fieldset>
							<fieldset>
								<legend>Protección Social</legend>
								<div class="conapdis-form-group">
									<label for="recibeBono">¿Recibe el Bono de José Gregorio Hernández?</label>
									<select id="recibeBono" name="recibeBono">
										<option value="no">No</option>
										<option value="si">Sí</option>
									</select>
								</div>
							</fieldset>
						</div>
					</div>
					<div class="conapdis-submit-container">
						<button type="submit" class="conapdis-btn" id="submitBtn">
							<span id="btnText">📝 Registrar Beneficiario FMJGH</span>
						</button>
					</div>
				</form>
			</div>
		</div>
		<script>
		jQuery(document).ready(function($) {
			const estadosVenezuela = <?php echo json_encode(array(
				array('id'=>'amazonas','nombre'=>'Amazonas','municipios'=>array(array('nombre'=>'Atabapo','parroquias'=>array('Atabapo','Santa Rosa de Amanaven','Yapacana')),array('nombre'=>'Atures','parroquias'=>array('Atures','Fernando Girón Tovar','Tobogán de la Selva')),array('nombre'=>'Autana','parroquias'=>array('Autana','Isla Ratón','Samariapo')),array('nombre'=>'Manapiare','parroquias'=>array('Manapiare','Bajo Ventuari','Medio Ventuari')),array('nombre'=>'Maroa','parroquias'=>array('Maroa','Yapacana')),array('nombre'=>'Río Negro','parroquias'=>array('Río Negro','Baría','Casiquiare','Siapa')))),
				array('id'=>'anzoategui','nombre'=>'Anzoátegui','municipios'=>array(array('nombre'=>'Anaco','parroquias'=>array('Anaco')),array('nombre'=>'Aragua','parroquias'=>array('Aragua')),array('nombre'=>'Manuel Ezequiel Bruzual','parroquias'=>array('Clarines','Guanape')),array('nombre'=>'Juan Antonio Sotillo','parroquias'=>array('Puerto La Cruz','Lechería','Guanta')),array('nombre'=>'Fernando de Peñalver','parroquias'=>array('Puerto Píritu','Píritu')),array('nombre'=>'José Gregorio Monagas','parroquias'=>array('Mapire','Soledad')),array('nombre'=>'Simón Bolívar','parroquias'=>array('Barcelona','Caigua','El Pilar')),array('nombre'=>'José Félix Ribas','parroquias'=>array('San Mateo','San Diego de Cabrutica')),array('nombre'=>'San Juan de Capistrano','parroquias'=>array('Boca de Uchire')),array('nombre'=>'Sir Arthur Mc Gregor','parroquias'=>array('El Chaparro')),array('nombre'=>'Libertad','parroquias'=>array('San Mateo')),array('nombre'=>'Francisco del Carmen Carvajal','parroquias'=>array('Valle de La Pascua')),array('nombre'=>'Diego Bautista Urbaneja','parroquias'=>array('Lecherías')),array('nombre'=>'Miranda','parroquias'=>array('Pariaguán')),array('nombre'=>'Independencia','parroquias'=>array('Soledad')))),
				array('id'=>'apure','nombre'=>'Apure','municipios'=>array(array('nombre'=>'Achaguas','parroquias'=>array('Achaguas','Apurito','El Yagual','Guachara')),array('nombre'=>'Biruaca','parroquias'=>array('Biruaca')),array('nombre'=>'Muñoz','parroquias'=>array('Bruzual','Mantecal','El Samán','Guasimal','San Camilo')),array('nombre'=>'Rómulo Gallegos','parroquias'=>array('Elorza','La Trinidad','Urbaneja')),array('nombre'=>'Pedro Camejo','parroquias'=>array('San Juan de Payara','Codazzi','Cunaviche','El Amparo')),array('nombre'=>'San Fernando','parroquias'=>array('San Fernando','El Recreo','Santa Bárbara','San Juan de Payara')))),
				array('id'=>'aragua','nombre'=>'Aragua','municipios'=>array(array('nombre'=>'Bolívar','parroquias'=>array('La Victoria','San Mateo','Taguay','Villa de Cura')),array('nombre'=>'Camatagua','parroquias'=>array('Camatagua')),array('nombre'=>'Francisco Linares Alcántara','parroquias'=>array('Santa Rita')),array('nombre'=>'Girardot','parroquias'=>array('Maracay','Choroní','Castor Nieves Ríos')),array('nombre'=>'José Ángel Lamas','parroquias'=>array('Santa Cruz','Bella Vista')),array('nombre'=>'José Félix Ribas','parroquias'=>array('La Victoria')),array('nombre'=>'Julian Motta','parroquias'=>array('Colonia Tovar')),array('nombre'=>'Libertador','parroquias'=>array('Palo Negro','San Jacinto')),array('nombre'=>'Mariño','parroquias'=>array('Turmero')),array('nombre'=>'Santiago Mariño','parroquias'=>array('Turmero')),array('nombre'=>'Santos Michelena','parroquias'=>array('Las Tejerías')),array('nombre'=>'Sucre','parroquias'=>array('Cagua')),array('nombre'=>'Tovar','parroquias'=>array('Colonia Tovar')),array('nombre'=>'Urdaneta','parroquias'=>array('Barbacoas','Las Peñas')),array('nombre'=>'Zamora','parroquias'=>array('Villa de Cura','Magdaleno','San Francisco de Asís')))),
				array('id'=>'barinas','nombre'=>'Barinas','municipios'=>array(array('nombre'=>'Alberto Arvelo Torrealba','parroquias'=>array('Sabaneta')),array('nombre'=>'Andrés Eloy Blanco','parroquias'=>array('El Cantón')),array('nombre'=>'Antonio José de Sucre','parroquias'=>array('Socopó')),array('nombre'=>'Arismendi','parroquias'=>array('Arismendi')),array('nombre'=>'Barinas','parroquias'=>array('Barinas','Altamira de Cáceres')),array('nombre'=>'Bolívar','parroquias'=>array('Barinitas')),array('nombre'=>'Crespo','parroquias'=>array('Tricoro')),array('nombre'=>'Ezequiel Zamora','parroquias'=>array('Santa Bárbara')),array('nombre'=>'Obispos','parroquias'=>array('Obispos')),array('nombre'=>'Pedro Briceño Méndez','parroquias'=>array('Libertad')),array('nombre'=>'Rojas','parroquias'=>array('Libertad')),array('nombre'=>'Sosa','parroquias'=>array('Ciudad de Nutrias')))),
				array('id'=>'bolivar','nombre'=>'Bolívar','municipios'=>array(array('nombre'=>'Caroní','parroquias'=>array('Ciudad Guayana','Puerto Ordaz','San Félix')),array('nombre'=>'Cedeño','parroquias'=>array('Caicara del Orinoco')),array('nombre'=>'El Callao','parroquias'=>array('El Callao')),array('nombre'=>'Gran Sabana','parroquias'=>array('Santa Elena de Uairén')),array('nombre'=>'Heres','parroquias'=>array('Ciudad Bolívar')),array('nombre'=>'Padre Pedro Chien','parroquias'=>array('El Dorado')),array('nombre'=>'Piar','parroquias'=>array('Upata')),array('nombre'=>'Roscio','parroquias'=>array('Guasipati')),array('nombre'=>'Sifontes','parroquias'=>array('Tumeremo')),array('nombre'=>'Sucre','parroquias'=>array('Maripa')),array('nombre'=>'Valdez','parroquias'=>array('Tucupita')))),
				array('id'=>'carabobo','nombre'=>'Carabobo','municipios'=>array(array('nombre'=>'Bejuma','parroquias'=>array('Bejuma')),array('nombre'=>'Carlos Arvelo','parroquias'=>array('Güigüe')),array('nombre'=>'Diego Ibarra','parroquias'=>array('Mariara')),array('nombre'=>'Guacara','parroquias'=>array('Guacara')),array('nombre'=>'Naguanagua','parroquias'=>array('Naguanagua')),array('nombre'=>'Puerto Cabello','parroquias'=>array('Puerto Cabello')),array('nombre'=>'San Joaquín','parroquias'=>array('San Joaquín')),array('nombre'=>'Libertador','parroquias'=>array('Tocuyito')),array('nombre'=>'Los Guayos','parroquias'=>array('Los Guayos')),array('nombre'=>'Miranda','parroquias'=>array('Miranda')),array('nombre'=>'Montalbán','parroquias'=>array('Montalbán')),array('nombre'=>'San Diego','parroquias'=>array('San Diego')),array('nombre'=>'Valencia','parroquias'=>array('Valencia')),array('nombre'=>'Juan José Mora','parroquias'=>array('Morón')))),
				array('id'=>'cojedes','nombre'=>'Cojedes','municipios'=>array(array('nombre'=>'Anzoátegui','parroquias'=>array('Cojedes')),array('nombre'=>'Tinaquillo','parroquias'=>array('Tinaquillo')),array('nombre'=>'Girardot','parroquias'=>array('El Baúl')),array('nombre'=>'Lima Blanco','parroquias'=>array('Macapo')),array('nombre'=>'Pao de San Juan Bautista','parroquias'=>array('El Pao')),array('nombre'=>'Ricaurte','parroquias'=>array('Libertad')),array('nombre'=>'Rómulo Gallegos','parroquias'=>array('Las Vegas')),array('nombre'=>'San Carlos','parroquias'=>array('San Carlos')))),
				array('id'=>'deltamacuro','nombre'=>'Delta Amacuro','municipios'=>array(array('nombre'=>'Antonio Díaz','parroquias'=>array('Curiapo')),array('nombre'=>'Casacoima','parroquias'=>array('Sierra Imataca')),array('nombre'=>'Pedernales','parroquias'=>array('Pedernales')),array('nombre'=>'Tucupita','parroquias'=>array('Tucupita')))),
				array('id'=>'distritocapital','nombre'=>'Distrito Capital','municipios'=>array(array('nombre'=>'Libertador','parroquias'=>array('Caracas','Altagracia','Candelaria','Catedral','El Junquito','El Paraiso','El Recreo','El Valle','La Pastora','La Vega','San Antonio de los Altos','San Bernardino','San José','San Juan','San Pedro','Santa Rosalía','Santa Teresa','Sucre')))),
				array('id'=>'falcon','nombre'=>'Falcón','municipios'=>array(array('nombre'=>'Acosta','parroquias'=>array('San Juan de los Cayos')),array('nombre'=>'Bolívar','parroquias'=>array('Sabana Grande')),array('nombre'=>'Buchivacoa','parroquias'=>array('Capatárida')),array('nombre'=>'Cacique Manaure','parroquias'=>array('Yaracal')),array('nombre'=>'Carirubana','parroquias'=>array('Punto Fijo')),array('nombre'=>'Colina','parroquias'=>array('La Vela de Coro')),array('nombre'=>'Dabajuro','parroquias'=>array('Dabajuro')),array('nombre'=>'Falcón','parroquias'=>array('Pueblo Nuevo')),array('nombre'=>'Jacura','parroquias'=>array('Jacura')),array('nombre'=>'Los Taques','parroquias'=>array('Los Taques','Adícora')),array('nombre'=>'Mauroa','parroquias'=>array('Mene de Mauroa')),array('nombre'=>'Miranda','parroquias'=>array('Santa Ana de Coro')),array('nombre'=>'Monseñor Iturriza','parroquias'=>array('Chichiriviche')),array('nombre'=>'Palmasola','parroquias'=>array('Palmasola')),array('nombre'=>'Petit','parroquias'=>array('Cabure')),array('nombre'=>'Silva','parroquias'=>array('Tucacas')),array('nombre'=>'Sucre','parroquias'=>array('La Cruz de Taratara')),array('nombre'=>'Tocópero','parroquias'=>array('Tocópero')),array('nombre'=>'Unión','parroquias'=>array('Santa Cruz de Bucaral')),array('nombre'=>'Urumaco','parroquias'=>array('Urumaco')))),
				array('id'=>'guarico','nombre'=>'Guárico','municipios'=>array(array('nombre'=>'Camaguán','parroquias'=>array('Camaguán')),array('nombre'=>'Chaguaramas','parroquias'=>array('Chaguaramas')),array('nombre'=>'El Socorro','parroquias'=>array('El Socorro')),array('nombre'=>'Juan José Rondón','parroquias'=>array('San Rafael de Orituco')),array('nombre'=>'José Félix Ribas','parroquias'=>array('Tucupido')),array('nombre'=>'José Tadeo Monagas','parroquias'=>array('Altagracia de Orituco')),array('nombre'=>'Julián Mellado','parroquias'=>array('El Sombrero')),array('nombre'=>'Las Mercedes','parroquias'=>array('Las Mercedes de los Llanos')),array('nombre'=>'Leonardo Infante','parroquias'=>array('Valle de La Pascua')),array('nombre'=>'Pedro Zaraza','parroquias'=>array('Zaraza')),array('nombre'=>'Roscio','parroquias'=>array('Calabozo')),array('nombre'=>'San Gerónimo de Guayabal','parroquias'=>array('Guayabal')),array('nombre'=>'San José de Guaribe','parroquias'=>array('San José de Guaribe')))),
				array('id'=>'lara','nombre'=>'Lara','municipios'=>array(array('nombre'=>'Andrés Eloy Blanco','parroquias'=>array('Sanare')),array('nombre'=>'Crespo','parroquias'=>array('Duaca')),array('nombre'=>'Iribarren','parroquias'=>array('Barquisimeto')),array('nombre'=>'Jiménez','parroquias'=>array('Quíbor')),array('nombre'=>'Morán','parroquias'=>array('El Tocuyo')),array('nombre'=>'Palavecino','parroquias'=>array('Cabudare')),array('nombre'=>'Simón Planas','parroquias'=>array('Sarare')),array('nombre'=>'Torres','parroquias'=>array('Carora')),array('nombre'=>'Urdaneta','parroquias'=>array('Siquisique')))),
				array('id'=>'merida','nombre'=>'Mérida','municipios'=>array(array('nombre'=>'Alberto Adriani','parroquias'=>array('El Vigía')),array('nombre'=>'Andrés Bello','parroquias'=>array('La Azulita')),array('nombre'=>'Antonio Pinto Salinas','parroquias'=>array('Santa Cruz de Mora')),array('nombre'=>'Aricagua','parroquias'=>array('Aricagua')),array('nombre'=>'Arzobispo Chacón','parroquias'=>array('Canagua')),array('nombre'=>'Campo Elías','parroquias'=>array('Ejido')),array('nombre'=>'Caracciolo Parra Olmedo','parroquias'=>array('Tucani')),array('nombre'=>'Cardenal Quintero','parroquias'=>array('Santo Domingo')),array('nombre'=>'Guaraque','parroquias'=>array('Guaraque')),array('nombre'=>'Julio César Salas','parroquias'=>array('Arapuey')),array('nombre'=>'Justo Briceño','parroquias'=>array('Torondoy')),array('nombre'=>'Libertador','parroquias'=>array('Mérida')),array('nombre'=>'Miranda','parroquias'=>array('Timotes')),array('nombre'=>'Padre Noguera','parroquias'=>array('Santa María de Caparo')),array('nombre'=>'Pueblo Llano','parroquias'=>array('Pueblo Llano')),array('nombre'=>'Rangel','parroquias'=>array('Mucuchíes')),array('nombre'=>'Rivas Dávila','parroquias'=>array('Bailadores')),array('nombre'=>'Santos Marquina','parroquias'=>array('Tabay')),array('nombre'=>'Sucre','parroquias'=>array('Lagunillas')),array('nombre'=>'Tulio Febres Cordero','parroquias'=>array('Nueva Bolivia')),array('nombre'=>'Tovar','parroquias'=>array('Tovar')),array('nombre'=>'Zea','parroquias'=>array('Zea')))),
				array('id'=>'miranda','nombre'=>'Miranda','municipios'=>array(array('nombre'=>'Acevedo','parroquias'=>array('Caucagua')),array('nombre'=>'Andrés Bello','parroquias'=>array('San José de Barlovento')),array('nombre'=>'Baruta','parroquias'=>array('Baruta','Nuestra Señora del Rosario')),array('nombre'=>'Brión','parroquias'=>array('Higuerote')),array('nombre'=>'Buroz','parroquias'=>array('Mamporal')),array('nombre'=>'Carrizal','parroquias'=>array('Carrizal')),array('nombre'=>'Chacao','parroquias'=>array('Chacao')),array('nombre'=>'Cristóbal Rojas','parroquias'=>array('Charallave')),array('nombre'=>'El Hatillo','parroquias'=>array('El Hatillo')),array('nombre'=>'Guaicaipuro','parroquias'=>array('Los Teques')),array('nombre'=>'Independencia','parroquias'=>array('Santa Teresa del Tuy','Santa Lucía')),array('nombre'=>'Lander','parroquias'=>array('Ocumare del Tuy')),array('nombre'=>'Los Salias','parroquias'=>array('San Antonio de los Altos')),array('nombre'=>'Páez','parroquias'=>array('Río Chico')),array('nombre'=>'Plaza','parroquias'=>array('Guarenas')),array('nombre'=>'Simón Bolívar','parroquias'=>array('San Francisco de Yare')),array('nombre'=>'Sucre','parroquias'=>array('Petare','Filas de Mariche')),array('nombre'=>'Urdaneta','parroquias'=>array('Cúa')),array('nombre'=>'Zamora','parroquias'=>array('Guatire','Bolívar')))),
				array('id'=>'monagas','nombre'=>'Monagas','municipios'=>array(array('nombre'=>'Acosta','parroquias'=>array('San Antonio de Capayacuar')),array('nombre'=>'Aguasay','parroquias'=>array('Aguasay')),array('nombre'=>'Bolívar','parroquias'=>array('Caripito')),array('nombre'=>'Caripe','parroquias'=>array('Caripe')),array('nombre'=>'Cedeño','parroquias'=>array('Caicara de Maturín')),array('nombre'=>'Ezequiel Zamora','parroquias'=>array('Punta de Mata')),array('nombre'=>'Libertador','parroquias'=>array('Temblador')),array('nombre'=>'Maturín','parroquias'=>array('Maturín','San Simón','El Furrial','Jusepín')),array('nombre'=>'Piar','parroquias'=>array('Aragua de Maturín')),array('nombre'=>'Punceres','parroquias'=>array('Quiriquire')),array('nombre'=>'Santa Bárbara','parroquias'=>array('Santa Bárbara')),array('nombre'=>'Sotillo','parroquias'=>array('Barrancas del Orinoco')),array('nombre'=>'Uracoa','parroquias'=>array('Uracoa')))),
				array('id'=>'nuevaesparta','nombre'=>'Nueva Esparta','municipios'=>array(array('nombre'=>'Antolín del Campo','parroquias'=>array('Plaza de Antolín del Campo')),array('nombre'=>'Arismendi','parroquias'=>array('La Asunción')),array('nombre'=>'García','parroquias'=>array('El Valle del Espíritu Santo')),array('nombre'=>'Gómez','parroquias'=>array('Santa Ana')),array('nombre'=>'Maneiro','parroquias'=>array('Pampatar')),array('nombre'=>'Marcano','parroquias'=>array('Juan Griego')),array('nombre'=>'Mariño','parroquias'=>array('Porlamar')),array('nombre'=>'Península de Macanao','parroquias'=>array('Boca de Río')),array('nombre'=>'Tubores','parroquias'=>array('Punta de Piedras')),array('nombre'=>'Villalba','parroquias'=>array('San Juan Bautista')))),
				array('id'=>'portuguesa','nombre'=>'Portuguesa','municipios'=>array(array('nombre'=>'Agua Blanca','parroquias'=>array('Agua Blanca')),array('nombre'=>'Araure','parroquias'=>array('Araure')),array('nombre'=>'Esteller','parroquias'=>array('Píritu')),array('nombre'=>'Guanare','parroquias'=>array('Guanare')),array('nombre'=>'Guanarito','parroquias'=>array('Guanarito')),array('nombre'=>'Monseñor José Vicente de Unda','parroquias'=>array('Chabasquén')),array('nombre'=>'Ospino','parroquias'=>array('Ospino')),array('nombre'=>'Páez','parroquias'=>array('Acarigua')),array('nombre'=>'Papelón','parroquias'=>array('Papelon')),array('nombre'=>'San Genaro de Boconoíto','parroquias'=>array('Boconoíto')),array('nombre'=>'Sucre','parroquias'=>array('Biscucuy')),array('nombre'=>'Turén','parroquias'=>array('Villa Bruzual')))),
				array('id'=>'sucre','nombre'=>'Sucre','municipios'=>array(array('nombre'=>'Andrés Mata','parroquias'=>array('San José de Aerocuar')),array('nombre'=>'Arismendi','parroquias'=>array('Río Caribe')),array('nombre'=>'Benítez','parroquias'=>array('El Pilar')),array('nombre'=>'Bermúdez','parroquias'=>array('Carúpano')),array('nombre'=>'Cajigal','parroquias'=>array('Yaguarapo')),array('nombre'=>'Libertador','parroquias'=>array('Tunapuy')),array('nombre'=>'Mariño','parroquias'=>array('Irapa')),array('nombre'=>'Mejía','parroquias'=>array('San Antonio del Golfo')),array('nombre'=>'Montes','parroquias'=>array('Cumanacoa')),array('nombre'=>'Ribero','parroquias'=>array('Cariaco')),array('nombre'=>'Sucre','parroquias'=>array('Cumaná')),array('nombre'=>'Valdez','parroquias'=>array('Güiria')))),
				array('id'=>'tachira','nombre'=>'Táchira','municipios'=>array(array('nombre'=>'Andrés Bello','parroquias'=>array('Cordero')),array('nombre'=>'Ayacucho','parroquias'=>array('Colón')),array('nombre'=>'Bolívar','parroquias'=>array('San Antonio del Táchira')),array('nombre'=>'Cárdenas','parroquias'=>array('Táriba')),array('nombre'=>'Córdoba','parroquias'=>array('Santa Ana del Táchira')),array('nombre'=>'Fernández Feo','parroquias'=>array('San Juan de Colón')),array('nombre'=>'Francisco de Miranda','parroquias'=>array('San José de Bolívar')),array('nombre'=>'García de Hevia','parroquias'=>array('La Grita')),array('nombre'=>'Guásimos','parroquias'=>array('Palmira')),array('nombre'=>'Independencia','parroquias'=>array('Capacho Nuevo')),array('nombre'=>'Jáuregui','parroquias'=>array('La Grita')),array('nombre'=>'Junín','parroquias'=>array('Rubio')),array('nombre'=>'Libertad','parroquias'=>array('Capacho Viejo')),array('nombre'=>'Libertador','parroquias'=>array('San Cristóbal')),array('nombre'=>'Lobatera','parroquias'=>array('Lobatera')),array('nombre'=>'Michelena','parroquias'=>array('Michelena')),array('nombre'=>'Panamericano','parroquias'=>array('Coloncito')),array('nombre'=>'Pedro María Ureña','parroquias'=>array('Ureña')),array('nombre'=>'Rafael Urdaneta','parroquias'=>array('Delicias')),array('nombre'=>'Samuel Darío Maldonado','parroquias'=>array('La Tendida')),array('nombre'=>'San Cristóbal','parroquias'=>array('San Cristóbal')),array('nombre'=>'Seboruco','parroquias'=>array('Seboruco')),array('nombre'=>'Sucre','parroquias'=>array('Queniquea')),array('nombre'=>'Torbes','parroquias'=>array('San José de Táchira')),array('nombre'=>'Uribante','parroquias'=>array('Pregonero')))),
				array('id'=>'trujillo','nombre'=>'Trujillo','municipios'=>array(array('nombre'=>'Boconó','parroquias'=>array('Boconó')),array('nombre'=>'Bolívar','parroquias'=>array('Sabana Grande')),array('nombre'=>'Candelaria','parroquias'=>array('Chejendé')),array('nombre'=>'Carache','parroquias'=>array('Carache')),array('nombre'=>'Escuque','parroquias'=>array('Escuque')),array('nombre'=>'Juan Vicente Campo Elías','parroquias'=>array('Campo Elías')),array('nombre'=>'La Ceiba','parroquias'=>array('Santa Apolonia')),array('nombre'=>'Miranda','parroquias'=>array('El Dividive')),array('nombre'=>'Monte Carmelo','parroquias'=>array('Monte Carmelo')),array('nombre'=>'Motatán','parroquias'=>array('Motatán')),array('nombre'=>'Pampán','parroquias'=>array('Pampán')),array('nombre'=>'Pampanito','parroquias'=>array('Pampanito')),array('nombre'=>'Rafael Rangel','parroquias'=>array('Betijoque')),array('nombre'=>'San Rafael de Carvajal','parroquias'=>array('Carvajal')),array('nombre'=>'Sucre','parroquias'=>array('Sabana de Mendoza')),array('nombre'=>'Trujillo','parroquias'=>array('Trujillo')),array('nombre'=>'Urdaneta','parroquias'=>array('La Quebrada')),array('nombre'=>'Valera','parroquias'=>array('Valera')))),
				array('id'=>'vargas','nombre'=>'La Guaira','municipios'=>array(array('nombre'=>'Vargas','parroquias'=>array('La Guaira','Carayaca','Catia La Mar','El Junquito','Maiquetía','Naiguatá')))),
				array('id'=>'yaracuy','nombre'=>'Yaracuy','municipios'=>array(array('nombre'=>'Arístides Bastidas','parroquias'=>array('Chivacoa')),array('nombre'=>'Bolívar','parroquias'=>array('Aroa')),array('nombre'=>'Cocorote','parroquias'=>array('Cocorote')),array('nombre'=>'Independencia','parroquias'=>array('Nirgua')),array('nombre'=>'José Antonio Páez','parroquias'=>array('Sabana de Parra')),array('nombre'=>'La Trinidad','parroquias'=>array('Boraure')),array('nombre'=>'Manuel Monge','parroquias'=>array('Yaritagua')),array('nombre'=>'Peña','parroquias'=>array('Yaracal')),array('nombre'=>'San Felipe','parroquias'=>array('San Felipe')),array('nombre'=>'Sucre','parroquias'=>array('Guama')),array('nombre'=>'Urachiche','parroquias'=>array('Urachiche')),array('nombre'=>'Veroes','parroquias'=>array('Farriar')))),
				array('id'=>'zulia','nombre'=>'Zulia','municipios'=>array(array('nombre'=>'Almirante Padilla','parroquias'=>array('El Toro')),array('nombre'=>'Baralt','parroquias'=>array('San Timoteo')),array('nombre'=>'Cabimas','parroquias'=>array('Cabimas')),array('nombre'=>'Catatumbo','parroquias'=>array('Encontrados')),array('nombre'=>'Colón','parroquias'=>array('San Carlos del Zulia')),array('nombre'=>'Francisco Javier Pulgar','parroquias'=>array('Pueblo Nuevo-El Chivo')),array('nombre'=>'Jesús Enrique Lossada','parroquias'=>array('La Cañada de Urdaneta')),array('nombre'=>'Jesús María Semprún','parroquias'=>array('Casigua-El Cubo')),array('nombre'=>'La Cañada de Urdaneta','parroquias'=>array('La Cañada de Urdaneta')),array('nombre'=>'Lagunillas','parroquias'=>array('Ciudad Ojeda')),array('nombre'=>'Mara','parroquias'=>array('San Rafael de El Mojan')),array('nombre'=>'Maracaibo','parroquias'=>array('Maracaibo')),array('nombre'=>'Miranda','parroquias'=>array('Los Puertos de Altagracia')),array('nombre'=>'Guajira','parroquias'=>array('Sinamaica')),array('nombre'=>'Perijá','parroquias'=>array('Machiques')),array('nombre'=>'Rosario de Perijá','parroquias'=>array('La Villa del Rosario')),array('nombre'=>'Simón Bolívar','parroquias'=>array('Tía Juana')),array('nombre'=>'Sucre','parroquias'=>array('Bobures')),array('nombre'=>'Urdaneta','parroquias'=>array('Concepción')),array('nombre'=>'Valmore Rodríguez','parroquias'=>array('Bachaquero'))))
			)); ?>;
			
			const form = $('#conapdisForm'),
				loadingOverlay = $('#conapdisLoadingOverlay'),
				submitBtn = $('#submitBtn'),
				btnText = $('#btnText'),
				estadoSelect = $('#estado'),
				municipioSelect = $('#municipio'),
				parroquiaSelect = $('#parroquia'),
				fechaNacimientoInput = $('#fechaNacimiento'),
				edadInput = $('#edad'),
				perteneceEtniaCheckbox = $('#perteneceEtnia'),
				etniaSelectContainer = $('#etniaSelectContainer'),
				cedulaInput = $('#cedula'),
				cedulaStatus = $('#cedulaStatus'),
				fileInputs = ['doc_cedula', 'doc_informe', 'doc_foto', 'doc_solicitud'],
				maxFileSize = beneficiario_ajax.max_file_size,
				allowedTypes = beneficiario_ajax.allowed_types;
			let cedulaValidation = { isValid: false, isChecking: false, isDuplicated: false },
				verifyTimeout;

			function loadEstados() {
				if (!estadosVenezuela || !Array.isArray(estadosVenezuela)) return;
				estadoSelect.empty().append('<option value="">Seleccione estado</option>');
				estadosVenezuela.forEach(estado => {
					estadoSelect.append($('<option>', { value: estado.nombre, text: estado.nombre }));
				});
			}
			function loadMunicipios() {
				const estadoNombre = estadoSelect.val();
				municipioSelect.empty().append('<option value="">Seleccione municipio</option>').prop('disabled', true).removeAttr('required');
				parroquiaSelect.empty().append('<option value="">Seleccione parroquia</option>').prop('disabled', true).removeAttr('required');
				const estado = estadosVenezuela.find(e => e.nombre === estadoNombre);
				if (estado && estado.municipios) {
					estado.municipios.forEach(m => {
						municipioSelect.append($('<option>', { value: m.nombre, text: m.nombre }));
					});
					municipioSelect.prop('disabled', false).attr('required', 'required');
				}
			}
			function loadParroquias() {
				const estadoNombre = estadoSelect.val();
				const municipioNombre = municipioSelect.val();
				parroquiaSelect.empty().append('<option value="">Seleccione parroquia</option>').prop('disabled', true).removeAttr('required');
				const estado = estadosVenezuela.find(e => e.nombre === estadoNombre);
				if (estado) {
					const municipio = estado.municipios.find(m => m.nombre === municipioNombre);
					if (municipio && municipio.parroquias) {
						municipio.parroquias.forEach(p => {
							parroquiaSelect.append($('<option>', { value: p, text: p }));
						});
						parroquiaSelect.prop('disabled', false).attr('required', 'required');
					}
				}
			}
			function calcularEdad() {
				const fechaNac = fechaNacimientoInput.val();
				if (fechaNac) {
					const hoy = new Date();
					const nacimiento = new Date(fechaNac);
					let edad = hoy.getFullYear() - nacimiento.getFullYear();
					const mes = hoy.getMonth() - nacimiento.getMonth();
					if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) edad--;
					edadInput.val(edad >= 0 ? edad : 0);
				}
			}
			function limpiarCedula(cedula) {
				if (!cedula) return '';
				let limpia = cedula.toString().toUpperCase().replace(/^[VE]/i, '');
				return limpia.replace(/[^0-9]/g, '');
			}
			function updateCedulaStatus(status, message) {
				cedulaInput.removeClass('conapdis-valid conapdis-invalid');
				cedulaStatus.removeClass('valid invalid checking');
				if (status === 'checking') {
					cedulaStatus.html('<span class="conapdis-spinner-small"></span> Verificando disponibilidad...').addClass('checking');
				} else if (status === 'valid') {
					cedulaInput.addClass('conapdis-valid');
					cedulaStatus.html('✓ ' + message).addClass('valid');
				} else if (status === 'invalid') {
					cedulaInput.addClass('conapdis-invalid');
					cedulaStatus.html('✗ ' + message).addClass('invalid');
				} else {
					cedulaStatus.html('');
				}
			}
			function verificarCedula(cedula) {
				const cedulaLimpia = limpiarCedula(cedula);
				if (cedulaLimpia.length < 6) return;
				updateCedulaStatus('checking', '');
				cedulaValidation.isChecking = true;
				$.ajax({
					url: beneficiario_ajax.ajax_url,
					type: 'POST',
					data: { action: 'verificar_cedula', nonce: beneficiario_ajax.nonce, cedula: cedulaLimpia },
					success: function(response) {
						cedulaValidation.isChecking = false;
						if (response.success && response.data.exists) {
							cedulaValidation.isDuplicated = true;
							cedulaValidation.isValid = false;
							updateCedulaStatus('invalid', 'Esta cédula ya está registrada en CONAPDIS');
						} else {
							cedulaValidation.isDuplicated = false;
							cedulaValidation.isValid = true;
							updateCedulaStatus('valid', 'Cédula disponible para registro');
						}
					},
					error: function() {
						cedulaValidation.isChecking = false;
						cedulaValidation.isValid = true;
						updateCedulaStatus('valid', 'No se pudo verificar, puede continuar');
					}
				});
			}
			function validarArchivo(input) {
				const file = input.files[0];
				const statusDiv = $('#' + input.id + '_status');
				if (!file) { statusDiv.html('').removeClass('valid invalid'); return false; }
				const extension = file.name.split('.').pop().toLowerCase();
				if (!allowedTypes.includes(extension)) {
					statusDiv.html('<span class="conapdis-hint">❌ Solo se permiten archivos PDF, JPG o PNG</span>').addClass('invalid').removeClass('valid');
					input.value = ''; return false;
				}
				if (file.size > maxFileSize) {
					const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
					statusDiv.html('<span class="conapdis-hint">❌ El archivo excede 5MB. Tamaño: ' + sizeMB + 'MB</span>').addClass('invalid').removeClass('valid');
					input.value = ''; return false;
				}
				const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
				statusDiv.html('<span class="conapdis-hint">✅ Archivo válido (' + sizeMB + 'MB)</span>').addClass('valid').removeClass('invalid');
				return true;
			}

			// Event Listeners
			estadoSelect.on('change', loadMunicipios);
			municipioSelect.on('change', loadParroquias);
			fechaNacimientoInput.on('change', calcularEdad);
			perteneceEtniaCheckbox.on('change', function() {
				etniaSelectContainer.css('display', this.checked ? 'block' : 'none');
			});
			cedulaInput.on('input', function() {
				let valor = $(this).val();
				let limpia = limpiarCedula(valor);
				if (valor !== limpia) $(this).val(limpia);
				clearTimeout(verifyTimeout);
				if (limpia.length >= 6) {
					verifyTimeout = setTimeout(() => verificarCedula(limpia), 500);
				} else {
					updateCedulaStatus('empty', '');
					cedulaValidation = { isValid: false, isChecking: false, isDuplicated: false };
				}
			});
			fileInputs.forEach(id => { $('#' + id).on('change', function() { validarArchivo(this); }); });
			$('#tieneCuidador').on('change', function() {
				const show = $(this).val() === 'si';
				$('#cuidadorNombreContainer, #cuidadorCedulaContainer').toggleClass('conapdis-field-hidden', !show);
			});
			$('#tieneEmprendimiento').on('change', function() {
				const show = $(this).val() === 'si';
				$('#nombreEmprendimientoContainer, #rifEmprendimientoContainer, #areaComercialContainer, #creditoBancarioContainer').toggleClass('conapdis-field-hidden', !show);
			});
			$('#tieneCreditoBancario').on('change', function() {
				$('#nombreBancoContainer').toggleClass('conapdis-field-hidden', $(this).val() !== 'si');
			});
			$('#tipoAtencionSolicitada').on('change', function() {
				$('#ayudaTecnicaBox').toggleClass('conapdis-field-hidden', $(this).val() !== 'Atención a través de OAC');
			});

			// Form Submit
			form.on('submit', function(e) {
				e.preventDefault();
				const cedulaLimpia = limpiarCedula(cedulaInput.val());
				cedulaInput.val(cedulaLimpia);
				if (cedulaValidation.isChecking) {
					Swal.fire({ icon: 'info', title: 'Espere', text: 'Se está verificando la cédula...', confirmButtonColor: '#1e3a5f' });
					return;
				}
				if (cedulaValidation.isDuplicated) {
					Swal.fire({ icon: 'error', title: 'Cédula ya registrada', text: 'Esta cédula ya está registrada en CONAPDIS', confirmButtonColor: '#1e3a5f' });
					return;
				}
				let allFilesValid = true;
				let missingFiles = [];
				fileInputs.forEach(id => {
					const input = document.getElementById(id);
					if (!input.files || !input.files[0]) {
						allFilesValid = false;
						missingFiles.push($('#' + id).closest('.conapdis-document-item').find('label').text());
					}
				});
				if (!allFilesValid) {
					Swal.fire({ icon: 'error', title: 'Documentos incompletos', html: 'Por favor, adjunte:<br><br>' + missingFiles.map(f => '• ' + f).join('<br>'), confirmButtonColor: '#1e3a5f' });
					return;
				}
				const requiredFields = {
					nombre: $('#nombre').val(),
					apellido: $('#apellido').val(),
					cedula: cedulaLimpia,
					telefono: $('#telefono').val(),
					fecha_nacimiento: $('#fechaNacimiento').val(),
					estado: $('#estado').val(),
					municipio: $('#municipio').val(),
					parroquia: $('#parroquia').val(),
					direccion: $('#direccion').val(),
					tipo_discapacidad: $('#tipoDiscapacidad').val(),
					tipo_atencion: $('#tipoAtencionSolicitada').val()
				};
				for (const [key, value] of Object.entries(requiredFields)) {
					if (!value) {
						Swal.fire({ icon: 'error', title: 'Campos incompletos', text: 'Por favor complete todos los campos obligatorios', confirmButtonColor: '#1e3a5f' });
						return;
					}
				}
				if (cedulaLimpia.length < 6) {
					Swal.fire({ icon: 'error', title: 'Cédula inválida', text: 'La cédula debe tener al menos 6 dígitos', confirmButtonColor: '#1e3a5f' });
					return;
				}
				const regexNombre = /^[a-zA-ZÁáÉéÍíÓóÚúÜüÑñ\s]{2,50}$/;
				if (!regexNombre.test($('#nombre').val()) || !regexNombre.test($('#apellido').val())) {
					Swal.fire({ icon: 'error', title: 'Nombre inválido', text: 'El nombre y apellido solo deben contener letras', confirmButtonColor: '#1e3a5f' });
					return;
				}
				const regexTelefono = /^[0-9]{10,11}$/;
				if (!regexTelefono.test($('#telefono').val())) {
					Swal.fire({ icon: 'error', title: 'Teléfono inválido', text: 'Ingrese un número de teléfono válido (10-11 dígitos)', confirmButtonColor: '#1e3a5f' });
					return;
				}
				Swal.fire({
					title: '¿Desea registrar a este beneficiario/a?',
					html: '<strong>' + $('#nombre').val() + ' ' + $('#apellido').val() + '</strong><br>Cédula: ' + cedulaLimpia,
					showDenyButton: true, showCancelButton: true,
					confirmButtonText: 'Sí, registrar', confirmButtonColor: '#1e3a5f', denyButtonText: 'Cancelar'
				}).then((result) => {
					if (result.isConfirmed) {
						loadingOverlay.show();
						submitBtn.prop('disabled', true);
						btnText.text('Procesando...');
						const formData = new FormData();
						formData.append('action', 'beneficiario_submit');
						formData.append('nonce', beneficiario_ajax.nonce);
						formData.append('nombre', $('#nombre').val());
						formData.append('apellido', $('#apellido').val());
						formData.append('cedula', cedulaLimpia);
						formData.append('nacionalidad', $('#nacionalidad').val());
						formData.append('correo', $('#correo').val());
						formData.append('telefono', $('#telefono').val());
						formData.append('fecha_nacimiento', $('#fechaNacimiento').val());
						formData.append('edad', $('#edad').val());
						formData.append('sexo', $('#sexo').val());
						formData.append('numero_hijos', $('#numeroHijos').val() || 0);
						formData.append('estado_civil', $('#estadoCivil').val());
						formData.append('pertenece_etnia', $('#perteneceEtnia').is(':checked') ? 'si' : 'no');
						formData.append('etnia', $('#etnia').val() || '');
						formData.append('estado', $('#estado').val());
						formData.append('municipio', $('#municipio').val());
						formData.append('distrito', $('#parroquia').val());
						formData.append('direccion', $('#direccion').val());
						formData.append('tipo_discapacidad', $('#tipoDiscapacidad').val());
						formData.append('numero_certificado', $('#numeroCertificado').val() || '');
						formData.append('tipo_atencion_solicitada', $('#tipoAtencionSolicitada').val());
						formData.append('tipo_ayuda_tecnica', $('#tipoAyudaTecnica').val() || '');
						formData.append('recibe_bono', $('#recibeBono').val());
						formData.append('cuidador_nombre', $('#cuidadorNombre').val() || '');
						formData.append('cuidador_cedula', $('#cuidadorCedula').val() || '');
						formData.append('nivel_academico', $('#nivelAcademico').val());
						formData.append('profesion', $('#profesion').val() || '');
						formData.append('labora', $('#labora').val());
						formData.append('tiene_emprendimiento', $('#tieneEmprendimiento').val());
						formData.append('nombre_emprendimiento', $('#nombreEmprendimiento').val() || '');
						formData.append('rif_emprendimiento', $('#rifEmprendimiento').val() || '');
						formData.append('area_comercial', $('#areaComercial').val() || '');
						formData.append('tiene_credito_bancario', $('#tieneCreditoBancario').val());
						formData.append('nombre_banco', $('#nombreBanco').val() || '');
						formData.append('usuario_registrador', 'web_user');
						fileInputs.forEach(id => { formData.append(id, $('#' + id)[0].files[0]); });
						
						$.ajax({
							url: beneficiario_ajax.ajax_url,
							type: 'POST',
							data: formData,
							processData: false,
							contentType: false,
							success: function(response) {
								loadingOverlay.hide();
								submitBtn.prop('disabled', false);
								btnText.text('📝 Registrar Beneficiario FMJGH');
								if (response.success) {
									Swal.fire({
										icon: 'success',
										title: '¡Registro exitoso!',
										html: response.data.message + '<br><br><strong>ID CONAPDIS:</strong> ' + response.data.registro_id,
										confirmButtonColor: '#1e3a5f'
									}).then(() => {
										form[0].reset();
										edadInput.val('');
										etniaSelectContainer.hide();
										$('#cuidadorNombreContainer, #cuidadorCedulaContainer, #nombreEmprendimientoContainer, #rifEmprendimientoContainer, #areaComercialContainer, #creditoBancarioContainer, #nombreBancoContainer, #ayudaTecnicaBox').addClass('conapdis-field-hidden');
										municipioSelect.prop('disabled', true).removeAttr('required').html('<option value="">Seleccione municipio</option>');
										parroquiaSelect.prop('disabled', true).removeAttr('required').html('<option value="">Seleccione parroquia</option>');
										cedulaValidation = { isValid: false, isChecking: false, isDuplicated: false };
										updateCedulaStatus('empty', '');
										$('.conapdis-file-status').html('').removeClass('valid invalid');
									});
								} else {
									Swal.fire({ icon: 'error', title: 'Error', text: response.data.message || 'Ocurrió un error', confirmButtonColor: '#1e3a5f' });
								}
							},
							error: function(xhr, status, error) {
								loadingOverlay.hide();
								submitBtn.prop('disabled', false);
								btnText.text('📝 Registrar Beneficiario FMJGH');
								console.error('Error AJAX:', status, error, xhr.responseText);
								Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo completar el registro. Revisa la consola (F12) o contacta al administrador.', confirmButtonColor: '#1e3a5f' });
							}
						});
					}
				});
			});
			// Cargar discapacidades desde la API
			function cargarDiscapacidades() {
				var fallback = [
					{id_e:'1-AS/D',nombre_e:'Sin discapacidad'},
					{id_e:'Baja_Visio',nombre_e:'Baja Visi\u00f3n'},
					{id_e:'Ceguera_To',nombre_e:'Ceguera Total'},
					{id_e:'Cegue_P',nombre_e:'Ceguera parcial'},
					{id_e:'Hipoacusia',nombre_e:'Hipoacusia'},
					{id_e:'Hipo_p',nombre_e:'Hipoacusia Profunda'},
					{id_e:'Sordo',nombre_e:'Sordo'},
					{id_e:'SordCeg',nombre_e:'Sordoceguera'},
					{id_e:'motora',nombre_e:'Motora'},
					{id_e:'paralisis',nombre_e:'Par\u00e1lisis cerebral'},
					{id_e:'Down',nombre_e:'S\u00edndrome de Down'},
					{id_e:'TEA',nombre_e:'Trastornos del Espectro Autista TEA'},
					{id_e:'D_di',nombre_e:'D\u00e9ficit de desarrollo intelectual'},
					{id_e:'Diabetes_M',nombre_e:'Diabetes Mellitus'},
					{id_e:'Alzheimer',nombre_e:'Alzheimer'},
					{id_e:'ESQ',nombre_e:'Esquizofrenia'},
					{id_e:'parkinson',nombre_e:'Parkinson'},
					{id_e:'VIH',nombre_e:'Inmunodeficiencias: VIH'},
					{id_e:'cardiopati',nombre_e:'Cardiopat\u00eda isqu\u00e9mica cr\u00f3nica'},
					{id_e:'Oncologica',nombre_e:'Oncol\u00f3gica'},
					{id_e:'dis_ecto',nombre_e:'Displasia Ectod\u00e9rmica'}
				];
				var apiUrl = beneficiario_ajax.api_url || 'http://localhost/sidaii/php/api_conapdis.php';
				$.ajax({
					url: apiUrl + '?action=discapacidades',
					type: 'GET',
					headers: { 'X-API-Key': beneficiario_ajax.api_key },
					success: function(res) {
						var sel = $('#tipoDiscapacidad').empty().append('<option value="">Seleccione</option>');
						if (res.success && res.data && res.data.length) {
							res.data.forEach(function(d) {
								sel.append($('<option>', { value: d.id_e, text: d.nombre_e }));
							});
							return;
						}
						fallback.forEach(function(d) {
							sel.append($('<option>', { value: d.id_e, text: d.nombre_e }));
						});
					},
					error: function() {
						var sel = $('#tipoDiscapacidad').empty().append('<option value="">Seleccione</option>');
						fallback.forEach(function(d) {
							sel.append($('<option>', { value: d.id_e, text: d.nombre_e }));
						});
					}
				});
			}
			// Inicialización
			loadEstados();
			cargarDiscapacidades();
			calcularEdad();
		});
		</script>
		<?php
		return ob_get_clean();
	}

	public function verificar_cedula_existente() {
		if (!wp_verify_nonce($_POST['nonce'] ?? '', 'beneficiario_nonce')) {
			wp_send_json_error(array('message' => 'Error de seguridad'));
		}
		$cedula = sanitize_text_field($_POST['cedula'] ?? '');
		if (empty($cedula)) { wp_send_json_success(array('exists' => false)); }
		$cedula_limpia = $this->limpiar_cedula($cedula);
		if (strlen($cedula_limpia) < 6) { wp_send_json_success(array('exists' => false)); }

		$respuesta = $this->call_api('verificar-cedula', array('cedula' => $cedula_limpia), 'GET');
		if (is_wp_error($respuesta)) {
			wp_send_json_success(array('exists' => false));
		}
		$body = json_decode(wp_remote_retrieve_body($respuesta), true);
		wp_send_json_success(array(
			'exists' => !empty($body['exists'])
		));
	}

	public function procesar_formulario() {
		if (!wp_verify_nonce($_POST['nonce'] ?? '', 'beneficiario_nonce')) {
			wp_send_json_error(array('message' => 'Error de seguridad'));
		}
		$datos = $this->sanitizar_datos($_POST);
		$cedula_limpia = $this->limpiar_cedula($datos['cedula']);
		$datos['cedula'] = $cedula_limpia;

		$archivos = $this->validar_archivos();
		if (is_wp_error($archivos)) {
			wp_send_json_error(array('message' => $archivos->get_error_message()));
		}

		$payload = $this->build_api_payload($datos, $archivos);
		$respuesta = $this->call_api('registrar', $payload, 'POST');

		if (is_wp_error($respuesta)) {
			wp_send_json_error(array('message' => 'Error de conexión con el sistema: ' . $respuesta->get_error_message()));
		}

		$body = json_decode(wp_remote_retrieve_body($respuesta), true);

		if (!empty($body['success'])) {
			$this->enviar_notificacion_registro_api($datos);
			wp_send_json_success(array(
				'message' => 'Registro exitoso en el sistema FMJGH. Los documentos han sido adjuntados correctamente.',
				'registro_id' => 'CONAPDIS-' . str_pad($cedula_limpia, 8, '0', STR_PAD_LEFT)
			));
		} else {
			wp_send_json_error(array('message' => $body['message'] ?? 'Error al registrar en el sistema'));
		}
	}

	private function sanitizar_datos($post) {
		return array(
			'nombre' => sanitize_text_field($post['nombre'] ?? ''),
			'apellido' => sanitize_text_field($post['apellido'] ?? ''),
			'cedula' => sanitize_text_field($post['cedula'] ?? ''),
			'nacionalidad' => sanitize_text_field($post['nacionalidad'] ?? 'V'),
			'correo' => sanitize_email($post['correo'] ?? ''),
			'telefono' => sanitize_text_field($post['telefono'] ?? ''),
			'fecha_nacimiento' => sanitize_text_field($post['fecha_nacimiento'] ?? ''),
			'edad' => intval($post['edad'] ?? 0),
			'sexo' => sanitize_text_field($post['sexo'] ?? 'M'),
			'numero_hijos' => intval($post['numero_hijos'] ?? 0),
			'estado_civil' => sanitize_text_field($post['estado_civil'] ?? ''),
			'pertenece_etnia' => sanitize_text_field($post['pertenece_etnia'] ?? 'no'),
			'etnia' => sanitize_text_field($post['etnia'] ?? ''),
			'estado' => sanitize_text_field($post['estado'] ?? ''),
			'municipio' => sanitize_text_field($post['municipio'] ?? ''),
			'distrito' => sanitize_text_field($post['parroquia'] ?? ''),
			'direccion' => sanitize_textarea_field($post['direccion'] ?? ''),
			'tipo_discapacidad' => sanitize_text_field($post['tipo_discapacidad'] ?? ''),
			'numero_certificado' => sanitize_text_field($post['numero_certificado'] ?? ''),
			'tipo_atencion_solicitada' => sanitize_text_field($post['tipo_atencion_solicitada'] ?? ''),
			'tipo_ayuda_tecnica' => sanitize_text_field($post['tipo_ayuda_tecnica'] ?? ''),
			'recibe_bono_jose_gregorio' => sanitize_text_field($post['recibe_bono'] ?? 'no'),
			'cuidador_nombre' => sanitize_text_field($post['cuidador_nombre'] ?? ''),
			'cuidador_cedula' => sanitize_text_field($post['cuidador_cedula'] ?? ''),
			'nivel_academico' => sanitize_text_field($post['nivel_academico'] ?? ''),
			'profesion_oficio' => sanitize_text_field($post['profesion'] ?? ''),
			'labora_actualmente' => sanitize_text_field($post['labora'] ?? 'no'),
			'tiene_emprendimiento' => sanitize_text_field($post['tiene_emprendimiento'] ?? 'no'),
			'nombre_emprendimiento' => sanitize_text_field($post['nombre_emprendimiento'] ?? ''),
			'rif_emprendimiento' => sanitize_text_field($post['rif_emprendimiento'] ?? ''),
			'area_comercial' => sanitize_text_field($post['area_comercial'] ?? ''),
			'tiene_credito_bancario' => sanitize_text_field($post['tiene_credito_bancario'] ?? 'no'),
			'nombre_banco' => sanitize_text_field($post['nombre_banco'] ?? ''),
			'usuario_registrador' => sanitize_text_field($post['usuario_registrador'] ?? '')
		);
	}

	private function validar_archivos() {
		$archivos = array();
		$documentos = array(
			'doc_cedula' => 'cedula',
			'doc_informe' => 'informe_medico',
			'doc_foto' => 'fotografia',
			'doc_solicitud' => 'solicitud'
		);
		foreach ($documentos as $input_name => $tipo_documento) {
			if (!isset($_FILES[$input_name]) || $_FILES[$input_name]['error'] !== UPLOAD_ERR_OK) {
				return new WP_Error('archivo_faltante', "Falta el documento: {$tipo_documento}");
			}
			$archivo = $_FILES[$input_name];
			if (!is_uploaded_file($archivo['tmp_name'])) {
				return new WP_Error('archivo_invalido', "El archivo {$tipo_documento} no es válido.");
			}
			$tipo_mime = wp_check_filetype_and_ext($archivo['tmp_name'], $archivo['name']);
			if (!in_array(strtolower($tipo_mime['ext']), array('pdf', 'jpg', 'jpeg', 'png'))) {
				return new WP_Error('tipo_invalido', "El archivo {$tipo_documento} debe ser PDF, JPG o PNG.");
			}
			if ($archivo['size'] > 5 * 1024 * 1024) {
				return new WP_Error('tamano_excedido', "El archivo {$tipo_documento} excede 5MB.");
			}
			$archivos[$tipo_documento] = array(
				'nombre' => $archivo['name'],
				'ruta' => $archivo['tmp_name'],
				'tamano' => $archivo['size']
			);
		}
		return $archivos;
	}

	private function build_api_payload($datos, $archivos) {
		$payload = array(
			'cedula' => $datos['cedula'],
			'nombre' => $datos['nombre'],
			'apellido' => $datos['apellido'],
			'nacionalidad' => $datos['nacionalidad'],
			'email' => $datos['correo'],
			'telefono' => $datos['telefono'],
			'fecha_naci' => $datos['fecha_nacimiento'],
			'sexo' => $datos['sexo'],
			'edo_civil' => $datos['estado_civil'],
			'nro_hijo' => $datos['numero_hijos'],
			'estado' => $datos['estado'],
			'municipio' => $datos['municipio'],
			'parroquia' => $datos['distrito'],
			'discapacidad' => $datos['tipo_discapacidad'],
			'certificado' => $datos['numero_certificado'],
			'direccion' => $datos['direccion'],
			'proteccion_social' => $datos['recibe_bono_jose_gregorio'],
		);

		if (!empty($archivos)) {
			$payload['documentos'] = array();
			$mapa = array(
				'cedula' => 'doc_cedula',
				'informe_medico' => 'doc_informe',
				'fotografia' => 'doc_foto',
				'solicitud' => 'doc_solicitud'
			);
			foreach ($archivos as $tipo => $info) {
				$contenido = file_get_contents($info['ruta']);
				if ($contenido !== false) {
					$payload['documentos'][$mapa[$tipo]] = array(
						'nombre' => $info['nombre'],
						'contenido' => base64_encode($contenido)
					);
				}
			}
		}

		return $payload;
	}

	private function call_api($action, $data, $method = 'POST') {
		$url = add_query_arg(array('action' => $action), SIDAII_API_URL);
		$args = array(
			'headers' => array(
				'X-API-Key' => SIDAII_API_KEY,
				'Content-Type' => 'application/json'
			),
			'timeout' => 60,
			'redirection' => 0,
		);

		if ($method === 'GET') {
			$url = add_query_arg($data, $url);
		} else {
			$args['body'] = json_encode($data);
		}

		$respuesta = wp_remote_post($url, $args);

		if (is_wp_error($respuesta)) {
			error_log('SIDAII API Error: ' . $respuesta->get_error_message());
		}

		return $respuesta;
	}

	private function get_ip_usuario() {
		$ip = !empty($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] :
			(!empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0] :
			$_SERVER['REMOTE_ADDR']);
		return filter_var($ip, FILTER_VALIDATE_IP) ?: '0.0.0.0';
	}

	private function enviar_notificacion_registro_api($datos) {
		$numero_registro = 'CONAPDIS-' . str_pad($datos['cedula'], 8, '0', STR_PAD_LEFT);
		$asunto = "[CONAPDIS] Nuevo Registro - {$numero_registro}";
		$mensaje = "Nuevo beneficiario registrado en CONAPDIS (vía API Centralizada):
";
		$mensaje .= "Cédula: {$datos['cedula']}
";
		$mensaje .= "Nombre: {$datos['nombre']} {$datos['apellido']}
";
		$mensaje .= "Discapacidad: {$datos['tipo_discapacidad']}
";
		$mensaje .= "Estado: {$datos['estado']}
";
		$mensaje .= "Fecha: " . current_time('d/m/Y H:i:s');
		wp_mail(get_option('admin_email'), $asunto, $mensaje);
		if (!empty($datos['correo']) && is_email($datos['correo'])) {
			$asunto_user = "Confirmación de Registro - CONAPDIS FMJGH";
			$mensaje_user = "Estimado(a) {$datos['nombre']} {$datos['apellido']},
";
			$mensaje_user .= "Su registro en el Sistema Integral de Desarrollo para Personas con Discapacidad ha sido recibido exitosamente.
";
			$mensaje_user .= "Su solicitud será procesada por la Gerencia de Gestión Operativa Estadal.
";
			$mensaje_user .= "Atentamente,
";
			$mensaje_user .= "FMJGH - CONAPDIS";
			wp_mail($datos['correo'], $asunto_user, $mensaje_user);
		}
	}
}
CONAPDIS_Beneficiario_Form::get_instance();
