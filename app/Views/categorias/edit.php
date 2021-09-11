<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="container">
    <h1>categorias</h1>
    <form method="POST" action="<?php echo base_url() . '/categorias/update' ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
            <input type="text" class="form-control" name="nombre" value="<?= $categoria['nombre']  ?>">

            <?php if (session('msg')) : ?>
                <div class="alert alert-primary" role="alert">
                    <article class="message is-<?= session('msg.type') ?> ">
                        <div class="message-body">
                            <?= session('msg.body') ?>
                        </div>
                    </article>
                </div>
            <?php endif ?>
        </div>

        <div class="form-text">Ingrese una nueva categoria</div>
        <p class="is-danger help"><?= session('errors.nombre')  ?></p>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
<?= $this->endSection() ?>