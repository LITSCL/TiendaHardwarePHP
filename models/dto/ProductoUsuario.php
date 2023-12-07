<?php
class ProductoUsuario {
	private $id;
	private $productoFK;
	private $usuarioFK;
	
	public function getId() {
		return $this->id;
	}

	public function getProductoFK() {
		return $this->productoFK;
	}

	public function getUsuarioFK() {
		return $this->usuarioFK;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setProductoFK($productoFK) {
		$this->productoFK = $productoFK;
	}

	public function setUsuarioFK($usuarioFK) {
		$this->usuarioFK = $usuarioFK;
	}
}
?>