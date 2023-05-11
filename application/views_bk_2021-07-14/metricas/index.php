<!-- 
    ***Validar priemero lo que tengo en produccion antes de subir cualquier cambio*** check
    Jugar con el metodo hide de jQuery para ocultar los querys que no correspondan a lo seleccionado
     en la tab 
-->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <div class="container mb-3 text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">Comparativo</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" id="ayer" href="#">Ayer</a>
                                <a class="dropdown-item" id="esta_semana_boton" href="">Esta Semana</a>
                                <a class="dropdown-item" id="ultimos15Dias_boton" href="#">Ultimos 15 dias</a>
                                <a class="dropdown-item" id="mes_boton" href="">Mes</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="location.reload();">Hoy (Refresh)</a>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
                <div class="card" id="card_utilidad">
                    <div class="card-header" style="background-color:#39cccc; color:#fff;">
                        <h3 class="card-title">
                            <i class="fas fa-text-width"></i>
                            Utilidad Total
                        </h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body clearfix" id="hoy_ayer_utilidad">
                        <small>Hoy:</small>
                        <p class="display-4">
                            <?= '$' . $analytics_today['Utilidad'] ?>
                        </p>
                        <small>Ayer:</small>
                        <p class="display-4">
                            <?= '$' . $analytics_today['utilidadAyer'] ?>
                        </p>

                        <blockquote class="quote-teal" style="display:none;">
                            <small>Hoy:</small>
                            <p class="display-4">$
                                <? //= $utilidad_total['Utilidad'] 
                                ?> MXN
                            </p>
                            <small>Ayer:</small>
                            <p class="display-4">
                                <? //= '$' . $utilidad_ayer['utilidadAyer'] . ' MXN' 
                                ?>
                            </p>

                            <small class="h5">
                                <?php
                                /*
                      $valor_final = $utilidad_total['Utilidad'];
                      $valor_incial = $utilidad_ayer['utilidadAyer'];
                      $operacion = ($valor_final - $valor_incial)/$valor_incial;
                      $porcentaje = $operacion*100;

                      echo round($porcentaje, 0) . " %";
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
            </div>

            <div class="col-lg-1"></div>

            <div class="col-lg-4">
                <div class="card" id="card_ventas">
                    <div class="card-header" style="background-color:#39cccc; color:#fff;">
                        <h3 class="card-title">
                            <i class="fas fa-text-width"></i>
                            Venta Total
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <?php //echo $utilidad_fecha['Utilidad'] 
                    ?>

                    <div class="card-body clearfix" id="hoy_ayer_ventas">
                        <small>Hoy:</small>
                        <p class="display-4">
                            <?= '$' . $analytics_today['total_ventas_hoy'] ?>
                        </p>
                        <small>Ayer:</small>
                        <p class="display-4">
                            <?= '$' . $analytics_today['total_ventas_ayer'] ?>
                        </p>

                        <small class="h5">
                            <cite title="Source Title"></cite>
                        </small>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div class="col-lg-1"></div>

        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
                <div class="card" id="card_total_pedidos">
                    <div class="card-header" style="background-color:#39cccc; color:#fff;">
                        <h3 class="card-title">
                            <i class="fas fa-text-width"></i>
                            Cantidad de Pedidos
                        </h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body clearfix" id="hoy_ayer_pedidos">
                        <small>Hoy:</small>
                        <p class="display-4 text-center">
                            <?= '#' . $analytics_today['total_pedidos'] ?>
                        </p>
                        <!--
                        <small>Ayer:</small>
                        <p class="display-4">
                            <? //= '$' . $utilidad_ayer['utilidadAyer'] . ' MXN' 
                            ?>
                        </p>
                        -->
                        <small class="h5">
                            <?php
                            /*
                      $valor_final = $utilidad_total['Utilidad'];
                      $valor_incial = $utilidad_ayer['utilidadAyer'];
                      $operacion = ($valor_final - $valor_incial)/$valor_incial;
                      $porcentaje = $operacion*100;

                      echo round($porcentaje, 0) . " %";
                        */
                            ?>
                            <cite title="Source Title"></cite>
                        </small>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-lg-1"></div>

            <div class="col-lg-4">
                <div class="card" id="card_ticket_promedio">
                    <div class="card-header" style="background-color:#39cccc; color:#fff;">
                        <h3 class="card-title">
                            <i class="fas fa-text-width"></i>
                            Ticket Promedio
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <?php //echo $utilidad_fecha['Utilidad'] 
                    ?>

                    <div class="card-body clearfix" id="hoy_ayer_ticket_promedio">
                        <small>Hoy:</small>
                        <p class="display-4 text-center">
                            <?= '$' . $analytics_today['ticket_promedio'] ?>
                        </p>
                        <!-- 
                        <small>Ayer:</small>
                        <p class="display-4">
                            <? //= '$' . $utilidad_ayer['utilidadAyer'] . ' MXN' 
                            ?>
                        </p>
                        -->
                        <small class="h5">
                            <?php
                            /*
                      $valor_final = $utilidad_total['Utilidad'];
                      $valor_incial = $utilidad_ayer['utilidadAyer'];
                      $operacion = ($valor_final - $valor_incial)/$valor_incial;
                      $porcentaje = $operacion*100;

                      echo round($porcentaje, 0) . " %";
                    */
                            ?>
                            <cite title="Source Title"></cite>
                        </small>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>

