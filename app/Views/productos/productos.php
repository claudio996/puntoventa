<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="container">

    <div>
        <p><a href="<?php echo base_url()  . '/productos/create' ?> " class="btn btn-success">Agregar producto</a></p>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nombre</th>
                    <th>Codigo barra</th>
              
           
                    <th>Precio Compra</th>
               
                    <th>Fecha creacion</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($producto as $p) : ?>
                        <td><?= $p->id; ?> </td>
                        <td><?= $p->nombre; ?> </td>
                        <td><?= $p->codigo_barra; ?> </td>
                        <td><?= $p->precio_compra; ?></td>
                        <td><?= $p->created_at; ?></td>
                        <td><a href="<?= base_url() . '/productos/edit/'  . $p->id ?>">Editar</a></td>
                        <td><a href="<?//= base_url() . '/categorias/delete/'  . $c['id'] ?>">Eliminar</a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection()  ?>