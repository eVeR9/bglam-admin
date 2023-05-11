<div class="row" style="margin-left: 235px;">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Agregar Pedido</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <?php //$error; ?>

            <div class="card-body">
            <form method="post" id="superform" class="action" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="fecha">Fecha de Pedido</label>
                    <input type="date" name="fecha" id="fecha" class="form-control">
                </div>

                <div class="custom-file" style="margin-bottom:15px;">
                    <input type="file" class="custom-file-input" name="imagen" id="imagen">
                    <label class="custom-file-label" for="imagen">Selecciona una imagen</label>
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
                    <label for="Precio">Precio</label>
                    <input type="number" class="form-control" step="any" name="precio" id="precio" min="0">
                </div>

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