<?php

session_start();

require '../functions.php';

$name = $_SESSION["full_name"];
$img = $_SESSION["foto"];

$dashboard = '';
$mng_acc = 'menu-open';

$form = 'List User';
$sb_add_user = '';
$sb_list_user = 'active';
$sb_home = '';

$data_user = query(1, 'SELECT * FROM user_admin');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Logistic</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include './user_navbar.php';
    include './user_sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>List User Admin</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Admin</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">List user Admin</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form action="" method="post">

                    <!-- <div class="row pb-2">
                      <div class="col-md-3">
                        <input type="text" class="form-control shadow-sm" id="search" placeholder="Search" name="search" required autocomplete="off">
                      </div>
                    </div> -->
                    <div class="row">
                      <div class="input-group col-md-3 mb-3">
                        <input type="text" class="form-control shadow-sm" id="search" name="search" placeholder="Search" autocomplete="off">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-search"></span>
                          </div>
                        </div>
                      </div>
                    </div>

                  </form>
                  <div id="container">
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                        <tr class="bg-gradient-dark text-center">
                          <th class="align-middle">No</th>
                          <th class="align-middle">User ID</th>
                          <th class="align-middle">ID SAP</th>
                          <th class="align-middle">NIK</th>
                          <th class="align-middle">Name</th>
                          <th class="align-middle">Birth</th>
                          <th class="align-middle">Email</th>
                          <th class="align-middle">Gender</th>
                          <th class="align-middle">Status</th>
                          <th class="align-middle">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($data_user as $row) :

                          $stat = $row['aktif'];

                          if ($stat == 1) {
                            $remark = "Active";
                            $stat = "text-success";
                          } else if ($stat == 0) {
                            $remark = "Non Active";
                            $stat = "text-danger";
                          }

                          if ($row['gender'] == 'Male') {
                            $sgender = "fas fa-mars text-primary";
                            $rgender = 'Male';
                          } else if ($row['gender'] == 'Female') {
                            $sgender = "fas fa-venus text-red";
                            $rgender = 'Female';
                          }

                        ?>
                          <tr>
                            <td class="text-center align-middle"><?= $i; ?></td>
                            <td class="align-middle"><?= $row['user_id']; ?></td>
                            <td class="text-center align-middle"><?= $row['id_sap']; ?></td>
                            <td class="text-center align-middle"><?= $row['nik']; ?></td>
                            <td class="align-middle"><?= $row['first_name'] . " " . $row['last_name']; ?></td>
                            <td class="align-middle"><?= $row['birth_place'] . ", " . date("d-m-y", strtotime($row["birth_date"]));; ?></td>
                            <td class="align-middle"><?= $row['email']; ?></td>
                            <td class="text-center align-middle" data-toggle="tooltip" title="<?= $rgender; ?>"><i class="<?= $sgender; ?>"></i></td>
                            <td class="text-center align-middle" data-toggle="tooltip" title="<?= $remark; ?>"><i class="fas fa-circle <?= $stat; ?>"></i>
                            </td>
                            <td class="text-center align-middle">
                              <div class="btn-group">
                                <button type="button" class="btn btn-default">
                                  <a href="">
                                    <i class="fas fa-info-circle"></i>
                                  </a>
                                </button>

                                <button type="button" class="btn btn-default">
                                  <a href="">
                                    <i class="far fa-edit"></i>
                                  </a>
                                </button>

                                <button type="button" class="btn btn-default">
                                  <a href="">
                                    <i class="far fa-trash-alt"></i>
                                  </a>
                                </button>

                              </div>

                            </td>
                          </tr>
                        <?php $i++;
                        endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.1
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script src="script.js"></script>

  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>