<?php
session_start();

require '../functions.php';

$form = 'Create Shipment';
$nik = $_SESSION["nik"];
$code = 'Port Operation selalu dihati'; // Encrypt code

// Manage Account
$shp = 'menu-open';
$sb_add_shipment = '';
$sb_list_shipment = 'active';

$query = "SELECT 
            id_voy_in,
            type_code,
            vessel_code,
            vessel_name,
            flag,
            voyage,
            pol,
            td_pol,
            eta_prw,
            ta_prw,
            vessel_plan
          FROM
            vw_open_shipment";

$shipment = query(1, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Open Shipment</title>

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

<body class="hold-transition sidebar-mini layout-navbar-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include './port_navbar.php';
    include './port_sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h2>Open Shipment</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Open Shipment</li>
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
                  <h3 class="card-title">Shipment List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form action="" method="post">
                    <div class="row">
                      <div class="input-group col-md-3 mb-3">
                        <input type="text" id="search" class="form-control shadow-sm" id="src_shipment" name="src_shipment" placeholder="Search" autocomplete="off">
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
                          <th class="align-middle">Shipment In</th>
                          <th class="align-middle">POL</th>
                          <th class="align-middle">TD<br>POL</th>
                          <th class="align-middle">ETA<br>PRW</th>
                          <th class="align-middle">TA<br>PRW</th>
                          <th class="align-middle">Plan</th>
                          <th class="align-middle">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($shipment as $shp) :

                          $vsl = $shp['type_code'] . '. ' . $shp['vessel_name'] . ' V.' . $shp['voyage'];
                          $plan = $shp['vessel_plan'];

                          if ($plan == 1) {
                            $vessel_plan = 'BB';
                            $vsl_remark = 'Bongkar';
                          } else if ($plan == 2) {
                            $vessel_plan = 'MM';
                            $vsl_remark = 'Muat';
                          } else if ($plan == 3) {
                            $vessel_plan = 'BM';
                            $vsl_remark = 'Bongkar & Muat';
                          }

                          if ($shp['ta_prw'] == '') {
                            $ta_prw = '';
                            $bg_clr = '';
                          } else {
                            $ta_prw = date("d-M", strtotime($shp["ta_prw"])) . '<br>' . date("[H:i]", strtotime($shp["ta_prw"]));
                            $bg_clr = 'bg-gradient-success';
                          }
                        ?>
                          <tr class="<?= $bg_clr; ?>">
                            <td class=" text-center align-middle"><?= $i; ?></td>
                            <td class="align-middle"><?= $vsl; ?></td>
                            <td class="text-center align-middle"><?= $shp['pol']; ?></td>
                            <td class="text-center align-middle"><?= date("d-M", strtotime($shp["td_pol"])); ?> <br> <?= date("[H:i]", strtotime($shp["td_pol"])); ?></td>
                            <td class="text-center align-middle"><?= date("d-M", strtotime($shp["eta_prw"])); ?> <br> <?= date("[H:i]", strtotime($shp["eta_prw"])); ?></td>
                            <td class="text-center align-middle"><?= $ta_prw; ?></td>
                            <td class="text-center align-middle" data-toggle="tooltip" title="<?= $vsl_remark; ?>"><?= $vessel_plan; ?></td>
                            </td>
                            <td class="text-center align-middle">
                              <div class="btn-group">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#information">
                                  <a href="./info_shipment.php?keyword=<?= encrypt($shp['id_voy_in'], $code); ?>" data-toggle="tooltip" title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                  </a>
                                </button>

                                <!-- <button type="button" class="btn btn-default" data-toggle="tooltip" title="Edit">
                                  <a href="./info_shipment.php?keyword=">
                                    <i class="far fa-edit"></i>
                                  </a>
                                </button> -->

                                <button type="button" class="btn btn-default">
                                  <a href="" title="Status">
                                    <i class="fas fa-ship"></i>
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
        <b>Version</b> 3.1.0
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
  <script src="./script_list.js"></script>
  <script>
    $(function() {
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