<script>
    let botonAyer = document.querySelector('#ayer');
    let botonEstaSemana = document.querySelector('#esta_semana_boton');

    let counterVentas = 0;
    let counterUtilidad = 0;
    let counterTotalPedidos = 0;
    let counterTicketPromedio = 0;

    let counterEstaSemanaUtilidad = 0;
    let counterEstaSemanaVentas = 0;
    let counterEstaSemanaTotalPedidos = 0;
    let counterEstaSemanaTicketPromedio = 0;

    let counterUltimos15DiasUtilidad = 0;
    let counterUltimos15DiasVentas = 0;
    let counterUltimos15DiasTotalPedidos = 0;
    let counterUltimos15DiasTicketPromedio = 0;

    let counterMesUtilidad = 0;
    let counterMesVentas = 0;
    let counterMesTotalPedidos = 0;
    let counterMesTicketPromedio = 0;

    $(botonAyer).on('click', function() {
        $.ajax({

            url: '<?= base_url() ?>metricas/getAnalyticsYesterdayController',
            type: 'POST',
            dataType: 'json',
            success: function(data) {

                console.log(data)

                let divAyerAntierUtilidad = document.createElement('div');
                divAyerAntierUtilidad.setAttribute('class', 'card-body clearfix');
                divAyerAntierUtilidad.setAttribute('id', 'hoy_antier_utilidad');

                let smallAyerAntierUtilidad = document.createElement('small');
                divAyerAntierUtilidad.appendChild(smallAyerAntierUtilidad);
                smallAyerAntierUtilidad.innerHTML = 'Ayer:';

                let pAyerAntierUtilidad = document.createElement('p');
                pAyerAntierUtilidad.setAttribute('class', 'display-4');
                pAyerAntierUtilidad.innerHTML = '$' + data['utilidad_ayer'];
                divAyerAntierUtilidad.appendChild(pAyerAntierUtilidad);

                let smallAyerAntierUtilidad2 = document.createElement('small');
                divAyerAntierUtilidad.appendChild(smallAyerAntierUtilidad2);
                smallAyerAntierUtilidad2.innerHTML = 'Antier:';

                let pAyerAntierUtilidad2 = document.createElement('p');
                pAyerAntierUtilidad2.setAttribute('class', 'display-4');
                pAyerAntierUtilidad2.innerHTML = '$' + data['utilidad_antier'];
                divAyerAntierUtilidad.appendChild(pAyerAntierUtilidad2);

                console.log(divAyerAntierUtilidad);

                $('#hoy_ayer_utilidad').hide();
                $('#esta_semana_utilidad').hide();
                $('#ultimos_15_dias_utilidad').hide();
                $('#mes_utilidad').hide();

                if (counterUtilidad <= 0) {
                    $('#card_utilidad').append(divAyerAntierUtilidad);
                    counterUtilidad++;
                }

                //let cardVentas = document.querySelector('#card_ventas');

                let divAyerAntierVentas = document.createElement('div');
                divAyerAntierVentas.setAttribute('class', 'card-body clearfix');
                divAyerAntierVentas.setAttribute('id', 'ayer_antier_ventas');

                let smallAyerAntierVentas = document.createElement('small');
                divAyerAntierVentas.appendChild(smallAyerAntierVentas);
                smallAyerAntierVentas.innerHTML = 'Ayer:';

                let pAyerAntierVentas = document.createElement('p');
                pAyerAntierVentas.setAttribute('class', 'display-4');
                pAyerAntierVentas.innerHTML = '$' + data['total_ventas_ayer'];
                divAyerAntierVentas.appendChild(pAyerAntierVentas);

                let smallAyerAntierVentas2 = document.createElement('small');
                divAyerAntierVentas.appendChild(smallAyerAntierVentas2);
                smallAyerAntierVentas2.innerHTML = 'Antier:';

                let pAyerAntierVentas2 = document.createElement('p');
                pAyerAntierVentas2.setAttribute('class', 'display-4');
                pAyerAntierVentas2.innerHTML = '$' + data['total_ventas_antier'];
                divAyerAntierVentas.appendChild(pAyerAntierVentas2);

                console.log(divAyerAntierVentas);

                $('#hoy_ayer_ventas').hide();
                $('#esta_semana_ventas').hide();
                $('#ultimos_15_dias_ventas').hide();
                $('#mes_ventas').hide();

                if (counterVentas <= 0) {
                    $('#card_ventas').append(divAyerAntierVentas);
                    counterVentas++;
                }

                let divAyerAntierTotalPedidos = document.createElement('div');
                divAyerAntierTotalPedidos.setAttribute('class', 'card-body clearfix');
                divAyerAntierTotalPedidos.setAttribute('id', 'ayer_antier_total_pedidos');

                let smallAyerAntierTotalPedidos = document.createElement('small');
                divAyerAntierTotalPedidos.appendChild(smallAyerAntierTotalPedidos);
                smallAyerAntierTotalPedidos.innerHTML = 'Ayer:';

                let pAyerAntierTotalPedidos = document.createElement('p');
                pAyerAntierTotalPedidos.setAttribute('class', 'display-4 text-center');
                pAyerAntierTotalPedidos.innerHTML = '#' + data['total_pedidos_ayer'];
                divAyerAntierTotalPedidos.appendChild(pAyerAntierTotalPedidos);

                console.log(divAyerAntierTotalPedidos);

                $('#hoy_ayer_pedidos').hide();
                $('#esta_semana_total_pedidos').hide();
                $('#semana_pasada_total_pedidos').hide();
                $('#mes_total_pedidos').hide();

                if (counterTotalPedidos <= 0) {
                    $('#card_total_pedidos').append(divAyerAntierTotalPedidos);
                    counterTotalPedidos++;
                }

                let divAyerAntierTicketPromedio = document.createElement('div');
                divAyerAntierTicketPromedio.setAttribute('class', 'card-body clearfix');
                divAyerAntierTicketPromedio.setAttribute('id', 'ayer_antier_ticket_promedio');

                let smallAyerAntierTicketPromedio = document.createElement('small');
                divAyerAntierTicketPromedio.appendChild(smallAyerAntierTicketPromedio);
                smallAyerAntierTicketPromedio.innerHTML = 'Ayer:';

                let pAyerAntierTicketPromedio = document.createElement('p');
                pAyerAntierTicketPromedio.setAttribute('class', 'display-4 text-center');
                pAyerAntierTicketPromedio.innerHTML = '$' + data['ticket_promedio_ayer'];
                divAyerAntierTicketPromedio.appendChild(pAyerAntierTicketPromedio);

                console.log(divAyerAntierTicketPromedio);

                $('#hoy_ayer_ticket_promedio').hide();
                $('#esta_semana_ticket_promedio').hide();
                $('#semana_pasada_ticket_promedio').hide();
                $('#mes_ticket_promedio').hide();

                if (counterTicketPromedio <= 0) {
                    $('#card_ticket_promedio').append(divAyerAntierTicketPromedio);
                    counterTicketPromedio++;
                }
            }
        })
    })

    $(botonEstaSemana).on('click', function() {

        $.ajax({
            url: '<?= base_url() ?>metricas/getAnalyticsThisWeekController',
            type: 'POST',
            dataType: 'json',
            success: function(data) {

                console.log(data)

                let divEstaSemanaUtilidad = document.createElement('div');
                divEstaSemanaUtilidad.setAttribute('class', 'card-body clearfix');
                divEstaSemanaUtilidad.setAttribute('id', 'esta_semana_utilidad');

                let smallEstaSemanaUtilidad = document.createElement('small');
                divEstaSemanaUtilidad.appendChild(smallEstaSemanaUtilidad);
                smallEstaSemanaUtilidad.innerHTML = 'Esta Semana:';

                let pEstaSemanaUtilidad = document.createElement('p');
                pEstaSemanaUtilidad.setAttribute('class', 'display-4');
                pEstaSemanaUtilidad.innerHTML = '$' + data['utilidad_esta_semana'];
                divEstaSemanaUtilidad.appendChild(pEstaSemanaUtilidad);

                let smallEstaSemanaUtilidad2 = document.createElement('small');
                divEstaSemanaUtilidad.appendChild(smallEstaSemanaUtilidad2);
                smallEstaSemanaUtilidad2.innerHTML = 'Semana Pasada:';

                let pEstaSemanaUtilidad2 = document.createElement('p');
                pEstaSemanaUtilidad2.setAttribute('class', 'display-4');
                pEstaSemanaUtilidad2.innerHTML = '$' + data['utilidad_semana_pasada'];
                divEstaSemanaUtilidad.appendChild(pEstaSemanaUtilidad2);

                console.log(divEstaSemanaUtilidad);

                $('#hoy_ayer_utilidad').hide();
                $('#hoy_antier_utilidad').hide();
                $('#ultimos_15_dias_utilidad').hide();
                $('#mes_utilidad').hide();

                if (counterEstaSemanaUtilidad <= 0) {
                    $('#card_utilidad').append(divEstaSemanaUtilidad);
                    counterEstaSemanaUtilidad++;
                }

                let divEstaSemanaVentas = document.createElement('div');
                divEstaSemanaVentas.setAttribute('class', 'card-body clearfix');
                divEstaSemanaVentas.setAttribute('id', 'esta_semana_ventas');

                let smallEstaSemanaVentas = document.createElement('small');
                divEstaSemanaVentas.appendChild(smallEstaSemanaVentas);
                smallEstaSemanaVentas.innerHTML = 'Esta Semana:';

                let pEstaSemanaVentas = document.createElement('p');
                pEstaSemanaVentas.setAttribute('class', 'display-4');
                pEstaSemanaVentas.innerHTML = '$' + data['total_ventas_esta_semana'];
                divEstaSemanaVentas.appendChild(pEstaSemanaVentas);

                let smallEstaSemanaVentas2 = document.createElement('small');
                divEstaSemanaVentas.appendChild(smallEstaSemanaVentas2);
                smallEstaSemanaVentas2.innerHTML = 'Semana Pasada:';

                let pEstaSemanaVentas2 = document.createElement('p');
                pEstaSemanaVentas2.setAttribute('class', 'display-4');
                pEstaSemanaVentas2.innerHTML = '$' + data['total_ventas_semana_pasada'];
                divEstaSemanaVentas.appendChild(pEstaSemanaVentas2);

                console.log(divEstaSemanaVentas);

                $('#hoy_ayer_ventas').hide();
                $('#ayer_antier_ventas').hide();
                $('#ultimos_15_dias_ventas').hide();
                $('#mes_ventas').hide();

                if (counterEstaSemanaVentas <= 0) {
                    $('#card_ventas').append(divEstaSemanaVentas);
                    counterEstaSemanaVentas++;
                }

                let divEstaSemanaTotalPedidos = document.createElement('div');
                divEstaSemanaTotalPedidos.setAttribute('class', 'card-body clearfix');
                divEstaSemanaTotalPedidos.setAttribute('id', 'esta_semana_total_pedidos');

                let smallEstaSemanaTotalPedidos = document.createElement('small');
                divEstaSemanaTotalPedidos.appendChild(smallEstaSemanaTotalPedidos);
                smallEstaSemanaTotalPedidos.innerHTML = 'Esta Semana:';

                let pEstaSemanaTotalPedidos = document.createElement('p');
                pEstaSemanaTotalPedidos.setAttribute('class', 'display-4 text-center');
                pEstaSemanaTotalPedidos.innerHTML = '#' + data['total_pedidos_esta_semana'];
                divEstaSemanaTotalPedidos.appendChild(pEstaSemanaTotalPedidos);

                console.log(divEstaSemanaTotalPedidos);

                $('#hoy_ayer_pedidos').hide();
                $('#ayer_antier_total_pedidos').hide();
                $('#semana_pasada_total_pedidos').hide();
                $('#mes_total_pedidos').hide();

                if (counterEstaSemanaTotalPedidos <= 0) {
                    $('#card_total_pedidos').append(divEstaSemanaTotalPedidos);
                    counterEstaSemanaTotalPedidos++;
                }

                let divEstaSemanaTicketPromedio = document.createElement('div');
                divEstaSemanaTicketPromedio.setAttribute('class', 'card-body clearfix');
                divEstaSemanaTicketPromedio.setAttribute('id', 'esta_semana_ticket_promedio');

                let smallEstaSemanaTicketPromedio = document.createElement('small');
                divEstaSemanaTicketPromedio.appendChild(smallEstaSemanaTicketPromedio);
                smallEstaSemanaTicketPromedio.innerHTML = 'Esta Semana:';

                let pEstaSemanaTicketPromedio = document.createElement('p');
                pEstaSemanaTicketPromedio.setAttribute('class', 'display-4 text-center');
                pEstaSemanaTicketPromedio.innerHTML = '$' + data['ticket_promedio_esta_semana'];
                divEstaSemanaTicketPromedio.appendChild(pEstaSemanaTicketPromedio);

                console.log(divEstaSemanaTicketPromedio);

                $('#hoy_ayer_ticket_promedio').hide();
                $('#ayer_antier_ticket_promedio').hide();
                $('#semana_pasada_ticket_promedio').hide();
                $('#mes_ticket_promedio').hide();

                if (counterEstaSemanaTicketPromedio <= 0) {
                    $('#card_ticket_promedio').append(divEstaSemanaTicketPromedio);
                    counterEstaSemanaTicketPromedio++;
                }

            }
        });

    });

    $('#ultimos15Dias_boton').on('click', function() {

        //alert('hola')
        $.ajax({

            url: '<?= base_url() ?>metricas/getAnalyticsLastWeekController',
            type: 'POST',
            dataType: 'json',
            success: function(data) {

                console.log(data)

                let divUltimos15DiasUtilidad = document.createElement('div');
                divUltimos15DiasUtilidad.setAttribute('class', 'card-body clearfix');
                divUltimos15DiasUtilidad.setAttribute('id', 'ultimos_15_dias_utilidad');

                let smallUltimos15DiasUtilidad = document.createElement('small');
                divUltimos15DiasUtilidad.appendChild(smallUltimos15DiasUtilidad);
                smallUltimos15DiasUtilidad.innerHTML = 'Ultimos 15 dias:';

                let pUltimos15DiasUtilidad = document.createElement('p');
                pUltimos15DiasUtilidad.setAttribute('class', 'display-4');
                pUltimos15DiasUtilidad.innerHTML = '$' + data['ultimos15Dias'];
                divUltimos15DiasUtilidad.appendChild(pUltimos15DiasUtilidad);

                let smallUltimos15DiasUtilidad2 = document.createElement('small');
                divUltimos15DiasUtilidad.appendChild(smallUltimos15DiasUtilidad2);
                smallUltimos15DiasUtilidad2.innerHTML = 'Ultimos 15 dias anteriores:';

                let pUltimos15DiasUtilidad2 = document.createElement('p');
                pUltimos15DiasUtilidad2.setAttribute('class', 'display-4');
                pUltimos15DiasUtilidad2.innerHTML = '$' + data['quinceDiasAnterioresALosUltimos15Dias'];
                divUltimos15DiasUtilidad.appendChild(pUltimos15DiasUtilidad2);

                console.log(divUltimos15DiasUtilidad);

                $('#hoy_ayer_utilidad').hide();
                $('#hoy_antier_utilidad').hide();
                $('#esta_semana_utilidad').hide();
                $('#mes_utilidad').hide();

                if (counterUltimos15DiasUtilidad <= 0) {
                    $('#card_utilidad').append(divUltimos15DiasUtilidad);
                    counterUltimos15DiasUtilidad++;
                }

                let divUltimos15DiasVentas = document.createElement('div');
                divUltimos15DiasVentas.setAttribute('class', 'card-body clearfix');
                divUltimos15DiasVentas.setAttribute('id', 'ultimos_15_dias_ventas');

                let smallUltimos15DiasVentas = document.createElement('small');
                divUltimos15DiasVentas.appendChild(smallUltimos15DiasVentas);
                smallUltimos15DiasVentas.innerHTML = 'Ultimos 15 dias:';

                let pUltimos15DiasVentas = document.createElement('p');
                pUltimos15DiasVentas.setAttribute('class', 'display-4');
                pUltimos15DiasVentas.innerHTML = '$' + data['VentasTotalesUltimos15Dias'];
                divUltimos15DiasVentas.appendChild(pUltimos15DiasVentas);

                let smallUltimos15DiasVentas2 = document.createElement('small');
                divUltimos15DiasVentas.appendChild(smallUltimos15DiasVentas2);
                smallUltimos15DiasVentas2.innerHTML = 'Ultimos 15 dias anteriores:';

                let pUltimos15DiasVentas2 = document.createElement('p');
                pUltimos15DiasVentas2.setAttribute('class', 'display-4');
                pUltimos15DiasVentas2.innerHTML = '$' + data['ventasQuinceDiasAnterioresALosUltimos15Dias'];
                divUltimos15DiasVentas.appendChild(pUltimos15DiasVentas2);

                console.log(divUltimos15DiasVentas);

                $('#hoy_ayer_ventas').hide();
                $('#ayer_antier_ventas').hide();
                $('#esta_semana_ventas').hide();
                $('#mes_ventas').hide();

                if (counterUltimos15DiasVentas <= 0) {
                    $('#card_ventas').append(divUltimos15DiasVentas);
                    counterUltimos15DiasVentas++;
                }

                let divUltimos15DiasTotalPedidos = document.createElement('div');
                divUltimos15DiasTotalPedidos.setAttribute('class', 'card-body clearfix');
                divUltimos15DiasTotalPedidos.setAttribute('id', 'semana_pasada_total_pedidos');

                let smallUltimos15DiasTotalPedidos = document.createElement('small');
                divUltimos15DiasTotalPedidos.appendChild(smallUltimos15DiasTotalPedidos);
                smallUltimos15DiasTotalPedidos.innerHTML = 'Semana Pasada:';

                let pUltimos15DiasTotalPedidos = document.createElement('p');
                pUltimos15DiasTotalPedidos.setAttribute('class', 'display-4 text-center');
                pUltimos15DiasTotalPedidos.innerHTML = '#' + data['total_pedidos_semana_pasada'];
                divUltimos15DiasTotalPedidos.appendChild(pUltimos15DiasTotalPedidos);

                console.log(divUltimos15DiasTotalPedidos);

                $('#hoy_ayer_pedidos').hide();
                $('#ayer_antier_total_pedidos').hide();
                $('#esta_semana_total_pedidos').hide();
                $('#mes_total_pedidos').hide();

                if (counterUltimos15DiasTotalPedidos <= 0) {
                    $('#card_total_pedidos').append(divUltimos15DiasTotalPedidos);
                    counterUltimos15DiasTotalPedidos++;
                }

                let divUltimos15DiasTicketPromedio = document.createElement('div');
                divUltimos15DiasTicketPromedio.setAttribute('class', 'card-body clearfix');
                divUltimos15DiasTicketPromedio.setAttribute('id', 'semana_pasada_ticket_promedio');

                let smallUltimos15DiasTicketPromedio = document.createElement('small');
                divUltimos15DiasTicketPromedio.appendChild(smallUltimos15DiasTicketPromedio);
                smallUltimos15DiasTicketPromedio.innerHTML = 'Semana Pasada:';

                let pUltimos15DiasTicketPromedio = document.createElement('p');
                pUltimos15DiasTicketPromedio.setAttribute('class', 'display-4 text-center');
                pUltimos15DiasTicketPromedio.innerHTML = '$' + data['ticket_promedio_semana_pasada'];
                divUltimos15DiasTicketPromedio.appendChild(pUltimos15DiasTicketPromedio);

                console.log(divUltimos15DiasTicketPromedio);

                $('#hoy_ayer_ticket_promedio').hide();
                $('#ayer_antier_ticket_promedio').hide();
                $('#esta_semana_ticket_promedio').hide();
                $('#mes_ticket_promedio').hide();

                if (counterUltimos15DiasTicketPromedio <= 0) {
                    $('#card_ticket_promedio').append(divUltimos15DiasTicketPromedio);
                    counterUltimos15DiasTicketPromedio++;
                }
            }
        })
    })

    $('#mes_boton').on('click', function() {

        $.ajax({

            url: '<?= base_url() ?>metricas/getAnalyticsOfMonth',
            type: 'POST',
            dataType: 'json',
            success: function(data) {

                console.log(data)

                let divMesUtilidad = document.createElement('div');
                divMesUtilidad.setAttribute('class', 'card-body clearfix');
                divMesUtilidad.setAttribute('id', 'mes_utilidad');

                let smallMesUtilidad = document.createElement('small');
                divMesUtilidad.appendChild(smallMesUtilidad);
                smallMesUtilidad.innerHTML = 'Mes Actual:';

                let pMesUtilidad = document.createElement('p');
                pMesUtilidad.setAttribute('class', 'display-4');
                pMesUtilidad.innerHTML = '$' + data['utilidadTotalDelMes'];
                divMesUtilidad.appendChild(pMesUtilidad);

                let smallMesUtilidad2 = document.createElement('small');
                divMesUtilidad.appendChild(smallMesUtilidad2);
                smallMesUtilidad2.innerHTML = 'Mes Pasado';

                let pMesUtilidad2 = document.createElement('p');
                pMesUtilidad2.setAttribute('class', 'display-4');
                pMesUtilidad2.innerHTML = '$' + data['utilidadTotalDelMesPasado'];
                divMesUtilidad.appendChild(pMesUtilidad2);

                console.log(divMesUtilidad);

                $('#hoy_ayer_utilidad').hide();
                $('#hoy_antier_utilidad').hide();
                $('#ultimos_15_dias_utilidad').hide();
                $('#esta_semana_utilidad').hide();

                if (counterMesUtilidad <= 0) {
                    $('#card_utilidad').append(divMesUtilidad);
                    counterMesUtilidad++;
                }

                let divMesVentas = document.createElement('div');
                divMesVentas.setAttribute('class', 'card-body clearfix');
                divMesVentas.setAttribute('id', 'mes_ventas');

                let smallMesVentas = document.createElement('small');
                divMesVentas.appendChild(smallMesVentas);
                smallMesVentas.innerHTML = 'Mes Actual:';

                let pMesVentas = document.createElement('p');
                pMesVentas.setAttribute('class', 'display-4');
                pMesVentas.innerHTML = '$' + data['ventasTotalDelMes'];
                divMesVentas.appendChild(pMesVentas);

                let smallMesVentas2 = document.createElement('small');
                divMesVentas.appendChild(smallMesVentas2);
                smallMesVentas2.innerHTML = 'Mes Pasado:';

                let pMesVentas2 = document.createElement('p');
                pMesVentas2.setAttribute('class', 'display-4');
                pMesVentas2.innerHTML = '$' + data['ventasTotalDelMesPasado'];
                divMesVentas.appendChild(pMesVentas2);

                console.log(divMesVentas);

                $('#hoy_ayer_ventas').hide();
                $('#ayer_antier_ventas').hide();
                $('#esta_semana_ventas').hide();
                $('#ultimos_15_dias_ventas').hide();

                if (counterMesVentas <= 0) {
                    $('#card_ventas').append(divMesVentas);
                    counterMesVentas++;
                }

                let divMesTotalPedidos = document.createElement('div');
                divMesTotalPedidos.setAttribute('class', 'card-body clearfix');
                divMesTotalPedidos.setAttribute('id', 'mes_total_pedidos');

                let smallMesTotalPedidos = document.createElement('small');
                divMesTotalPedidos.appendChild(smallMesTotalPedidos);
                smallMesTotalPedidos.innerHTML = 'Mes Actual:';

                let pMesTotalPedidos = document.createElement('p');
                pMesTotalPedidos.setAttribute('class', 'display-4 text-center');
                pMesTotalPedidos.innerHTML = '#' + data['total_pedidos_mes_actual'];
                divMesTotalPedidos.appendChild(pMesTotalPedidos);

                console.log(divMesTotalPedidos);

                $('#hoy_ayer_pedidos').hide();
                $('#ayer_antier_total_pedidos').hide();
                $('#esta_semana_total_pedidos').hide();
                $('#semana_pasada_total_pedidos').hide();

                if (counterMesTotalPedidos <= 0) {
                    $('#card_total_pedidos').append(divMesTotalPedidos);
                    counterMesTotalPedidos++;
                }

                let divMesTicketPromedio = document.createElement('div');
                divMesTicketPromedio.setAttribute('class', 'card-body clearfix');
                divMesTicketPromedio.setAttribute('id', 'mes_ticket_promedio');

                let smallMesTicketPromedio = document.createElement('small');
                divMesTicketPromedio.appendChild(smallMesTicketPromedio);
                smallMesTicketPromedio.innerHTML = 'Mes Actual:';

                let pMesTicketPromedio = document.createElement('p');
                pMesTicketPromedio.setAttribute('class', 'display-4 text-center');
                pMesTicketPromedio.innerHTML = '$' + data['ticket_promedio_mes_actual'];
                divMesTicketPromedio.appendChild(pMesTicketPromedio);

                console.log(divMesTicketPromedio);

                $('#hoy_ayer_ticket_promedio').hide();
                $('#ayer_antier_ticket_promedio').hide();
                $('#esta_semana_ticket_promedio').hide();
                $('#semana_pasada_ticket_promedio').hide();

                if (counterMesTicketPromedio <= 0) {
                    $('#card_ticket_promedio').append(divMesTicketPromedio);
                    counterMesTicketPromedio++;
                }
            }
        })
    })
</script>