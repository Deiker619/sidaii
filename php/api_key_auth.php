<?php
require_once __DIR__ . "/Config.php";

class ApiAuth {
	private $log_file;

	public function __construct() {
		$log_dir = __DIR__ . "/logs";
		if (!is_dir($log_dir)) {
			mkdir($log_dir, 0755, true);
		}
		$this->log_file = $log_dir . "/api.log";
	}

	public function authenticate(): bool {
		$key = $this->getBearerToken();
		if (empty($key) || !hash_equals(API_KEY, $key)) {
			$this->log("FORBIDDEN: Invalid API Key from " . ($_SERVER["REMOTE_ADDR"] ?? "unknown"));
			http_response_code(401);
			echo json_encode(["success" => false, "message" => "No autorizado"]);
			return false;
		}
		if ($this->isRateLimited()) {
			$this->log("RATE_LIMITED: " . ($_SERVER["REMOTE_ADDR"] ?? "unknown"));
			http_response_code(429);
			echo json_encode(["success" => false, "message" => "Demasiadas peticiones. Espere un minuto."]);
			return false;
		}
		return true;
	}

	private function getBearerToken(): string {
		$headers = $this->getHeaders();
		foreach ($headers as $name => $value) {
			if (strtolower($name) === "x-api-key") {
				return trim($value);
			}
		}
		return $_GET["api_key"] ?? "";
	}

	private function isRateLimited(): bool {
		$ip = $_SERVER["REMOTE_ADDR"] ?? "127.0.0.1";
		$file = __DIR__ . "/logs/ratelimit_" . md5($ip) . ".json";
		$now = time();
		$window = API_RATE_WINDOW;
		$limit = API_RATE_LIMIT;

		$data = [];
		if (file_exists($file)) {
			$content = file_get_contents($file);
			$data = json_decode($content, true) ?: [];
			$data = array_values(array_filter($data, function($t) use ($now, $window) {
				return $t > $now - $window;
			}));
		}

		if (count($data) >= $limit) {
			return true;
		}

		$data[] = $now;
		file_put_contents($file, json_encode($data), LOCK_EX);
		return false;
	}

	public function log(string $msg): void {
		$line = date("Y-m-d H:i:s") . " [" . ($_SERVER["REQUEST_METHOD"] ?? "?") . " " . ($_GET["action"] ?? "?") . "] " . $msg . PHP_EOL;
		file_put_contents($this->log_file, $line, FILE_APPEND | LOCK_EX);
	}

	private function getHeaders(): array {
		if (function_exists("getallheaders")) {
			$h = getallheaders();
			return $h !== false ? $h : [];
		}
		$headers = [];
		foreach ($_SERVER as $k => $v) {
			if (strpos($k, "HTTP_") === 0) {
				$name = str_replace(" ", "-", ucwords(strtolower(str_replace("_", " ", substr($k, 5)))));
				$headers[$name] = $v;
			}
		}
		return $headers;
	}
}
