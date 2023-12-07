<?php
class Database {
	private static $servidor = "localhost";
	private static $usuario = "root";
	private static $clave = "root";
	private static $baseDeDatos = "dbtiendahardwarephp";
	private static $puerto = 3306;
	
	public static function conectar() {
		$db = new mysqli(DataBase::$servidor, DataBase::$usuario, DataBase::$clave, DataBase::$baseDeDatos, DataBase::$puerto);		
		$db->query("SET NAMES 'utf8'");
		return $db;
	}
}
?>