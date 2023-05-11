      <!-- DataTables -->
      <link rel="stylesheet" href="<?= base_url() ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">

      <style>
          .yellow{
            /*background-color: #FDD835;*/
            background-color: #FDEDB2;
            color: gray;
          }

          .red{
            /*background-color: #EC7063;*/
            background-color:  #B9A1EB;
            background-color: #ff6961;
            color: #fff;
          }

          .blue{
            /*background-color: #85C1E9;*/
            background-color: #CDE5C1;
            background-color: #BBDAFF;
            background-color: #85C1E9;
            color: #fff;

          }


      </style>

      <section class="content" style="margin-top: -10px;">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <h1 class="mt-2">Inventario <a href="<?php echo base_url('inventario/add')?>">+</a></h1>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped" id="example1">
                                  <thead>
                                      <tr>
                                        <th>Imagen</th>
                                        <th>Marca</th>
                                        <th>Producto</th>
                                        <th>Almacen</th>
                                        <th>Unidades</th>
                                        <th>Costo Total</th>
                                        <th>Opciones</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($inventario as $inv) : 
                                        ?>
                                      <tr>
                                          <?php $imagen = !empty($inv['imagen']) ? base_url('public/uploads/imagenes_productos/' .$inv['imagen']) : base_url('public/uploads/imagenes_productos/sin_imagen/woodbridge.jpeg') ?>                       
                                          <td><img src="<?= $imagen?>" alt="imagen producto" width="35"></td>
                                          <td>Generica</td>
                                          <td>
                                              <?= $inv['producto_id'] ?>
                                          </td>
                                          <td>
                                              <?= $inv['almacen'] ?>
                                          </td>
                                          <td>
                                              <?= $inv['inventario'] ?>
                                          </td>
                                          <td><?= $inv['costo_total']?></td>
                                          <td><a href="#">Ver</a></td>
                                      </tr>
                                      <?php endforeach ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- col-12 -->
          </div>
          <!-- row -->
      </section>

      <!-- jQuery -->
      <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>

      <!-- Bootstrap 4 -->
      <script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- DataTables -->
      <script src="<?php echo base_url() ?>plugins/datatables/jquery.dataTables.js"></script>
      <script src="<?php echo base_url() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

      <script>

        $("#example1").DataTable({
            aaSorting: [[0, 'desc']],
            rowCallback: function(row, data){

                let existencia = data[4]

                if(existencia <= 5){

                    $('td', row).addClass('red');
                    //$(row).addClass('yellow')

                } else if(existencia <= 10){

                    $('td', row).addClass('yellow');

                } else if(existencia > 10){

                    $('td', row).addClass('blue');
                } else { console.log('Algo anda mal')}
                
            }
          });

      </script>