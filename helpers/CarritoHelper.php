<?php
class CarritoHelper {
	
	public static function obtenerTotal() {
		$total = 0;
		if (isset($_SESSION["carrito"])) {
			foreach ($_SESSION["carrito"] as $elemento) {
				$total+=$elemento["precio"] * $elemento["unidades"];
			}
		}
		return $total;
	}
	
}
?>