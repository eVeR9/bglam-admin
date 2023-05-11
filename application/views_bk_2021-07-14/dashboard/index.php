      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">

              <div class="card">
                <div class="card-header" style="background-color:#39cccc; color:#fff;">
                  <h3 class="card-title">
                    <i class="fas fa-text-width"></i>
                    Utilidad Total
                  </h3>
                </div>
                <!-- /.card-header -->
                <?php //echo $analytics_today['Utilidad'] ?>

                <div class="card-body clearfix">
                  <blockquote class="quote-teal">
                      <small>Hoy:</small>
                      <p class="display-4">$<?= $analytics_today['Utilidad'] ?> MXN</p>
                      <small>Ayer:</small>
                      <p class="display-4"><?= '$' . $analytics_today['utilidadAyer'] . ' MXN' ?></p>

                    <small class="h5">
                    <?php 
                    /* Fix the division by zero bug
                      $valor_final = $analytics_today['Utilidad'];
                      $valor_incial = $analytics_today['utilidadAyer'];

                      if($valor_incial === 0){

                        $valor_incial = NAN;

                      } else{

                          //$valor_incial = NAN;

                          $operacion = ($valor_final - $valor_incial)/$valor_incial;

                          $porcentaje = $operacion*100;

                          echo round($porcentaje, 0) . " %";
                      }
                      */
                    ?> 
                    <cite title="Source Title"></cite>
                    </small>
                    <button type="button" style="display:none;" class="btn btn-secondary" id="hiddenButton" data-toggle="modal" data-target="#modal-secondary">Ayer</button>
                    <button type="button" style="display:none;" class="btn btn-secondary" id="hiddenButton2" data-toggle="modal" data-target="#modal-thisWeek">Esta Semana</button>
                    <button type="button" style="display:none;" class="btn btn-secondary" id="hiddenButton3" data-toggle="modal" data-target="#modal-lastWeek">Semana Pasada</button>
                    <button type="button" style="display:none;" class="btn btn-secondary" id="hiddenButton4" data-toggle="modal" data-target="#modal-lastTwoWeeks">Ultimas 2 Semanas</button>
                    
                    <div class="container text-right" style="display:none;">
                      <div class="btn-group">
                        <button type="button" class="btn btn-default">Comparativo</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                          <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" id="ayer" href="#">Ayer</a>
                            <a class="dropdown-item" id="esta_semana" href="">Esta Semana</a>
                            <a class="dropdown-item" id="semana_pasada" href="">Semana Pasada</a>
                            <a class="dropdown-item" id="ultimos15Dias" href="#">Ultimos 15 dias</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Por Rango</a>
                          </div>
                        </button>
                      </div>
                  </blockquote>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div> <!-- /. col-lg-6 -->

            <div class="col-lg-6">
              <div class="card">
                <div class="card-header" style="background-color:#39cccc; color:#fff;">
                  <h3 class="card-title">
                    <i class="fas fa-text-width"></i>
                    Venta
                  </h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body clearfix">
                  <blockquote class="quote-teal">
                      <small>Hoy:</small>
                      <p class="display-4">$<?= $analytics_today['total_ventas_hoy'] ?> MXN</p>
                      <small>Ayer:</small>
                      <p class="display-4">$<?= $analytics_today['total_ventas_ayer']?> MXN</p>
                      <small class="h5">
                      <?php /*
                        $venta_inicial = $analytics_today['total_ventas_ayer'];
                        $venta_final = $analytics_today['total_ventas_hoy'];

                        $total = ($venta_final - $venta_inicial) / $venta_inicial;
                        $total_porcentaje = $total*100;

                        echo round($total_porcentaje, 0) . " %";
                        */
                        //BUSCAR SOLUCION A DIVISION BY ZERO
                      ?>
                      
                      <cite title="Source Title"></cite>
                      </small><br>
                      <small class="h5 text-muted"><cite title="Source Title"><?= $analytics_today['total_pedidos'] ?> Pedidos</cite></small>
                  </blockquote>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->

          <div class="row">
            <div class="col-lg-10">
              <?php foreach ($pedidos as $pedido) : ?>
                <div class="card">
                  <div class="card-header" style="background-color:#343a40; color:#fff;">
                    <h3 class="card-title">
                      <i class="fas fa-text-width"></i>
                      Pedido #<?= $pedido['id'] ?>
                    </h3>
                  </div>
                  <!-- /.card-header -->

                  <div class="card-body clearfix">
                    <div class="row">
                      <div class="col-lg-6">
                        <blockquote class="quote-gray-dark">
                          <p>Cliente: <?= $pedido['cliente_id'] ?></p>
                          <ul>
                            <li><?= $pedido['producto_id'] ?></li>
                          </ul>
                          <small>Codigo: <cite title="Source Title">MKJ90129CY</cite></small>
                        </blockquote>
                      </div>
                      <div class="col-lg-6">
                        <div style="margin-top:32px;"></div>
                        <p>Venta <span>$<?= $pedido['total_pedido'] ?></span></p>
                        <p></p>
                        <small>Estatus: <cite title="Source Title">Ok</cite></small>
                        <div style="margin-top:102px;"></div>
                        <p style="margin-left:135px;"><a href="#">Ver a detalle</a></p>

                      </div>
                    </div> <!-- /. row -->
                  </div>
                  <!-- /.card-body -->
                </div>
              <?php endforeach; ?>
              <!-- /.card -->

            </div>
            <!-- /.col-lg-6 -->

            <div class="modal fade" id="modal-secondary">
              <div class="modal-dialog">
                <div class="modal-content bg-secondary">
                  <div class="modal-header">
                    <h4 class="modal-title">Tu utilidad del dia de ayer fue de:</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <p class="display-4" style="color:#39cccc;"><?= '$' . $utilidad_ayer['utilidadAyer'] . ' MXN' ?></p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-outline-light">Save changes</button>-->
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="modal-thisWeek">
              <div class="modal-dialog">
                <div class="modal-content bg-secondary">
                  <div class="modal-header">
                    <h4 class="modal-title">Tu utilidad de esta semana fue de:</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="display-4" style="color:#39cccc;"><?= $utilidad_this_week['thisWeek']; ?></p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="modal-lastWeek">
              <div class="modal-dialog">
                <div class="modal-content bg-secondary">
                  <div class="modal-header">
                    <h4 class="modal-title">Tu utilidad de la semana pasada fue de:</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="display-4" style="color:#39cccc;"><?= $utilidad_last_week['lastWeek'] ?></p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="modal-lastTwoWeeks">
              <div class="modal-dialog">
                <div class="modal-content bg-secondary">
                  <div class="modal-header">
                    <h4 class="modal-title">Tu utilidad de los ultimos 15 dias fue de:</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="display-4" style="color:#39cccc;"><?= $utilidad_this_last_two_weeks['lastTwoWeeks'] ?></p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->


      <!--
      evento de js, donde si das click en un enlace del dropdown id='ayer', hace 7 dias o un mes dispare
      el boton que le indica a la modal salir.
     -->

      <!-- jQuery -->
      <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>

      <script>
        $(document).ready(function() {

          let ayer = document.querySelector('#ayer');
          let thisWeek = document.querySelector('#esta_semana');
          let lastWeek = document.querySelector('#semana_pasada');
          let thisLastTwoWeeks = document.querySelector('#ultimos15Dias');

          $(ayer).on('click', function() {
            console.log('Yes!! We did it!!')
            return $('#hiddenButton').click();
          });

          $(thisWeek).on('click', function() {
            return $('#hiddenButton2').click();
          });

          $(lastWeek).on('click', function(){
            return $('#hiddenButton3').click();
          });

          $(thisLastTwoWeeks).on('click', function(){
            return $('#hiddenButton4').click();
          });

        });
      </script>