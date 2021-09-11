<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
class Productos extends BaseController
{
    protected $productos;
	public function __construct()
	{
		$this->productos = new ProductosModel();
	}
	public function index()
	{
		$productos = ['producto' => $this->productos->getProductos()];
		return view('productos/productos', $productos);
	}
	public function create(){
		echo ('en funcion');
	}
	public function edit(){
		echo ('en funcion');
	}
}
