  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <!-- Default box -->
                  <div class="card">

                      <div class="card-header bg-primary">
                          <div class="row">
                              <div class="col-md-11">
                                  <h3 class="card-title">Editar Pedidos</h3>
                              </div>
                              <div class="col-md-1">
                                  <button type="button" style="color:#fff; padding:0;" class="btn" data-toggle="modal" data-target="#modal-default">+</button>
                              </div>
                          </div>
                      </div>

                      <div class="card-body row">
                          <div class="col-md-6">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>ID</th>
                                          <th>Producto</th>
                                          <th>Unidades</th>
                                          <th>Precio</th>
                                          <th>Opcion</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($pedidos_detalle as $index => $pD) { ?>
                                          <tr>
                                              <td><?php echo $index + 1 ?></td>
                                              <td><?php echo $pD['nombre'] ?></td>
                                              <td class="unities" id="unidades"><?php echo $pD['unidades'] ?></td>
                                              <td><?php echo $pD['precio_producto'] ?></td>
                                              <div class="buttons">
                                                  <td><button id="delete" class="btn btn-sm btn-danger btn-delete" value="<?php echo $pD['lineaPedido'] ?>">Eliminar</button></td>
                                                    <!-- <td><button class="choose" id="eleccion">Elegir</button></td> -->
                                                  <!--<td><a href="<?//= base_url('pedidos/delete/' . $pD['lineaPedido']) ?>" id="delete" class="btn btn-sm btn-danger" style="color:#fff;">Eliminar</a></td>-->
                                              </div>
                                          </tr>
                                      <?php } ?>
                                  </tbody>
                              </table>
                              <hr>
                              <div class="">
                                  <label for="">Total:</label>
                                  <input type="text" style="background:transparent; border:none; outline:none;" value="<?= '$' . $cliente_detalle['total'] . ' MXN' ?>" readonly>
                              </div>
                          </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="inputName">Nombre</label>
                                  <input type="text" id="inputName" class="form-control" value="<?= $cliente_detalle['nombre'] ?>" />
                              </div>
                              <div class="form-group">
                                  <label for="inputEmail">Telefono</label>
                                  <input type="email" id="inputEmail" class="form-control" value="<?= $cliente_detalle['telefono'] ?>" />
                              </div>
                              <!-- 
                              <div class="form-group">
                                  <label for="">Costo de envio</label>
                                  <input type="text" id="1" class="form-control" value="" />
                              </div>
                              <div class="form-group">
                                  <label for="">Metodo de Pago</label>
                                  <input type="text" class="form-control" value="<?= $pedidos_detalle[0]['metodo_de_pago']?>">
                              </div>
                              -->
                              <div class="form-group">
                                  <label for="">Fecha del Pedido</label>
                                  <input type="text" id="3" class="form-control" value="<?= $cliente_detalle['created_at'] ?>" readonly />
                              </div>
                              <!--
                            <div class="form-group">
                                <label for="inputMessage">Message</label>
                                <textarea id="inputMessage" class="form-control" rows="4"></textarea>
                            </div>
                            -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header bg-primary">
                      <h4 class="modal-title">Agrega un nuevo producto</h4>
                      <button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <!-- form start -->
                      <!-- <form action="<?//= base_url("pedidos/addNewProductFromEditForm/") ?>" method="POST">-->
                      <?php echo form_open(base_url("pedidos/addNewProductFromEditForm/")) ?>
                      <div class="card-body">
                          <input type="hidden" name="pedido_id" value="<?= $pedidos_detalle[0]['id'] ?>">
                          <div class="form-group">
                              <label for="">Producto</label>
                              <select class="form-control" name="producto_id" id="producto_id">
                                  <option value="">Selecciona un producto</option>
                                  <?php foreach ($productos as $producto) : ?>
                                      <option value="<?= $producto['productoId'] ?>"><?= $producto['productoNombre'] ?></option>
                                  <?php endforeach; ?>
                              </select>
                              <input type="hidden" name="id_del_producto" id="id_del_producto">
                          </div>
                          <div class="form-group">
                              <label for="">Precio</label>
                              <input type="text" class="form-control" name="" id="precio_producto" placeholder="">
                          </div>
                          <div class="form-group">
                              <label for="">Unidades</label>
                              <input type="text" class="form-control" name="unidades" id="unidades" placeholder="">
                          </div>
                          <div class="form-group">
                              <label for="">Total</label>
                              <input type="text" class="form-control" name="precio_producto" id="total" placeholder="">
                          </div>
                      </div>
                      <!-- /.card-body -->
                      <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                      <input type="submit" name="submit" value="Guardar" class="btn btn-primary">
                      <!-- </form> -->
                      <?php echo form_close() ?>
                  </div>
                  <!--
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button> 
                      <button type="button" class="btn btn-primary">Guardar</button>
                  </div>
                  -->
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  </section>
  <!-- /.content -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="<?= base_url() ?>plugins/sweetalert2/sweetalert2.min.js"></script>

  <script>
      $(document).ready(function() {

          let id = document.querySelector('#delete');
          
          let eleccion = document.querySelector('#eleccion');

          $('.choose').on('click', eleccion, function(){

            eleccion = $(this).val()
            console.log($('#unidades').html())
          })

          $('.btn-delete').on('click', id, function() {

              id = $(this).val()
              console.log(id)
            
              $.ajax({

                  url: '<?= base_url() ?>pedidos/delete/' + id,
                  //type: 'POST',
                  data: {
                      id: id
                  },
                  //dataType: '',
                  error: function() {

                      alert('La operacion no se concreto')
                  },
                  success: function(data) {

                      //alert('Se ha eliminado el registro')
                      location.reload()
                  }
              })

          })


          $('#modal-default').on('keyup', function() {

              let precio_producto = parseFloat($('#precio_producto').val())
              let unidades = parseFloat($('#unidades').val())
              let total = $('#total')
              let ventaTotal = precio_producto * unidades

              /*if(!isNaN(ventaTotal)){

                $(total).val(parseFloat(ventaTotal.toFixed(2)))
              }*/

              $(total).val(parseFloat(ventaTotal.toFixed(2)))
              console.log($('#total').val())

          })

          $('#producto_id').on('change', function() {

              let productoId = $('#producto_id').val()

              $.ajax({
                  url: '<?= base_url() ?>pedidos/getInfoPedidoForAddProduct/' + productoId,
                  type: 'POST',
                  data: {
                      id: productoId
                  },
                  dataType: 'json',
                  error: function() {

                      alert('Los datos no llegaron')

                  },
                  success: function(data) {

                      //alert(data['precio'])
                      $('#precio_producto').attr('readonly', 'true')
                      $('#precio_producto').val(data['precio'])
                      $('#id_del_producto').val(data['id'])
                  }
              })

          })

      })
  </script>