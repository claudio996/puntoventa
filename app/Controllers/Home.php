<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;

class Categorias extends BaseController
{
    protected $categorias, $validador;
    public function __construct()
    {
        $this->validador = service('validation');
        $this->categorias = new CategoriasModel();
    }
    public function index()
    {
        $categoria = $this->categorias->getCategorias();
        $data = ['categorias' => $categoria];
        return view('categorias/categorias', $data);
    }
    public function create()
    {
        return view('categorias/create');
    }

    public function store()
    {
        $this->validador->setRules(['nombre' => 'required|is_unique[categorias.nombre]']);
        if (!$this->validador->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validador->getErrors());
        } else {
            $this->categorias->save([
                'nombre' => $this->request->getVar('nombre')
            ]);

            return redirect()->back()->withInput()->with('msg', [
                'type' => 'success',
                'body' => 'Categoria almacenada'
            ]);
        }
    }
    public function edit(string $id)
    {
        if (!$categoria = $this->categorias->find($id)) {
            return redirect()->back();
        } else {
            return view('categorias/edit', ['categoria' => $categoria]);
        }
    }
    //Buscar hashids.
    public function update()
    {
        if (!$this->validate(['nombre' => 'required', 'id' => 'required|is_not_unique[categorias.id]',])) {
            return redirect()->back()->withInput()->with('errors', $this->validador->getErrors());
        } else {
            $this->categorias->update([$this->request->getVar('id')], ['nombre' => $this->request->getVar('nombre')]);
            return redirect('categorias')->with('msg', [
                'type' => 'success',
                'body' => 'Categoria actualizada'
            ]);
        }
    }
    public function delete(string $id)
    {
        $this->categorias->update($id, ['estado' => 0]);
        return  redirect()->to(base_url() . '/categorias');
    }
}
