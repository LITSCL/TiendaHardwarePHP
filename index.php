<?php require_once 'autoload.php'; ?> 
<?php require_once 'config/parameters.php'; ?>
<?php require_once 'helpers/Helper.php'; ?>
<?php require_once 'helpers/AutorizacionHelper.php'; ?>
<?php require_once 'helpers/CarritoHelper.php'; ?>

<?php session_start(); ?>

<?php 
if (isset($_GET["controlador"])) {
	if (strstr($_GET["controlador"], "Controlador") == false) {
		$_GET["controlador"] = $_GET["controlador"] . "Controlador";
	}
}

if (!isset($_GET["controlador"]) && !isset($_GET["accion"])) {
	$_GET["controlador"] = CONTROLLER_DEFAULT;
	$_GET["accion"] = ACTION_DEFAULT;
}

if (isset($_GET["controlador"]) && file_exists("controllers/" . $_GET["controlador"] . ".php")) {
	$controlador = new $_GET["controlador"]();
	
	if (isset($_GET["accion"])) {
		if (strstr($_GET["accion"], "renderizarVista") == false) {
			$_GET["accion"] = "renderizarVista" . $_GET["accion"];
		}
	}
	
	if (isset($_GET["accion"]) && method_exists($controlador, $_GET["accion"])) { 
		$accion = $_GET["accion"];
		
		$controlador->$accion();
	} 
	else {
		require_once 'views/error.php';
	}
} 
else {
	require_once 'views/error.php';
}
?>