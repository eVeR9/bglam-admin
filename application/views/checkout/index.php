<h1>Confirmar Pedido</h1>
<div class="checkout">
    <div class="row" style="margin-left:5px;">
        <?php if (!empty($error_msg)) { ?>
            <div class="col-md-12">
                <div class="alert alert-danger"><?php echo $error_msg; ?></div>
            </div>
        <?php } ?>

        <div class="col-md-5 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted" id="prueba">Items de Pedido</span>
                <span class="badge badge-secondary badge-pill"><?php echo $this->cart->total_items(); ?></span>
            </h4>
            <ul class="list-group mb-3">
                <?php if ($this->cart->total_items() > 0) {
                    foreach ($cartItems as $item) { ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <?php $imageURL = !empty($item["imagen"]) ? base_url('public/uploads/imagenes_productos/' . $item["imagen"]) : base_url('public/uploads/sin_imagen/woodbridge.jpeg'); ?>
                                <img src="<?php echo $imageURL; ?>" width="60" />
                                <h6 class="my-0"><?php echo $item["nombre"]; ?></h6>
                                <!-- <h6 class="my-0"></h6> -->
                                <small class="text-muted"><?php echo '$' . $item["precio"]; ?>(<?php echo $item["qty"]; ?>)</small>
                            </div>
                            <span class="text-muted">
                                <?php if ($item['descuento'] != 0) : ?>
                                    <span class="text-muted">
                                        <?php
                                        //$desc = ($item['subtotal'] * $item['descuento']/100);
                                        echo $item['subtotal'] . " MXN"; //$desc*$item['qty'] ." MXN";
                                        ?>
                                    </span>
                                <?php else : ?>
                                    <span class="text-muted"><?= $item['subtotal'] . '.00 MXN'; ?></span>
                                <?php endif; ?>
                            </span>
                        </li>
                    <?php }
                } else { ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <p>No items in your cart...</p>
                    </li>
                <?php } ?>
                
                    <!-- 
                    <input type="radio" name="medio_de_pago" value="">
                    <input type="radio" name="medio_de_pago" value="">
                    <input type="radio" name="medio_de_pago" value="">
                    -->
            <form method="post">

                <li class="list-group-item d-flex">
                    <div class="col-md-8">
                        <!-- 
                        <select name="cupon" id="cupon" class="form-control" onchange="">
                            <option value="0">Selecciona un descuento</option>
                            <option value="1">5% de descuento</option>
                            <option value="2">10% de descuento</option>
                            <option value="3">15% de descuento</option>
                            <option value="4">20% de descuento</option>
                            <option value="5">25% de descuento</option>
                            <option value="6">30% de descuento</option>
                            <option value="7">35% de descuento</option>
                            <option value="8">40% de descuento</option>
                            <option value="9">45% de descuento</option>
                            <option value="10">50% de descuento</option>
                        </select>
                        -->
                        <input type="text" min="0" class="form-control" name="cupon" id="cupon" placeholder="Ingresa un descuento $" autocomplete="off">
                    </div>
                    <!-- <input type="hidden" name="valor_cupon" id="valor_cupon"> -->
                </li>

                <!-- Mantener inactivo hasta definir como actuara exactamente 
                <li class="list-group-item d-flex">
                    <div class="col-md-8">
                        <input type="text" min="0" class="form-control" name="costo_de_envio" id="costo_de_envio" placeholder="Costo de Envio">
                    </div>
                    <input type="hidden" name="valor_cupon" id="valor_cupon">
                </li>
                -->

                <li class="list-group-item d-flex">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">

                            <label class="btn btn-light">
                                <input type="radio" name="metodo_de_pago" value="visa" id="option1" onchange="getComision(1)" autocomplete="off">VISA
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="metodo_de_pago" value="paypal" id="option2" onchange="getComision(2)" autocomplete="off"> PayPal
                            </label>
                            <label class="btn btn-success active" style="background-color:#3d9970; display:none;">
                                <input type="radio" name="metodo_de_pago" value="efectivo" id="option3" onchange="getComision(3)" autocomplete="off" checked>Efectivo
                            </label>
                            <label class="btn btn-success">
                                <input type="radio" name="reset" value="reset" id="reset_total" onchange="resetComision()" autocomplete="off">Reset
                            </label>
                            <input type="hidden" id="metodo" name="metodo_visa">
                        </div>
                </li>
                
                <div id="antesComision" style="display:none;">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Subtotal (Antes de comision)</span>
                        <span id="valor_antes_comision" value=""><del>$<?php echo $this->cart->total() ?></del></span>
                    </li>
                </div>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (MXN)</span>
                    <strong><input style="background:transparent; border:none; width:75px; outline:none;" class="totalC" type="number" step="" id="totalAntesde" name="totalAntesde" value="<?= $this->cart->total() ?>" readonly></strong>
                </li>
            </ul>

            <a href="<?php echo base_url('productos/'); ?>" class="btn btn-block btn-info">Agregar mas items</a>
        </div>
        <div class="col-md-6 order-md-1">
            <h4 class="mb-3">Datos del Cliente</h4>

            <div class="mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo !empty($custData['nombre']) ? $custData['nombre'] : ''; ?>" placeholder="Nombre" required>
                <?php echo form_error('name', '<p class="help-block error">', '</p>'); ?>
            </div>
            <div class="mb-3">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?php echo !empty($custData['apellidos']) ? $custData['apellidos'] : ''; ?>" placeholder="Primer apellido" required>
                <?php echo form_error('name', '<p class="help-block error">', '</p>'); ?>
            </div>
            <div class="mb-3">
                <label for="telefono">Telefono</label>
                <input type="telefono" class="form-control" name="telefono" value="<?php echo !empty($custData['telefono']) ? $custData['telefono'] : ''; ?>" placeholder="Telefono" required>
                <?php echo form_error('telefono', '<p class="help-block error">', '</p>'); ?>
            </div>
            <!-- <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" value="<?php //echo !empty($custData['phone'])?$custData['phone']:''; 
                                                                                ?>" placeholder="Enter contact no" required>
                    <?php //echo form_error('phone','<p class="help-block error">','</p>'); 
                    ?>
                </div> -->

            <!-- <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" value="<?php //echo !empty($custData['address'])?$custData['address']:''; 
                                                                                    ?>" placeholder="Enter address" required>
                    <?php //echo form_error('address','<p class="help-block error">','</p>'); 
                    ?>
                </div> -->
            <input class="btn btn-success btn-lg btn-block" type="submit" name="placeOrder" value="Guardar Pedido">
            </form>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>

