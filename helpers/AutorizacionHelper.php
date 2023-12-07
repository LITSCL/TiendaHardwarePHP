<?php
class AutorizacionHelper {
	
	public static function validarUsuario() {
		if (!isset($_SESSION["usuario"])) {
			header("Location: " . BASE_URL);
		}
	}
	
	public static function validarAdministrador() {
		if (isset($_SESSION["usuario"])) {
			if ($_SESSION["usuario"]->tipo != "Administrador") {
				header("Location: " . BASE_URL);
			}
		}
		else {
			header("Location: " . BASE_URL);
		}
	}
	
	public static function validarCliente() {
		if (isset($_SESSION["usuario"])) {
			if ($_SESSION["usuario"]->tipo != "Cliente") {
				header("Location: " . BASE_URL);
			}
		}
		else {
			header("Location: " . BASE_URL);
		}
	}
	
}
?>