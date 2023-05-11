      <!-- DataTables -->
      <link rel="stylesheet" href="<?= base_url() ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">

      <section class="content" style="margin-top: -10px;">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <h1 class="mt-2">Gastos <a href="<?php echo base_url('gastos/add')?>">+</a></h1>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped" id="example1">
                                  <thead>
                                      <tr>
                                        <th>Fecha</th>
                                        <th>Motivo</th>
                                        <th>Monto</th>
                                        <th>Forma de Pago</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach($gastos_list as $gl): ?>
                                    <tr>
                                        <td><?= $gl['fecha']?></td>
                                        <td><?= $gl['motivo']?></td>
                                        <td><?= $gl['monto']?></td>
                                        <td><?= $gl['forma_de_pago']?></td>
                                    </tr>
                                    <?php endforeach; ?>
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
            aaSorting: [[0, 'desc']]
          });

      </script>