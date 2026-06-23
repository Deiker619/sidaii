<?php

/**
 * MailHelper — Envío de correos transaccionales desde la API.
 *
 * Únicamente usado para notificaciones automáticas (registro web, etc.).
 * NO interfiere con el sistema de correos del Escritorio (reportes, etc.).
 */
class MailHelper
{
	private PHPMailer\PHPMailer\PHPMailer $mail;
	private string $lastError = "";

	public function __construct()
	{
		$this->initMailer();
	}

	/**
	 * Envía un correo de confirmación de registro exitoso.
	 *
	 * @param string $destinatario Email del beneficiario registrado.
	 * @param string $nombre       Nombre del beneficiario.
	 * @param string $apellido     Apellido del beneficiario.
	 * @param string $cedula       Cédula del beneficiario.
	 * @return bool True si se envió correctamente, False si falló.
	 */
	public function sendRegistroExitoso(
		string $destinatario,
		string $nombre,
		string $apellido,
		string $cedula
	): bool {
		try {
			$this->mail->clearAddresses();
			$this->mail->addAddress($destinatario, "$nombre $apellido");

			$this->mail->Subject = "Registro Exitoso — SIDAII";

			$this->mail->Body = <<<HTML
			<!DOCTYPE html>
			<html lang="es">
			<head>
				<meta charset="UTF-8">
			</head>
			<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
				<table style="max-width: 600px; margin: 0 auto; border-collapse: collapse;">
					<tr>
						<td style="background-color: #003366; padding: 20px; text-align: center; border-radius: 4px 4px 0 0;">
							<h1 style="color: #ffffff; margin: 0; font-size: 22px;">SIDAII</h1>
							<p style="color: #ffffff; margin: 5px 0 0;">Sistema Integral de Atención a Personas con Discapacidad</p>
						</td>
					</tr>
					<tr>
						<td style="padding: 30px; background-color: #ffffff; border: 1px solid #ddd;">
							<p style="font-size: 16px;">Estimado(a) <strong>$nombre $apellido</strong>,</p>
							<p>Su registro en el sistema SIDAII se ha completado <strong style="color: #28a745;">exitosamente</strong>.</p>
							<table style="background-color: #f8f9fa; padding: 15px; border-radius: 4px; margin: 15px 0;">
								<tr>
									<td style="padding: 5px 10px; font-weight: bold;">Cédula:</td>
									<td style="padding: 5px 10px;">$cedula</td>
								</tr>
								<tr>
									<td style="padding: 5px 10px; font-weight: bold;">Nombre:</td>
									<td style="padding: 5px 10px;">$nombre $apellido</td>
								</tr>
							</table>
							<p>Su solicitud ha sido recibida y será procesada por la coordinación correspondiente. Recibirá notificaciones sobre el avance de su atención.</p>
							<p style="margin-top: 20px;">Atentamente,<br><strong>Fundación José Gregorio Hernández</strong></p>
						</td>
					</tr>
					<tr>
						<td style="background-color: #f1f1f1; padding: 15px; text-align: center; font-size: 12px; color: #666; border-radius: 0 0 4px 4px;">
							Este es un mensaje automático generado por el sistema SIDAII. Por favor no responda a este correo.
						</td>
					</tr>
				</table>
			</body>
			</html>
			HTML;

			$this->mail->AltBody = "Registro exitoso — SIDAII\n\n"
				. "Estimado(a) $nombre $apellido,\n\n"
				. "Su registro se ha completado exitosamente.\n"
				. "Cédula: $cedula\n\n"
				. "Su solicitud será procesada por la coordinación correspondiente.\n\n"
				. "Fundación José Gregorio Hernández";

			$this->mail->send();
			return true;

		} catch (Exception $e) {
			$this->lastError = $e->getMessage();
			return false;
		}
	}

	/**
	 * Retorna el último error ocurrido.
	 */
	public function getLastError(): string
	{
		return $this->lastError;
	}

	/**
	 * Inicializa y configura la instancia de PHPMailer.
	 */
	private function initMailer(): void
	{
		$phpmailerDir = __DIR__ . "/../Escritorio/PHPMailer/src";

		require_once $phpmailerDir . "/Exception.php";
		require_once $phpmailerDir . "/PHPMailer.php";
		require_once $phpmailerDir . "/SMTP.php";

		$this->mail = new PHPMailer\PHPMailer\PHPMailer(true);

		$this->mail->isSMTP();
		$this->mail->Host       = MAIL_HOST;
		$this->mail->SMTPAuth   = true;
		$this->mail->Username   = MAIL_USERNAME;
		$this->mail->Password   = MAIL_PASSWORD;
		$this->mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
		$this->mail->Port       = MAIL_PORT;
		$this->mail->CharSet    = "UTF-8";

		$this->mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);

		$this->mail->isHTML(true);
	}
}
