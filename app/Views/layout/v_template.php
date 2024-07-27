<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Infinity Brew</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('template') ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('template') ?>/plugins/fontawesome6/css/all.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('template') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('template') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('template') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('template') ?>/dist/css/adminlte.min.css">
  <!-- SweetAlert -->
  <link rel="stylesheet" href="<?= base_url('template') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- ChartJS -->
  <script src="<?= base_url('template') ?>/plugins/chart.js/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- AutonumericJS -->
  <script src="<?= base_url('autoNumeric') ?>/src/AutoNumeric.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-footer-fixed">
  <div class="wrapper">

    <?= $this->include('layout/navbar') ?>
    <?= $this->include('layout/sidebar') ?>

    <!-- Main Content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= $title; ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#"><?= $menu ?></a></li>
                <li class="breadcrumb-item active"><?= $submenu ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- /.content-header -->
      <?= $this->renderSection('content'); ?>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">
        House Of Coffee
      </div>
      <strong>Copyright &copy; 2023 <a href="#">InfinityBrew</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="<?= base_url('template') ?>/plugins/jquery/jquery.min.js">
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('template') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js">
  </script>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url('template') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('template') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('template') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('template') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('template') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('template') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('template') ?>/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('template') ?>/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('template') ?>/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('template') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('template') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('template') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!--AdminLTE App -->
  <script src="<?= base_url('template') ?>/dist/js/adminlte.min.js">
  </script>
  <!-- SweetAlert -->
  <script src="<?= base_url('template') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script>
    $(function() {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        width: '270px',
        padding: '10px',
        showConfirmButton: false,
        timer: 4000
      });

      $('.swalDefaultSuccess').show(function() {
        Toast.fire({
          icon: 'success',
          title: '<?= (session()->getFlashdata('pesan')) ?>'
        })
      });

      $('.swalDefaultError').show(function() {
        Toast.fire({
          icon: 'error',
          title: '<?= (session()->getFlashdata('errors')) ?>'
        })
      });

    });
  </script>
  <script src="<?= base_url('template') ?>/plugins/sweetalert2/myscript.js"></script>
  <!-- Page specific script -->
  <script>
    //DataTable Settings
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    // Initialization Autonumeric
    new AutoNumeric('#harga_beli', {
      digitGroupSeparator: ',',
      decimalPlaces: 0,
    });
    new AutoNumeric('#harga_jual', {
      digitGroupSeparator: ',',
      decimalPlaces: 0,
    });
  </script>
</body>

</html>