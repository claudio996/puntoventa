<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'productos';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'codigo_barra', 'nombre', 'precio_venta', 'precio_compra',
        'existencias', 'stock_minimo', 'inventariable', 'categoria_id', 'estado'
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];


    public function getProductos()
    {
        $this->select('*');
        $this->where('estado', 1);
        return  $this->first();
    }

    public function getCodigo($codigo_barra)
    {
        $datos = $this->where('codigo_barra', $codigo_barra)->where('estado', 1)->first();
        //Creamos arreglos para diversas respuestas que podemos obtener del json.
        $resultado['existe'] = false;
        $resultado['datos'] = '';
        $resultado['error'] = '';

        if (!$datos) {
            $resultado['error'] = 'este dato no existe';
            $resultado['existe'] = false;
        } else {
            $resultado['datos'] = $datos;
            $resultado['existe'] = true;
        }
        echo json_encode($resultado);
    }

    public function getProducto($id_producto)
    {
        return $this->select('*')->where('id', $id_producto)->first();
    }

    public function actualizarStock($id_producto, $stock)
    {
        $this->set('stock_minimo', $stock);
        $this->where('id', $id_producto);
        return    $this->update();
    }
    public function minimos($id_producto)
    {
        $this->select('stock_minimo');
        $this->where('id', $id_producto);
        return $this->get()->getRow();
    }
}
