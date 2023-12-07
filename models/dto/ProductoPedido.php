<?php
class ProductoPedido {
	private $id;
	private $unidades;
	private $productoFK;
	private $pedidoFK;
	
	public function getId() {
		return $this->id;
	}

	public function getUnidades() {
		return $this->unidades;
	}

	public function getProductoFK() {
		return $this->productoFK;
	}

	public function getPedidoFK() {
		return $this->pedidoFK;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setUnidades($unidades) {
		$this->unidades = $unidades;
	}

	public function setProductoFK($productoFK) {
		$this->productoFK = $productoFK;
	}

	public function setPedidoFK($pedidoFK) {
		$this->pedidoFK = $pedidoFK;
	}
}
?>