<script>
    //let visa = document.querySelector('#option1').value
    //let paypal = document.querySelector('#option2').value
    //let efectivo = document.querySelector('#option3').value
    //let id = 1;

    let totalCuenta = $('#totalAntesde').val();

    $('#cupon').keyup(function () {

        let valorTotalCuenta = parseFloat(totalCuenta);
        let descuento = 0;

        $('#cupon').each(function () {

          if ($(this).val() > 0) {
            descuento += parseFloat($(this).val());
          }

        });

        let $resultado = valorTotalCuenta - descuento
            
        $('#totalAntesde').val($resultado.toFixed(2));
              
    })

    

    $('#costo_de_envio').keyup(function(){

        let totalCuenta2 = $('#totalAntesde').val()
        let iniciador = parseFloat(totalCuenta2)
        let suma = 0

        $('#costo_de_envio').each(function(){

            if($(this).val() > 0){

                suma += parseFloat($(this).val()) 
            } 
        })

        let result = iniciador + suma

        $('#totalAntesde').val(result.toFixed(2))

        console.log($(this).val())
        console.log($(iniciador))
        console.log(result)

    })

    function getComision(id) {

        $.ajax({

            url: "<?php echo base_url() ?>checkout/getValueMetodoDePago/",
            type: "GET",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {

                let visa = data.id == 1;
                let paypal = data.id == 2;

                //alert(data.comision)
                $('#metodo').val(data['comision']);
                $('#antesComision').show();
                let metodo = $('#metodo').val();

                let totalAntesDe = $('#totalAntesde').val();

                comision = totalAntesDe * (metodo / 100);
                granTotal = totalAntesDe - comision;

                $('#totalAntesde').val(granTotal.toFixed(2));
            }
        });
    }

    function resetComision() {
        console.log('hola reset!')
        return location.reload();
    }

    /*
    function getCuponDescuento(){

        let cuponId = $('#cupon').val();
        
        if(cuponId != ''){
            $.ajax({

            url: "<?//= base_url()?>checkout/getValueCuponesDeDescuento/"+cuponId,
            type: "POST",
            data: {
                cuponId:cuponId
            },
            dataType: 'json',
            success: function(data){


                //alert(data.descuento)
                let valorCupon = $('#valor_cupon').val(data['descuento'])
                valorCupon = $(valorCupon).val()
                let metodoDePago = $('#metodo').val()
                let totalPedido = $('#totalAntesde').val()

                let descuento = totalPedido * (valorCupon/100);
                let descuentoMetodoDePago = totalPedido * (metodoDePago/100)
                let sumaDeDescuentos = descuento + descuentoMetodoDePago;

                console.log('Descuento gral: ' + descuento)
                console.log('Descuento tarjeta: ' + descuentoMetodoDePago)
                console.log(sumaDeDescuentos)
                let granTotal = totalPedido - sumaDeDescuentos
                $('#totalAntesde').val(granTotal)

                
                //Preguntar a Pablo si primero entra el descuento de comision(paypal o visa) 
                //o el cupon de descuento
                
            }
        })
    }
}*/

    /*$('#cupon').on('keyup change', function(){

        console.log($(this).val())
        console.log($('#totalAntesde').val())

        let cupon = parseFloat($(this).val())
        let totalCuenta = parseFloat($('#totalAntesde').val())

        let descuento = totalCuenta - cupon

        console.log($(descuento))


        if(!isNaN(descuento)){

            $('#totalAntesde').val(parseFloat(descuento.toFixed(2)))
        }

    })*/

</script>