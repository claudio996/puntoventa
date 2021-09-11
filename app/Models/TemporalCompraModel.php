<?php

namespace App\Models;

use CodeIgniter\Model;

class TemporalCompraModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'temporalcompra';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['producto_id', 'folio', 'codigo_barra', 'nombre', 'cantidad', 'subtotal'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

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

    public function buscarProductoT($id_producto, $id_compra)
    {
        $this->where('producto_id', $id_producto);
        $this->where('folio', $id_compra);
        $datos = $this->get()->getRow();
        return $datos;
    }

    public function subtotal($id_producto)
    {
        $this->select('subtotal');
        $this->where('producto_id', $id_producto);
        $subtotal = $this->get()->getRow();
        return $subtotal;
    }
    public function actualizarCompra($id_producto, $id_compra, $cantidad, $subtotal)
    {
        $this->set('cantidad', $cantidad);
        $this->set('subtotal', $subtotal);
        $this->where('producto_id', $id_producto);
        $this->where('folio', $id_compra);
        return $this->update();
    }
}
