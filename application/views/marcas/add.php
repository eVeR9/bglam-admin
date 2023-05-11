<div class="container">
<div class="row" style="">
<div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registra una Marca</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <?php //$error; ?>

            <div class="card-body">
            <form method="post" action="<?= base_url('marcas/add')?>" id="superform" class="action">

                <!-- 
                <div class="custom-file" style="margin-bottom:15px;">
                    <input type="file" class="custom-file-input" name="imagen" id="imagen">
                    <label class="custom-file-label" for="imagen">Selecciona una imagen</label>
                </div>
                -->

                <div class="form-group">
                    <label for="nombre">Marca</label>    
                    <input type="text" id="marca" name="marca" class="form-control">
                </div>

                <!-- 
                <div class="form-group">
                    <label for="inputDescription">Descripcion</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="4"></textarea>
                </div>
                -->
                
                <!-- 
                <div class="form-group">
                    <label for="marca_id">Marca</label>
                    <select name="marca_id" id="marca_id" class="form-control custom-select">
                        <option selected value="0">Seleccione</option>
                        <option value="1">Dermacol</option>
                        <option value="2">MAC</option>
                        <option value="3">Bright</option>
                    </select>
                </div>
                --> 

                <!-- 
                <div class="form-group">
                    <label for="stock">Cargar Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" min="0">
                </div>
                -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="text-right">
                            <input type="submit" name="submit" id="submit" value="Add" class="btn btn-primary swalDefaultSuccess">
                        </div>
                    </div>
                </div>
                <!-- <button type="button" class="btn btn-success swalDefaultSuccess">Click Aqui</button>-->

            </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
</div>
