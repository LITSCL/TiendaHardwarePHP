<?php
class Helper {
	
	public static function borrarSesion($nombre) {
		if (isset($_SESSION[$nombre])) {
			unset($_SESSION[$nombre]);
		}
	}
    
	public static function cadenaAleatoria() {
		$caracteresPermitidos = "0123456789abcdefghijklmnopqrstuvwxyz";
		$cadenaAleatoria = substr(str_shuffle($caracteresPermitidos), 0, 15);
    	
		return $cadenaAleatoria;
	}
	
}
?>