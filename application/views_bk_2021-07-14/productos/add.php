  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url()?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<div class="row" style="margin-left: 235px;">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registra un Producto</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <?php //$error; ?>

            <div class="card-body">
            <form method="post" id="superform" class="action" enctype="multipart/form-data">

                <div class="custom-file" style="margin-bottom:15px;">
                    <input type="file" class="custom-file-input" name="imagen" id="imagen">
                    <label class="custom-file-label" for="imagen">Selecciona una imagen</label>
                </div>
               

                <div class="form-group">
                    <label for="fecha">Fecha de Registro</label>
                    <input type="date" name="fecha" id="fecha" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nombre">Producto</label>    
                    <input type="text" id="nombre" name="nombre" class="form-control">
                </div>

                <!-- 
                <div class="form-group">
                    <label for="inputDescription">Descripcion</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="4"></textarea>
                </div>
                -->

                <div class="form-group">
                    <label for="marca_id">Marca</label>
                    <select name="marca_id" id="marca_id" class="form-control custom-select">
                        <option selected value="">Seleccione</option>
                        <?php foreach($marcas as $marca): ?>
                            <option value="<?= $marca['id']?>"><?= $marca['marca']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="codigo">Codigo</label>
                    <input type="number" id="codigo" name="codigo" class="form-control">
                </div>

                <div class="form-group">
                    <label for="estatus_id">Estatus</label>
                    <select name="estatus_id" id="estatus_id" class="form-control custom-select">
                        <option selected value="0">Seleccione</option>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                        <option value="3">Descontinuado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="estatus_id">Costo</label>
                    <input type="number" class="form-control" step="any" name="costo" id="costo" min="0">
                </div>

                <div class="form-group">
                    <label for="Precio">Precio</label>
                    <input type="number" class="form-control" step="any" name="precio" id="precio" min="0">
                </div>

                <!-- 
                <div class="form-group">
                    <label for="stock">Cargar Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" min="0">
                </div>
                -->

                <input type="hidden" name="action" class="btn btn-success" value="Add" />
                <input type="submit" name="action" id="action" value="Add" class="btn btn-primary swalDefaultSuccess">
                <!-- <button type="button" class="btn btn-success swalDefaultSuccess">Click Aqui</button>-->

            </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- jQuery -->
<script src="<?= base_url()?>plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?= base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url()?>plugins/sweetalert2/sweetalert2.min.js"></script>



<script type="text/javascript">

$(document).ready(function() {

    $(".custom-file-input").on("change", function() {
  let fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

});

$('form').on('click', '.swalDefaultSuccess', function(e){
    event.preventDefault();

    var fecha = $('#fecha').val();
    var nombre = $('#nombre').val();
    var marca_id = $('#marca_id').val();
    var codigo = $('#codigo').val();
    var estatus_id = $('#estatus_id').val();
    var costo = $('#costo').val();
    var precio = $('#precio').val();
    var stock = $('#stock').val();
    var imagen = $('#imagen').val().split('.').pop();
    var form = new FormData(document.getElementById('superform'));

    if(jQuery.inArray(imagen, ['jpg', 'png', 'gif']) == -1){

        $(function(){

const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
            });

        //$('.swalDefaultSuccess').click(function() {
        Toast.fire({
        type: 'error',
        title: 'Por favor seleccione una imagen para el producto'
    })
});
        $('#imagen').val('');
        return false;
    }

    if(nombre != "" && codigo != "" && estatus_id != "" && costo != ""){

        $.ajax({
        url: '<?php echo base_url()?>productos/add',
        type: 'POST',
        data: form,
        contentType: false,
        processData: false,
        success: function(data){
                    
            $(function(){
                const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                            });

                        //$('.swalDefaultSuccess').click(function() {
                        Toast.fire({
                        type: 'success',
                        title: 'Agregado! El producto se guardo exitosamente'
                    })
            });
            //$('.action').submit();
            $('#superform')[0].reset();
        }
        /*$(function(){

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000,
    });

    //$('.swalDefaultSuccess').click(function() {
      Toast.fire({
        type: 'success',
        title: 'Agregado! El producto se guardo exitosamente'
      })

    }),*/
  });

    } else{
        $(function(){

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
            });

        //$('.swalDefaultSuccess').click(function() {
        Toast.fire({
        type: 'error',
        title: 'Es necesario que capture los campos, para guardar los datos'
        })
    });
  }

});
}); //End jQuery
</script>




