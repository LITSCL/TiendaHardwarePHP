<?php
class Producto {
	private $id;
	private $nombre;
	private $descripcion;
	private $precio;
	private $stock;
	private $imagen;
	private $categoriaFK;
    
	public function getId() {
		return $this->id;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function getDescripcion() {
		return $this->descripcion;
	}

	public function getPrecio() {
		return $this->precio;
	}

	public function getStock() {
		return $this->stock;
	}

	public function getImagen() {
		return $this->imagen;
	}

	public function getCategoriaFK() {
		return $this->categoriaFK;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}

	public function setPrecio($precio) {
		$this->precio = $precio;
	}

	public function setStock($stock) {
		$this->stock = $stock;
	}

	public function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	public function setCategoriaFK($categoriaFK) {
		$this->categoriaFK = $categoriaFK;
	}   
}
?>