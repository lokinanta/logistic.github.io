<?php
session_start();

require '../functions.php';

$form = 'Adding Vessel';
$nik = $_SESSION["nik"];

//Dashboard
$dashboard = '';
$sb_home = '';

// Base Data
$bsd = 'menu-open';
$add_vendor = '';
$add_barge = 'active';
$list_vendor = '';

if (isset($_POST["submit"])) {

  $id_vendor = htmlspecialchars($_POST['vendor']);
  $vessel_name = htmlspecialchars(strtoupper($_POST['vessel_name']));

  $query = "SELECT * FROM vessel WHERE id_feeder = '$id_vendor' AND vessel_name = '$vessel_name'";
  $data = mysqli_query($conn, $query);

  if (mysqli_num_rows($data) > 0) {
    echo "
      <script>
        alert('Data sudah pernah di input. Please check');
      </script>
    ";
  } else {
    $id_type = htmlspecialchars($_POST['vessel_type']);
    $vessel_code = htmlspecialchars($_POST['vessel_code']);
    $v_cap_teus = htmlspecialchars($_POST['cap_teus']);
    $v_cap_ton = htmlspecialchars($_POST['cap_ton']);
    $v_length = htmlspecialchars($_POST['length']);
    $v_width = htmlspecialchars($_POST['width']);
    $flag = htmlspecialchars(strtoupper($_POST['flag']));
    $remark = htmlspecialchars($_POST['remark']);

    $sql = "INSERT INTO vessel 
          (id_feeder, id_vessel, vessel_name, vessel_code, id_vessel_type, v_cap_teus, v_cap_ton, v_length, v_width, flag, code, remark)
          VALUES
          ('$id_vendor',
           '',
           '$vessel_name',
           '$vessel_code',
           '$id_type',
           '$v_cap_teus',
           '$v_cap_ton',
           '$v_length',
           '$v_width',
           '$flag',
            1,
           '$remark'
          )";

    mysqli_query($conn, $sql);

    $action = "Add Vessel";
    $desc = "Add id Feeder : [" . $id_vendor . "] Vessel Name : " . $vessel_name;
    $act_by = $_SESSION["full_name"];

    $error_msg = mysqli_error($conn);

    // Check apakah data berhasil ditambahkan atau tidak

    if (mysqli_affected_rows($conn) > 0) {
      historical($form, $action, $desc, $nik, $act_by);
      echo " 
      <script>
          alert('Vessel " . $vessel_name . " berhasil di tambahkan.');
      </script>
  ";
    } else {
      echo "
      <script>
          alert('Data GAGAL di simpan [ $error_msg ] ');
      </script>
  ";
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Shipment</title>

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
              <h1>Adding Vessel</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Adding Vessel</li>
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
                  <h3 class="card-title">Adding Vessel</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post">
                  <div class="card-body">

                    <!-- Vendor -->
                    <div class="form-group">
                      <label for="vendor">Vendor<span class="text-danger">*</span></label>
                      <select name="vendor" id="vendor" class="form-control shadow-sm select2">
                        <option value="0" selected disabled>Choose Option..</option>
                        <?php
                        $i = 1;
                        $feeder = query(1, "SELECT * FROM feeder WHERE trucking <> 1 AND active = 1 ORDER BY feeder_code ASC");

                        foreach ($feeder as $row) :
                          $vendor  = sprintf('%02s', $i)  . ". [" . $row["feeder_code"] . "] - " . $row["feeder_name"];
                        ?>
                          <option value="<?= $row["id_feeder"] ?>"><?= $vendor;  ?></option>
                        <?php $i++;
                        endforeach; ?>
                      </select>
                    </div>
                    <!-- [AKhir] Vendor -->


                    <!-- Vessel Name -->
                    <div class="form-group">
                      <label for="vessel_name">Vessel Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control shadow-sm text-uppercase" id="vessel_name" placeholder="Enter Vessel Name" name="vessel_name" required autocomplete="off">
                    </div>
                    <!-- [Akhir] Vessel Name -->


                    <!-- Vessel Type -->
                    <div class="form-group">
                      <label for="vessel_type">Vessel Type</label>
                      <select name="vessel_type" id="vessel_type" class="form-control shadow-sm">
                        <option value="0" selected disabled>Choose Option..</option>
                        <?php
                        $i = 1;
                        $type = query(1, "SELECT * FROM vessel_type WHERE id_vessel_type > 1 ORDER BY vessel_type ASC");

                        foreach ($type as $row) :
                          $vessel_type = sprintf('%02s', $i) . ". [" . $row['type_code'] . "] - " . $row['vessel_type'];
                        ?>
                          <option value="<?= $row['id_vessel_type']; ?>"><?= $vessel_type; ?></option>
                        <?php
                          $i++;
                        endforeach; ?>
                      </select>
                    </div>
                    <!-- [Akhir] Vessel Type -->


                    <!-- Vessel Code -->
                    <div class="form-group">
                      <label for="vessel_code">Vessel Code<span class="text-danger">*</span></label>
                      <input type="text" class="form-control shadow-sm text-uppercase" id="vessel_code" placeholder="Enter Vessel Code" name="vessel_code" required autocomplete="off" maxlength="5">
                    </div>
                    <!-- [Akhir] Vessel Name -->


                    <!-- Dimensi -->
                    <div class="card card-info shadow-sm">

                      <!-- Card Header -->
                      <div class="card-header">
                        <h3 class="card-title">Dimensi (Meter)</h3>
                      </div>

                      <!-- Card Body -->
                      <div class="card-body">
                        <div class="form-group">
                          <div class="row">

                            <div class="col-md-6">
                              <label for="length">Length</label>
                              <input type="number" class="form-control shadow-sm" id="length" name="length">
                            </div>

                            <!-- Tonnase -->
                            <div class="col-md-6">
                              <label for="width">Width</label>
                              <input type="number" class=" form-control shadow-sm" name="width" id="width">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- [Akhir] Dimensi -->


                    <!-- Capacity -->
                    <div class="card card-info shadow-sm">

                      <!-- Card Header -->
                      <div class="card-header">
                        <h3 class="card-title">Max. Capacity</h3>
                      </div>

                      <!-- Card Body -->
                      <div class="card-body">
                        <div class="form-group">
                          <div class="row">

                            <div class="col-md-6">
                              <label for="cap_teus">Teus</label>
                              <input type="number" class=" form-control shadow-sm" id="cap_teus" name="cap_teus" placeholder="100">
                            </div>

                            <!-- Tonnase -->
                            <div class="col-md-6">
                              <label for="cap_ton">Tonnase</label>
                              <input type="number" class="form-control shadow-sm" name="cap_ton" id="cap_ton" placeholder="1000">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- [Akhir] Capacity -->


                    <!-- Flag -->
                    <div class="form-group">
                      <label for="flag">Flag<span class="text-danger">*</span></label>
                      <input type="text" class="form-control shadow-sm text-uppercase" id="flag" placeholder="Enter Flag" name="flag" required autocomplete="off">
                    </div>
                    <!-- [Akhir] Flag -->


                    <!-- Remark -->
                    <div class="form-group">
                      <label for="Remark">Remark</label>
                      <input type="text" class="form-control shadow-sm" id="Remark" placeholder="Enter Remark" name="remark" autocomplete="off">
                    </div>
                    <!-- [Akhir] Remark -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
  <script src="../../plugins/jquery/jquery.mask.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="../../plugins/select2/js/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="../../plugins/moment/moment.min.js"></script>
  <script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>

  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- dropzonejs -->
  <script src="../../plugins/dropzone/min/dropzone.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Page specific script -->


  <script>
    $(function() {

      //Initialize Select2 Elements
      $('.select2').select2()

    })
  </script>
  <script type="text/javascript">
    $(document).ready(function() {

      // Format mata uang.
      $('.ribuan').mask('000.000.000', {
        reverse: true
      });

    })
  </script>
</body>

</html>