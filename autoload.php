<?php
function app_autoloader($clase) {
	require_once 'controllers/' . $clase . '.php';
}

spl_autoload_register("app_autoloader");
?>