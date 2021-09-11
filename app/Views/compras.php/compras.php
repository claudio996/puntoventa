<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<?php $id_compra = uniqid()  ?>
<div class="container">
    <form action="" method="post">

        <div class="container-fluid">
            <form method="POST" action="<?php echo base_url(); ?>/compras/guardar" id="formulario_compra" name="formulario_compra" autocomplete="off">

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">

                            <input type="hidden" id="id_producto" name="id_producto" />
                            <input type="hidden" id="id_compra" name="id_compra" value="<?php echo $id_compra; ?>" />

                            <label>Código</label>
                            <input class="form-control" id="codigo_barra" name="codigo_barra" type="text" placeholder="Introduzca el codigo y presione ENTER" onkeyup="buscarCodigo(event, this.value)" autofocus />

                            <!--Creamos el label para mostra el error.!-->
                            <label for="codigo_barra" id="resultado_error" style="color: red"></label>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label>Nombre del producto</label>
                            <input class="form-control" id="nombre" name="nombre" type="text" disabled />
                        </div>

                        <div class="col-12 col-sm-4">
                            <label>Cantidad</label>
                            <input class="form-control" id="cantidad" name="cantidad" type="text" placeholder="Introduzca cantidad" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label>Precio de compra</label>
                            <input class="form-control" type="text" id="precio_compra" name="precio_compra" disabled />
                        </div>
                        <div class="col-12 col-sm-4">
                            <label>Subtotal</label>
                            <input class="form-control" type="text" id="subtotal" name="subtotal" autofocus placeholder="Introduzca subtotal" disabled />
                        </div>

                        <div class="col-12 col-sm-4">
                            <label> <br>&nbsp;</label>
                            <button id="agregar_producto" name="agregar_producto" type="button" class="btn btn-primary" onclick="agregarProducto(id_producto.value,cantidad.value,'<?php echo $id_compra; ?>')">Añadir al carro</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <table id="tablaProductos" class="table table-hover table-striped table-sm table-responsive productos" width="100%">
                        <thead class="thead-dark">

                            <th>#</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th width="1%"></th>

                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 offset-md-6">
                        <label style="font-weight: bold; font-size:30px; text-align:center;">Total $</label>
                        <input type="text" id="total" name="total" size="7" readonly="true" value="0.00" style="font-weight: bold; font-size:30px; text-align:center;" />

                        <button type="submit" id="completarCompra" class="btn btn-success">Completar Compra</button>

                    </div>

                </div>
            </form>

        </div>



    </form>
</div>

<script>
    //funcion principal.
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        })
    })

    function buscarCodigo(e, codigo_barra) {
        var key = 13;
        if (e.which == key) {
            //ajax.
            $.ajax({
                url: '<?php echo base_url() ?>/compras/buscarCodigo/' + codigo_barra,
                dataType: 'json',

                success: function(response) {

                    if (response == 0) {

                        $("#resultado_error").html(response.error)
                        $("#codigo_barra").val('');

                    } else {
                        //Imprimir errores

                        if (response.existe) {

                            $('#id_producto').val(response.datos.id);

                            $('#nombre').val(response.datos.nombre);
                            $('#precio_compra').val(response.datos.precio_compra);

                            $('#cantidad').val(1);
                            $('#subtotal').val(response.precio_compra);
                            $("#cantidad").focus();

                        } else {
                            //De lo contrario vaciamos el arreglo.

                            alert("El codigo no eciste");
                            $("#id_producto").val('');
                            $("#codigo_barra").val('');
                            $("#nombre").val('');
                            $("#cantidad").val('');
                            $("#precio_compra").val('');
                            $("#subtotal").val('');
                        }

                    }
                }
            })

        }

    }

    function agregarProducto(id_producto, cantidad, id_compra) {

        if (id_producto != null && id_producto != 0 && cantidad > 0) {
         
            $.ajax({

                url: '<?= base_url(); ?>/compras/temporalInsertar/' + id_producto + "/" + cantidad + "/" + id_compra,

                success: function(response) {
                    $("#resultado_error").html(response.error)
                }
            });

        }
    }
</script>
<?= $this->endSection() ?>