<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="container">

    <div>
        <p><a href="<?php echo base_url()  . '/categorias/create' ?> " class="btn btn-success">Agregar Categoria</a></p>
    </div>

    <?php if (session('msg')) : ?>
        <div class="alert alert-primary" role="alert">
            <article class="message is-<?= session('msg.type') ?> ">
                <div class="message-body">
                    <?= session('msg.body') ?>
                </div>
            </article>
        </div>
    <?php endif ?>

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nombre</th>
                    <th>Fecha creacion</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($categorias as $c) : ?>
                        <td><?= $c['id']; ?> </td>
                        <td><?= $c['nombre']; ?></td>
                        <td><?= $c['created_at']; ?></td>
                        <td><a href="<?= base_url() . '/categorias/edit/'  . $c['id'] ?>">Editar</a></td>
                        <td><a href="<?= base_url() . '/categorias/delete/'  . $c['id'] ?>">Eliminar</a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection()  ?>