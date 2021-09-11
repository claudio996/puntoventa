<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\ProductosEntity;
use App\Models\ProductosModel;
use App\Models\TemporalCompraModel;

class TemporalCompra extends BaseController
{
    protected $producto, $temporalCompra, $productos;
    public function __construct()
    {
        $this->productos = new ProductosModel();
        $this->temporalCompra = new TemporalCompraModel();
        $this->producto = new ProductosEntity();
    }
    public function buscarCodigo($codigo_barra)
    {
        $this->productos->getCodigo($codigo_barra);
    }

    public function temporalCompra($id_producto, $cantidad, $id_compra)
    {
        $producto = $this->productos->getProducto($id_producto);
        //	$minimos = $this->productos->minimos($id_producto);

        if ($producto->stock_minimo > $cantidad && $producto->stock_minimo  > $producto->existencias) {

            $productos    = $this->temporalCompra->buscarProductoT($id_producto, $id_compra);
            if (!$productos) {

                $this->calcularsubtotal($cantidad);
                $this->temporalCompra->insert([
                    'producto_id' => $producto->id,
                    'folio' => $id_compra,
                    'codigo_barra' => $producto->codigo_barra,
                    'nombre' => $producto->nombre,
                    'cantidad' => $cantidad,
                    'subtotal' => $this->calcularsubtotal($cantidad)
                ]);

                $this->decender_stock($cantidad, $id_producto);
            } else {

                $this->producto_existente($cantidad, $id_producto, $id_compra);
            }
        } else {
            echo ("sin productos");
        }
    }
    //llevar funciones a otra clase.
    public function calcularsubtotal($cantidad)
    {
        $subtotal =  ($cantidad) * $this->producto->precio_compra;
        return $subtotal;
    }

    public function producto_existente($cantidad, $id_producto, $id_compra)
    {
        $cantidad  = $this->productos->cantidad + $cantidad;
        $subtotal = $this->calcularsubtotal($cantidad) + $cantidad;
        $stock = ($this->producto->stock_minimo - $cantidad);
        $this->productos->actualizarStock($id_producto, $stock);

        $this->temporalCompra->actualizarCompra($id_producto, $id_compra, $cantidad, $subtotal);
        $this->productos->decender_stock($cantidad, $id_producto);
    }
    public function decender_stock($cantidad, $id_producto)
    {

        $stock = ($this->producto->stock_minimo - $cantidad);
        $this->productos->actualizarStock($id_producto, $stock);
    }
}
