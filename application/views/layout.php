<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>BglamAdmin | Dashboard</title>

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url()?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url()?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url()?>plugins/fontawesome-free/css/all.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

        <?php //if($this->session->flashdata('msg') != ''): ?>
			    <!-- <div class="alert alert-warning flash-msg alert-dismissible"> 
			      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
            <h4> Perfecto!</h4> --> 
			  <?php //endif; ?>

   <?php include_once('includes/navbar.php'); ?>

   <?php include_once('includes/sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <!-- <h1 class="m-0 text-dark">Dashboard</h1> -->
            </div><!-- /.col -->

            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Welcome</li>
              </ol>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
        
        <!-- Charge dynamicly the view -->
        
        <?php $this->load->view($view); ?>

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <!-- 
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>  
    -->
      <!-- Default to the left -->
      <strong>&copy; 2015-2020 <a href="#">Bglam</a></strong> Todos los Derechos Reservados
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?= base_url()?>plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="<?= base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- AdminLTE App -->
  <script src="<?= base_url()?>dist/js/adminlte.min.js"></script>

  <!-- SweetAlert2 -->
<script src="<?= base_url()?>plugins/sweetalert2/sweetalert2.min.js"></script>

</body>
</html>

<script type="text/javascript">
/*
$(function(){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        type: 'success',
        title: 'Agregado! El producto se guardo exitosamente'
      })
    });
});
*/
</script>