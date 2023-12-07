<?php
if (file_exists('config/parameters.php')) {
	require_once 'config/parameters.php';
}
else {
	require_once '../config/parameters.php';
}
?>

<?php
class UsuarioControlador {
	
	public function controlador() { 
		require_once '../models/dto/Usuario.php';
		require_once '../models/dao/UsuarioDAO.php';
		require_once '../helpers/Helper.php';
		require_once '../helpers/AutorizacionHelper.php';
		
		if (isset($_POST["opcion"]) || isset($_GET["opcion"])) {
			if (isset($_POST["opcion"])) {
				$opcion = $_POST["opcion"];
			}
			else {
				$opcion = $_GET["opcion"];
			}
			switch ($opcion) {
				case "1": //Registro.	
					if (isset($_SESSION["usuario"])) {
						header("Location: " . BASE_URL);
					}
					else {
						$correo = (isset($_POST["correo"])) ? $_POST["correo"] : false;
						$clave = (isset($_POST["clave"])) ? $_POST["clave"] : false;
						$primerNombre = (isset($_POST["primerNombre"])) ? $_POST["primerNombre"] : false;
						$segundoNombre = (isset($_POST["segundoNombre"])) ? $_POST["segundoNombre"] : false;
						$apellidoPaterno = (isset($_POST["apellidoPaterno"])) ? $_POST["apellidoPaterno"] : false;
						$apellidoMaterno = (isset($_POST["apellidoMaterno"])) ? $_POST["apellidoMaterno"] : false;
						
						if ($correo && $clave && $primerNombre && $segundoNombre && $apellidoPaterno && $apellidoMaterno) {
							$daoUsuario = new UsuarioDAO();
							$u = new Usuario();
							
							$u->setCorreo($correo);
							$u->setClave($clave);
							$u->setTipo("Cliente");
							$u->setPrimerNombre($primerNombre);
							$u->setSegundoNombre($segundoNombre);
							$u->setApellidoPaterno($apellidoPaterno);
							$u->setApellidoMaterno($apellidoMaterno);
							$u->setImagen("Default.png");
							
							if ($daoUsuario->save($u)) {
								$_SESSION["registro"] = "Exitoso";
							} else {
								$_SESSION["registro"] = "Fallido";
							}
							header("Location: " . BASE_URL . "Usuario/Registrarse");
						}
						else {
							header("Location: " . BASE_URL);
						}
					}
					break;
				case "2": //Iniciar sesión.
					if (isset($_SESSION["usuario"])) {
						header("Location: " . BASE_URL);
					}
					else {
						$correo = (isset($_POST["correo"])) ? $_POST["correo"] : false;
						$clave = (isset($_POST["clave"])) ? $_POST["clave"] : false;
						
						if ($correo && $clave) {
							$verificacion = false;
							$daoUsuario = new UsuarioDAO();
							$usuario = $daoUsuario->findOne("correo", $correo);
							
							if ($usuario && $usuario->num_rows == 1) {
								$usuario = $usuario->fetch_object();
								$verificacion = password_verify($clave, $usuario->clave);
							}
							if ($verificacion == true) {
								$_SESSION["usuario"] = $usuario;
								header("Location: " . BASE_URL);
							}
							else {
								$_SESSION["error_login"] = "Credenciales incorrectas";
								header("Location: " . BASE_URL . "Usuario/IniciarSesion");
							}
						}
						else {
							header("Location: " . BASE_URL);
						}
					}
					break;
				case "3": //Cerrar sesión.
					Helper::borrarSesion("usuario");
					Helper::borrarSesion("carrito");
					header("Location: " . BASE_URL);
					break;
				case "4": //Editar perfil.
					AutorizacionHelper::validarUsuario();
					
					$id	= $_SESSION["usuario"]->id;
					$correo = (isset($_POST["correo"])) ? $_POST["correo"] : false;
					$clave = (isset($_POST["clave"])) ? $_POST["clave"] : false;
					$primerNombre = (isset($_POST["primerNombre"])) ? $_POST["primerNombre"] : false;
					$segundoNombre = (isset($_POST["segundoNombre"])) ? $_POST["segundoNombre"] : false;
					$apellidoPaterno = (isset($_POST["apellidoPaterno"])) ? $_POST["apellidoPaterno"] : false;
					$apellidoMaterno = (isset($_POST["apellidoMaterno"])) ? $_POST["apellidoMaterno"] : false;
					
					$archivo = $_FILES["imagen"];
					if ($archivo["name"] != "") {
						$nombreArchivo = Helper::cadenaAleatoria() . "-" . $archivo["name"];
					}
					else {
						$nombreArchivo = "";
					}
					$tipoArchivo = $archivo["type"];
					
					$nuevaImagen = false;
					$imagenSubida = false;
					if ($tipoArchivo != "") {
						$nuevaImagen = true;
						if ($tipoArchivo == "image/jpg" || $tipoArchivo == "image/jpeg" || $tipoArchivo == "image/png") {
							
							if (!is_dir("../uploads/models/usuario/images/")) {
								mkdir("../uploads/models/usuario/images/", 0777, true);
							}
							move_uploaded_file($archivo["tmp_name"], "../uploads/models/usuario/images/" . $nombreArchivo);
							
							$usuario = $_SESSION["usuario"];
							
							if ($usuario->imagen != "Default.png") {
								unlink("../uploads/models/usuario/images/" . $usuario->imagen);	
							}		
							
							$imagenSubida = true;
						}
						else {
							$_SESSION["editar_perfil"] = "Fallido";
						}
					}
					
					if ($nuevaImagen == true && $imagenSubida == true || $nuevaImagen == false) {
						if ($correo && $clave && $primerNombre && $segundoNombre && $apellidoPaterno && $apellidoMaterno) {
							$daoUsuario = new UsuarioDAO();
							$u = new Usuario();

							$u->setId($id);	
							$u->setCorreo($correo);	
							
							if ($clave == "Clave no cambiada") {
								$u->setClave("");
							}
							else {
								$u->setClave($clave);
							}	
							
							$u->setPrimerNombre($primerNombre);
							$u->setSegundoNombre($segundoNombre);
							$u->setApellidoPaterno($apellidoPaterno);
							$u->setApellidoMaterno($apellidoMaterno);
							$u->setImagen($nombreArchivo);
							
							if ($daoUsuario->update($u)) {
								Helper::borrarSesion("usuario");
								$daoUsuario = new UsuarioDAO();
								$usuario = $daoUsuario->find($id);							
								$_SESSION["usuario"] = $usuario->fetch_object();
								
								$_SESSION["editar_perfil"] = "Exitoso";
							} else {
								$_SESSION["editar_perfil"] = "Fallido";
							}
						}
					}
					else {
						$_SESSION["editar_perfil"] = "Fallido";
					}
					header("Location: " . BASE_URL . "Usuario/EditarPerfil");
					break;
				default:
					return "No existe la opción";
			}
		}
		return "No se envió una opción válida para controlar";
	}
	
	public function renderizarVistaRegistrarse() {
		if (isset($_SESSION["usuario"])) {
			header("Location: " . BASE_URL);
		}
		else {
			require_once 'views/models/usuario/registrarse.php';
		}	
	}
	
	public function renderizarVistaIniciarSesion() {
		if (isset($_SESSION["usuario"])) {
			header("Location: " . BASE_URL);
		}
		else {
			require_once 'views/models/usuario/iniciar_sesion.php';
		}
	}
	
	public function renderizarVistaEditarPerfil() {
		AutorizacionHelper::validarUsuario();
		
		$usuario = $_SESSION["usuario"];
		
		require_once 'views/models/usuario/editar_perfil.php';
	}

}

if (isset($_POST["opcion"]) || isset($_GET["opcion"])) {
	session_start();
	$uc = new UsuarioControlador();
	$uc->controlador();
}
?>