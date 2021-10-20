<?php

session_start();

require './functions.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
  <div class="wrapper">

    <!-- Call NAVBAR dan Side bar -->
    <?php include './dash_navbar.php';
    include './dash_sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-gradient-lightblue">
            <h3 class="card-title text-light">Management User</h3>
          </div>
          <div class="card-body">
            <a class="btn btn-app shadow rounded bg-gradient-blue" href="./pages/mn_user/in_user.php">
              <i class="fas fa-users"></i>Users
            </a>

            <a class="btn btn-app bg-gradient-cyan">
              <i class="fas fa-users"></i>Member
            </a>

            <a class="btn btn-app bg-gradient-navy">
              <i class="fas fa-inbox"></i> Orders
            </a>

            <a class="btn btn-app bg-gradient-orange">
              <i class="fas fa-heart"></i> Likes
            </a>

            <a class="btn btn-app bg-gradient-pink">
              <i class="fas fa-heart"></i> Likes
            </a>
            <!-- </div> -->
          </div>
        </div>

        <div class="card">
          <div class="card-header bg-gradient-teal">
            <h3 class="card-title text-dark">Operational</h3>
          </div>
          <div class="card-body">
            <a href="./pages/port/in_port.php" class="btn btn-app bg-gradient-blue shadow rounded ">
              <i class="fas fa-ship"></i>PORT
            </a>

            <a href="./pages/cms/in_cms.php" class="btn btn-app shadow rounded bg-gradient-cyan">
              <i class="fas fa-box"></i></i>CMS
            </a>

            <a class="btn btn-app shadow rounded bg-gradient-navy">
              <i class="fas fa-truck-moving"></i>TRANSPORT
            </a>

            <a class="btn btn-app bg-gradient-orange">
              <i class="fas fa-tractor"></i>HE
            </a>

            <a class="btn btn-app bg-gradient-pink">
              <i class="fas fa-heart"></i> Likes
            </a>

            <a class="btn btn-app bg-gradient-yellow">
              <i class="fas fa-heart"></i> Likes
            </a>

          </div>
        </div>

      </div>

    </div>




    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->




  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>