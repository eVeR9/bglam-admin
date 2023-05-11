    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
        <span class="brand-text font-weight-light" style="margin-left:50px;"><b>Bglam</b> Admin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url() ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Pablo Quintanilla</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item has-treeview menu-close">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                  Reportes
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="<?= base_url('metricas/') ?>" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Detalles de Ventas</p>
                  </a>
                </li>
                <!-- 
                <li class="nav-item">
                  <a href="<?= base_url('pedidos/add') ?>" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Agregar Pedidos</p>
                  </a>
                </li>
                -->
                <!--
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
              -->
              </ul>
            </li>

            <li class="nav-item has-treeview menu-close">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-hand-holding-usd"></i>
                <p>
                  Ventas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('productos/') ?>" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Crear Pedido</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('pedidos/') ?>" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bitacora de Pedidos</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                  Catalogo
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <!--
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Level 2</p>
                  </a>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Level 2
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Level 2</p>
                  </a>
                </li>
              </ul>
              -->
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Productos
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="<?= base_url('productos/add') ?>" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Agregar Productos</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inventario
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="<?= base_url('inventario/') ?>" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver</p>
                      </a>
                    </li>
                  </ul>
                  
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Marcas
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="<?= base_url('marcas/add') ?>" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Agregar Marcas</p>
                      </a>
                    </li>
                  </ul>
                  
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Metodos de Pago
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <!--
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="<?= base_url('productos/add') ?>" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Agregar Productos</p>
                      </a>
                    </li>
                  </ul>
                  -->
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="" class="nav-link active">
                <i class="nav-icon fas fa-coins"></i>
                  <p>
                    Gastos
                    <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('gastos/index')?>" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bitacora de Gastos
                    </p>
                  </a>
                </li>
              </ul>
            </li>


            <!--
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          -->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>