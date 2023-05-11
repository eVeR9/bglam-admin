  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-1"></div>
              <div class="col-sm-6">
                  <h1>Entrada de Gastos</h1>
                  <a href="<?php echo base_url('gastos/') ?>">Regresar</a>
              </div>
              <!--
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Boxed Layout</li>
            </ol>
          </div>
          -->
          </div>
      </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-1"></div>
              <div class="col-10">
                  <!-- Default box -->
                  <div class="card">
                      <div class="card-header bg-primary">
                          <h3 class="card-title">Agrega un Gasto</h3>
                      </div>

                      <div class="card-body">
                          <!-- Horizontal Form -->
                          <div class="card card-info">
                              <!-- 
              <div class="card-header">
                <h3 class="card-title">Horizontal Form</h3>
              </div>
              -->
                              <!-- /.card-header -->
                              <!-- form start -->
                              <div>
                                  <!-- <form class="form-horizontal"> -->
                                  <?php echo form_open(base_url('gastos/add')) ?>
                                  <div class="card-body">

                                  <div class="form-group row">
                                          <label for="producto_id" class="col-sm-2 col-form-label">Fecha</label>
                                          <div class="col-sm-6">
                                                <input type="text" name="fecha" id="fecha" value="<?= date('Y-m-d')?>" class="form-control" readonly>
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="producto_id" class="col-sm-2 col-form-label">Motivo</label>
                                          <div class="col-sm-6">
                                                <textarea name="motivo" id="motivo" class="form-control" style="resize:none; height:5rem;"></textarea>
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="almacen_id" class="col-sm-2 col-form-label">Monto</label>
                                          <div class="col-sm-6">
                                              <input type="number" min="0" step="any" name="monto" id="monto" class="form-control" value="" placeholder="">
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="unidades" class="col-sm-2 col-form-label">Forma de Pago</label>
                                          <div class="col-sm-6">
                                              <select name="forma_de_pago" id="forma_de_pago" class="form-control" required>
                                                <option value="0">Seleccione metodo de pago</option>
                                                <?php foreach($metodos_de_pago  as $mdp):?>
                                                    <option value="<?= $mdp['id']?>"><?= $mdp['metodo']?></option>
                                                <?php endforeach; ?>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <div class="col-sm-2"></div>
                                          <div class="col-sm-6">
                                              <input type="submit" name="action" class="btn btn-success" value="Guardar">
                                          </div>
                                      </div>
                                      <!--
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Remember me</label>
                      </div>
                    </div>
                  </div>
                  -->
                                  </div>
                                  <!-- /.card-body -->
                                  <!-- 
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Sign in</button>
                  <button type="submit" class="btn btn-default float-right">Cancel</button>
                </div>
                -->
                                  <!-- /.card-footer -->
                                  <?php echo form_close() ?>
                                  <!-- </form> -->
                              </div>
                              <!-- /.card -->
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
              </div>
          </div>
  </section>
  <!-- /.content -->


  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>


  <!-- Select2 -->
  <script src="../plugins/select2/js/select2.full.min.js"></script>



  <script>
      $('.select2').select2()
  </script>