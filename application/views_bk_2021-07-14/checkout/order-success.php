

<h1>Estatus del Pedido</h1>

<div class="col-md-2">
    <a href="<?= base_url('pedidos/')?>">Pedidos</a>
</div>

<div class="col-md-2">
    <a href="<?= base_url('productos/')?>">Nuevo Pedido</a>
</div>

<?php if (!empty($order)) { ?>
    <div class="col-md-12">
        <div class="alert alert-primary">El pedido se ha cargado exitosamente</div>
    </div>

    <!-- Order status & shipping info -->
    <div class="card border-success mb-3" style="max-width: 20rem;">
        <div class="card-header">Info del Pedido</div>
        <div class="card-body text-success">
            <h5 class="card-title"><b>ID de Pedido: </b><?php echo $order['id']; ?></h5>
            <p class="card-text"><b>Total:</b> <?php echo '$' . $order['total_pedido'] . ' MXN'; ?></p>
            <p class="card-text"><b>Hora de Registro:</b> <?php echo $order['created_at']; ?></p>
            <p class="card-text"><b>Nombre:</b> <?php echo $order['nombre']; ?></p>
            <p class="card-text"><b>Email:</b> <?php echo $order['telefono']; ?></p>
        </div>
    </div>
    <!-- Order items -->
    <div class="row col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($order['items'])) {
                    foreach ($order['items'] as $item) {
                ?>
                        <tr>
                            <td>
                                <?php $imageURL = !empty($item["imagen"]) ? base_url('public/uploads/imagenes_productos/' . $item["imagen"]) : base_url('public/uploads/sin_imagen/woodbridge.jpeg'); ?>
                                <img src="<?php echo $imageURL; ?>" width="75" />
                            </td>
                            <td><?php echo $item["nombre"]; ?></td>
                            <td><?php echo '$' . $item["precio"] .' MXN'; ?></td>
                            <td><?php echo $item["unidades"]; ?></td>
                            <td><?php echo '$' . $item["precio_producto"] . ' MXN'; ?></td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div class="col-md-12">
        <div class="alert alert-danger">No se ha cargado tu pedido</div>
    </div>
<?php } ?>