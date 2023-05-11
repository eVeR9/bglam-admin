      <!-- DataTables -->
      <link rel="stylesheet" href="<?= base_url() ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<section class="content" style="margin-top: -10px;">
<div class="row">
    <div class="col-12">
        <div class="card">
        <h1 class="mt-2">Bitacora de Pedidos</h1>
        <div class="card-body">
        <table class="table table-striped" id="example1">
        <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="30%">Cliente</th>
                <th width="20%">Creado</th>
                <th width="20%">Total</th>
                <th width="20%">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido) : ?>
                <tr>
                    <td><?= $pedido['id'] ?></td>
                    <td><?= $pedido['cliente_id'] ?></td>
                    <td><?= $pedido['created_at'] ?></td>
                    <td>$<?= round($pedido['total_pedido'], 2) ?></td>
                    <td><a class="btn btn-sm btn-info" href="<?= base_url('pedidos/edit/'.$pedido['id'])?>">Editar</a> | <button id="disable_pedido" class="btn btn-sm btn-danger btn-disable" value="<?= $pedido['id']?>">Eliminar</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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

          $(document).ready(function(){

            let id = $('disable_pedido')

            $('.btn-disable').on('click', id, function(){

                let id = $(this).val()

                $.ajax({
                url: '<?= base_url()?>pedidos/disablePedidoFromController/'+id,
                type: 'POST',
                data: {id:id},
                //dataType: '',
                error: function(){

                    alert('Hubo un error! ;(')
                },
                success: function(data){

                    alert('Pedido eliminado')
                    location.reload()
                }
            })

            })

          })



      </script>