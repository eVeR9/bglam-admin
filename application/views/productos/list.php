      <!-- DataTables -->
      <link rel="stylesheet" href="<?= base_url() ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
      <!-- Booststrap toggle -->
      <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

      <style>
        .toggle.ios,
        .toggle-on.ios,
        .toggle-off.ios {
          border-radius: 20px;
        }

        .toggle.ios .toggle-handle {
          border-radius: 20px;
        }

        /* The switch - the box around the slider */
        .switch {
          position: relative;
          display: inline-block;
          width: 60px;
          height: 34px;
          margin-top: 1rem;
          float: left;
        }

        /* Hide default HTML checkbox */
        .switch input {
          display: none;
        }

        /* The slider */
        .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }

        .slider:before {
          position: absolute;
          content: "";
          height: 26px;
          width: 26px;
          left: 4px;
          bottom: 4px;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
        }

        input.default:checked+.slider {
          background-color: #444;
        }

        input.primary:checked+.slider {
          background-color: #2196F3;
        }

        input.success:checked+.slider {
          background-color: #8bc34a;
        }

        input.info:checked+.slider {
          background-color: #3de0f5;
        }

        input.warning:checked+.slider {
          background-color: #FFC107;
        }

        input.danger:checked+.slider {
          background-color: #f44336;
        }

        input:focus+.slider {
          box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
          -webkit-transform: translateX(26px);
          -ms-transform: translateX(26px);
          transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
          border-radius: 34px;
        }

        .slider.round:before {
          border-radius: 50%;
        }
      </style>



      <!-- Main content -->
      <section class="content" style="margin-top: -10px;">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Continuar Pedido
                  <div class="cart-view">
                    <a href="<?php echo base_url('cart'); ?>" title="View Cart"><i class="fas fa-shopping-cart"></i>
                      (<?php echo ($this->cart->total_items() > 0) ? $this->cart->total_items() . ' Items' : 'Vacio'; ?>)
                    </a>
                  </div>
                </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <table id="example1" class="table table-striped tcontain">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Imagen</th>
                      <th>Producto</th>
                      <th>Stock</th>
                      <!--<th>Costo</th>-->
                      <th>Precio</th>
                      <!-- <th>Descuento</th> -->
                      <!-- <th>Estatus</th> -->
                      <th>Opciones</th>
                      <!-- <th>Disponibilidad</th> -->
                      <!-- <th>Opciones</th> -->
                      <!-- <th>Switch</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($productos as $producto) : ?>
                      <tr>
                        <td class="productID"><?= $producto['id'] ?></td>
                        <td><img height="80px" src="../public/uploads/imagenes_productos/<?= $producto['imagen']; ?>" alt="product_image" /></td>
                        <td><?= $producto['nombre']; ?> <br>
                          <?php if ($producto['estatus_id'] == 1) : ?>
                            <!-- <input type="checkbox" name="new-checkbox" id="newswitch" class="newswitch" value="<?= $producto['id'] ?>" data-toggle="toggle" data-size="mini" data-onstyle="success" checked> -->

                            <label class="switch ">
                              <input type="checkbox" class="primary newswitch" value="<?= $producto['id'] ?>" checked>
                              <span class="slider round"></span>
                            </label>

                          <?php elseif ($producto['estatus_id'] == 0) : ?>
                            <!-- <input type="checkbox" name="new-checkbox" id="newswitch" class="newswitch" value="<?= $producto['id'] ?>" data-toggle="toggle" data-size="mini" data-onstyle="success"> -->
                            <label class="switch ">
                              <input type="checkbox" class="primary newswitch" value="<?= $producto['id'] ?>">
                              <span class="slider round"></span>
                            </label>
                          <?php endif; ?>
                        </td>
                        <td><?= $producto['inventario']; ?></td>
                        <!--<td><? //= $producto['costo']; 
                                ?></td>-->
                        <td><?= $producto['precio']; ?></td>
                        <!-- <td><? //= $producto['estatus_id']; 
                                  ?></td>-->
                        <!-- <td><input type="number" id="desc" class="form-control w-50 text-center" onchange="getValues(this, '<? //= $producto['id'] 
                                                                                                                                  ?>')" value="<? //= $producto['descuento']; 
                                                                                                                                                                    ?>"></td> -->
                        <td><a href="<?php echo base_url('products/addToCart/' . $producto['id']); ?>" class="add">Añadir</a> | <a href="<?php echo base_url('productos/edit/' . $producto['id']); ?>">Editar</a></td>
                        <!--
                        <td class="text-center">
                        <?php //if($producto['estatus_id'] == 1):
                        ?>
                          <input type="checkbox" name="new-checkbox" id="newswitch" class="newswitch" value="<? //= $producto['id']
                                                                                                              ?>" data-toggle="toggle" data-size="mini" data-onstyle="success" checked>
                        <?php //elseif($producto['estatus_id'] == 0):
                        ?>
                            <input type="checkbox" name="new-checkbox" id="newswitch" class="newswitch" value="<? //= $producto['id']
                                                                                                                ?>" data-toggle="toggle" data-size="mini" data-onstyle="success">
                        <?php //endif;
                        ?>
                        </td>
                        -->
                        <!-- 
                        <td>
                         <input type="checkbox" class="my-checkbox" id="bootstrapSwitch" name="my-checkbox" value="<?= $producto['id'] ?>" checked data-bootstrap-switch data-on-text="on" data-off-text="off"> 
                        </td>
                        -->
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Imagen</th>
                      <th>Producto</th>
                      <th>Stock</th>
                      <!-- <th>Costo</th> -->
                      <th>Precio</th>
                      <!-- <th>Descuento</th> -->
                      <!--<th>Estatus</th>-->
                      <th>Opciones</th>
                      <!--<th>Activar / Inactivar</th> -->
                      <!-- <th>Switch</th> -->
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->



      <!-- jQuery -->
      <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>

      <!-- Bootstrap 4 -->
      <script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- AdminLTE App -->
      <script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>

      <!-- DataTables -->
      <script src="<?php echo base_url() ?>plugins/datatables/jquery.dataTables.js"></script>
      <script src="<?php echo base_url() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

      <!-- Bootstrap Switch -->
      <script src="<?= base_url() ?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

      <!-- Booststrap toggle -->
      <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

      <!-- AdminLTE for demo purposes -->
      <script src="<?= base_url() ?>dist/js/demo.js"></script>

      <!-- FLOT CHARTS -->
      <script src="<?php echo base_url() ?>plugins/flot/jquery.flot.js"></script>

      <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
      <script src="<?php echo base_url() ?>plugins/flot-old/jquery.flot.resize.min.js"></script>
      
      <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
      <script src="<?php echo base_url() ?>plugins/flot-old/jquery.flot.pie.min.js"></script>



      <script>
        //switch on - off

        /*$('.my-checkbox').bootstrapSwitch('size', 'mini', function(){

          console.log($(this).prop('checked') == true ? 1 : 0)

        })*/

        /*
                let porcentaje = $('#desc').val();

                function getValues(obj, id){
                  
                  $.ajax({
                    url: "<? //= base_url()
                          ?>productos/getDescuento/",
                    type: "GET",
                    data: {
                      descuento:obj.value,
                      id:id
                    },
                    success: function(data){
                      alert(data)
                    }

                  });
                }
        */

        //Hacer que los checkbox se vean iguales en toda la paginacion!!!

        //$('.newswitch').each( function() {

        $('#example1 tbody .newswitch').on('change', function() {

          let productID = $(this).val()
          let switchVal = $(this).prop('checked')

          //if(switchVal)
          //console.log($(this).val())

          //else if(!switchVal)
          //console.log('off')

          $.ajax({
            url: '<?= base_url() ?>productos/changeEstatusController/' + productID,
            type: 'GET',
            data: {
              id: productID,
              switchVal: switchVal
            },
            //dataType: 'json',
            error: function() {

              alert('Algo salio mal')
            },
            success: function(data) {

              //alert(data)
              location.reload()
            }

          })
        })

        //});

        /*$('.add').on('click', function() {

          let id = $(this).val()

        $.ajax({

          url: '<?= base_url() ?>product/stockValidation/'+id,
          type: 'GET',
          //data: {},
          //dataType: 'json',
          error: function() {

              alert('Algo salio mal')
          },
          success: function(data){

            alert(data['total_inventario_por_id'])
          }

        })

        })*/

        $("#example1").DataTable()
      </script>