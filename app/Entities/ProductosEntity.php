<?php

namespace App\Entities;
use App\Models\TemporalCompraModel;
use CodeIgniter\Entity\Entity;

class ProductosEntity extends Entity
{
    protected $temporalCompra;
    public function __construct()
    {
        $this->temporalCompra = new TemporalCompraModel();
    }

    protected $datamap = [];
    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts   = [];

    public function calsubtotal($cantidad)
    {
        $subtotal =  ($cantidad) * $this->attributes['precio_compra'];
        return $subtotal;
    }
}
