<?php

use CodeIgniter\HTTP\Header;

session_start();

require '../functions.php';

$form = 'Info Shipment';
$frm_code = 'Port Operation selalu dihati';
$nik = $_SESSION["nik"];

$keyword = decrypt($_GET['keyword'], $frm_code);

// Manage Account
$shp = 'menu-open';
$sb_add_shipment = 'active';
$sb_list_shipment = '';

// $query = "SELECT * FROM vw_open_shipment WHERE id_voy_in = '$keyword'";
$query = mysqli_query($conn, "SELECT * FROM vw_open_shipment WHERE id_voy_in = '$keyword'");
$data = mysqli_fetch_assoc($query);


if (mysqli_num_rows($query) < 0) {
  echo "
      <script>
        alert('Data not Found..');
      </script>
    ";
  Header('Location: ./list_shipment.php');
} else if (mysqli_num_rows($query) == 1) {

  $vsl = $data['type_code'] . '. ' . $data['vessel_name'] . ' V.' . $data['voyage'];

  if ($data['ta_prw'] == '') {
    $ta_prw = '';
  } else {
    $ta_prw = date("d-m-y [H:i]", strtotime($data["ta_prw"]));
  }

  if ($data['eta_prw'] == '') {
    $eta_prw = '';
  } else {
    $eta_prw = date("d-m-y [H:i]", strtotime($data["eta_prw"]));
  }

  if ($data['td_pol'] == '') {
    $td_pol = '';
  } else {
    $td_pol = date("d-m-y [H:i]", strtotime($data["td_pol"]));
  }

  $plan = $data['vessel_plan'];

  if ($plan == 1) {
    $vessel_plan = 'Bongkar';
  } else if ($plan == 2) {
    $vessel_plan = 'Muat';
  } else if ($plan == 3) {
    $vessel_plan = 'Bongkar & Muat';
  }

  $cargo_plan = $data['cargo_plan'];
  if ($cargo_plan == 1) {
    $cargo_plan = 'Breakbulk';
  } else if ($cargo_plan == 2) {
    $cargo_plan = 'Container';
  } else if ($cargo_plan == 3) {
    $cargo_plan = 'Inbulk Cargo';
  }
}

if (isset($_POST["update"])) {
  $up_ta_date = $_POST["ta-prw"];
  $new_ta_date = $td_pol = date('Y-m-d H:i:s', strtotime("$up_ta_date"));
  $remark = $_POST['remark'];

  // $id_voy = $_GET['keyword'];
  $sql =  "UPDATE voy_in SET ta_prw = '$new_ta_date' , remark = '$remark' WHERE id_voy_in = '$keyword' ";
  $query = mysqli_query($conn, $sql);

  $error_msg = mysqli_error($conn);
  // Check apakah data berhasil ditambahkan atau tidak
  if (mysqli_affected_rows($conn) > 0) {
    // historical($form, $action, $desc, $nik, $act_by);
    echo " 
        <script>
            alert('Data shipment berhasil di update.');
        </script>
    ";
    header("Location: list_shipment.php");
    // exit;
  } else {
    echo "
        <script>
            alert('GAGAL di simpan [ $error_msg ] ');
        </script>
    ";
  }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Info Shipment</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
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
              <h1>Info Shipment</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">List Shipment</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="card card-primary shadow">
                <div class="card-header">
                  <h3 class="card-title">Information Shipment</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST">
                  <div class="card-body">

                    <!-- Vessel -->
                    <div class="form-group">
                      <label for="vessel">Vessel</label>
                      <input type="text" class="form-control shadow-sm" value="<?= $vsl; ?>" disabled>
                    </div>
                    <!-- [AKhir] Vessel -->


                    <!-- POL -->
                    <div class="form-group">
                      <label for="pol">POL (Port Of Loading)</label>
                      <input type="text" class="form-control shadow-sm" id="pol" value="<?= $data['pol']; ?>" name="pol" disabled>
                    </div>
                    <!-- [Akhir] POL -->

                    <!-- TD POL -->
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <label>TD POL</label>
                          <div class="input-group date" id="td-pol" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#td-pol" value="<?= $td_pol; ?>" disabled>
                            <div class="input-group-append" data-target="#td-pol" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <label>ETA PRW</label>
                          <div class="input-group date shadow-sm" id="eta-prw" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="eta-pol" data-target="#eta-prw" value="<?= $eta_prw; ?>">
                            <div class="input-group-append" data-target="#eta-prw" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- [Akhir] POL -->

                    <!-- TA Perawang -->
                    <div class="form-group">
                      <label>TA PRW</label>
                      <div class="input-group date shadow-sm" id="ta-prw" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="ta-prw" data-target="#ta-prw" value="<?= $ta_prw; ?>">
                        <div class="input-group-append" data-target="#ta-prw" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                    <!-- [Akhir] TA Perawang -->

                    <!-- Vessel Plan -->
                    <div class="form-group">
                      <label for="vessel_plan">Vessel Plan</label>
                      <input type="text" class="form-control shadow-sm" value="<?= $vessel_plan; ?>" disabled>
                    </div>
                    <!-- [Akhir] Vessel Plan -->

                    <!-- Cargo Plan -->
                    <div class="form-group">
                      <label for="cargo_type">Cargo Type</label>
                      <input type="text" class="form-control shadow-sm" value="<?= $cargo_plan; ?>" disabled>
                    </div>
                    <!-- [Akhir] Cargo Plan -->

                    <!-- Remark -->
                    <div class="form-group">
                      <label for="Remark">Remark<span class="text-danger">*</span></label>
                      <input type="text" class="form-control shadow-sm" id="Remark" value="<?= $data['remark']; ?>" placeholder="Enter Remark" name="remark" equired autocomplete="off">
                    </div>
                    <!-- [Akhir] Remark -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary" name="update">Save</button>
                      <button type="submit" class="btn btn-primary text-white" name="update">
                        <a href="./list_shipment.php" class="text-white">Back</a>
                      </button>
                    </div>
                </form>
              </div>
              <!-- /.card -->

            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
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

  <!-- InputMask -->
  <script src="../../plugins/moment/moment.min.js"></script>
  <script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>

  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Select2 -->
  <script src="../../plugins/select2/js/select2.full.min.js"></script>

  <!-- dropzonejs -->
  <script src="../../plugins/dropzone/min/dropzone.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {

      $('#eta-prw').datetimepicker({
        format: 'DD-MMM-YYYY'
      });

      //Initialize Select2 Elements
      $('.select2').select2()

      //Date and time picker
      $('#td-pol').datetimepicker({
        icons: {
          time: 'far fa-clock'
        },
        format: 'DD-MMM-YYYY hh:mm A'
      });

      //Date and time picker
      $('#ta-prw').datetimepicker({
        icons: {
          time: 'far fa-clock'
        },
        format: 'DD-MMM-YYYY hh:mm A'
      });

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

    })
  </script>
</body>

</html>