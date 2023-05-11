      <!-- DataTables -->
      <link rel="stylesheet" href="<?= base_url() ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">


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
                <table id="example1" class="table table-striped">
                  <thead>
                    <tr>
                      <th>Imagen</th>
                      <th>Producto</th>
                      <th>SKU</th>
                      <th>Costo</th>
                      <th>Precio</th>
                      <!-- <th>Descuento</th> -->
                      <th>Opciones</th>
                      <!-- <th>Opciones</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($productos as $producto) : ?>
                      <tr>
                        <td><img height="80px" src="../public/uploads/imagenes_productos/<?= $producto['imagen']; ?>" alt="product_image" /></td>
                        <td><?= $producto['nombre']; ?>
                          <div class="card-body" style="width:30px; height:15px;">
                            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch>
                          </div>
                        </td>
                        <td><?= $producto['codigo']; ?></td>
                        <td><?= $producto['costo']; ?></td>
                        <td><?= $producto['precio']; ?></td>
                        <!-- <td><input type="number" id="desc" class="form-control w-50 text-center" onchange="getValues(this, '<?//= $producto['id'] ?>')" value="<?//= $producto['descuento']; ?>"></td> -->
                        <td><a href="<?php echo base_url('products/addToCart/' . $producto['id']); ?>">Añadir</a> | <a href="<?php echo base_url('productos/edit/' . $producto['id']); ?>">Editar</a></td>
                        <!-- <td>Editar | Ver</td> -->
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Imagen</th>
                      <th>Producto</th>
                      <th>SKU</th>
                      <th>Costo</th>
                      <th>Precio</th>
                      <!-- <th>Descuento</th> -->
                      <th>Opciones</th>
                      <!-- <th>Opciones</th> -->
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

      <!-- AdminLTE for demo purposes -->
      <script src="<?= base_url() ?>dist/js/demo.js"></script>

      <script>
        //switch on - off
        $("input[data-bootstrap-switch]").each(function() {
          $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $("#example1").DataTable();

        let porcentaje = $('#desc').val();

        function getValues(obj, id){
          
          $.ajax({
            url: "<?= base_url()?>productos/getDescuento/",
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
      </script>
