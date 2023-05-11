<!-- Include jQuery library 
<script src="<?php //echo base_url('assets/js/jquery.min.js'); 
                ?>"></script>
                -->


<script>
    // Update item quantity
    function updateCartItem(obj, rowid) {
        $.get("<?php echo base_url('cart/updateItemQty/'); ?>", {
            rowid: rowid,
            qty: obj.value
        }, function(resp) {

            if (resp == 'ok') {
                location.reload();
                //console.log(rowid)

            } else {
                alert('Cart update failed, please try again.');
            }

        });
    }
</script>

<h1>Pedido</h1>
<div class="mb-2">
    <a href="<?= base_url('productos/') ?>">Seleccionar mas productos</a>
    <a href="<?= base_url('checkout/') ?>" style="float:right; margin-right:6px;">Siguiente</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th width="15%">Producto</th>
            <th width="15%">Nombre</th>
            <th width="15%">Precio</th>
            <th width="15%" class="text-center">Unidades</th>
            <th width="15%" class="text-center">Stock</th>
            <!-- <th>Descuento</th> -->
            <th width="15%" class="">Subtotal</th>
            <th width="10%" class="">Opcion</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($this->cart->total_items() > 0) {
            foreach ($cartItems as $item) {    ?>
                <tr>
                    <td>
                        <?php $imageURL = !empty($item["imagen"]) ? base_url('public/uploads/imagenes_productos/' . $item["imagen"]) : base_url('public/uploads/sin_imagen/woodbridge.jpeg'); ?>
                        <img src="<?php echo $imageURL; ?>" width="50" />
                    </td>
                    <td><?php echo $item["nombre"]; ?></td>
                    <td><?php echo '$' . $item["precio"] . ' MXN'; ?></td>
                    <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
                    <td class="text-center"><b><?= $item['inventario'] ?></b></td>
                    <?php //Descuento ?>
                    <td class=""><?php echo '$' . $item["subtotal"] . ' MXN'; ?>
                    </td>
                    <td class=""><button class="btn btn-sm btn-danger" onclick="return confirm('Desear eliminar el producto del pedido?')?window.location.href='<?php echo base_url('cart/removeItem/' . $item["rowid"]); ?>':false;"><i class="fas fa-trash"></i> </button> </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="6">
                    <p>Tu pedido esta vacio.....</p>
                </td>
            <?php } ?>
            <?php if ($this->cart->total_items() > 0) { ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right"><strong>Total Pedido</strong></td>
                <td class="text-left"><strong><?php echo '$' . $this->cart->total() . ' MXN'; ?></strong></td>
                <td></td>
            </tr>
        <?php } ?>
    </tbody>
</table>