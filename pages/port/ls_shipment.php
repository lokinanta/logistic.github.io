<?php
session_start();

require '../functions.php';

$form = 'List Shipment';
$nik = $_SESSION["nik"];

//Dashboard
$dashboard = '';
$sb_home = '';

// Base Data
$bsd = '';
$add_vendor = '';
$add_barge = '';
$list_vendor = '';

// every champions was once a beginner

// Manage Account
$shp = 'menu-open';
$sb_add_shipment = '';
$sb_list_open_shipment = 'active';

if (isset($_POST["submit"])) {

    // Check apakah status kapal yang akan di input active di Voy-in atau tidak
    $id_vessel = $_POST["vessel"];
    $voy_in = strtoupper($_POST["voy-in"]);

    $cek_vessel =  cek_av_vessel($id_vessel);

    // $dt_vessel = mysqli_query($conn, "SELECT vessel_name AS v_name FROM vessel WHERE id_vessel = '$id_vessel'");
    // $data = mysqli_fetch_assoc($dt_vessel);

    $data = query(2, "SELECT vessel_name AS v_name FROM vessel WHERE id_vessel = '$id_vessel'");
    $data_vssl = $data["v_name"];
    $vssl = $data["v_name"] . " V." . $voy_in;

    if ($cek_vessel == 0) {
        echo "
          <script>
              alert('Data Vessel : " . $data_vssl . " (Masih berstatus aktif)');
          </script>
           ";
        exit;
    } else { // Jika tidak ada vessel yang terdaftar maka..

        // Tarik detail data Kapal

        $pol = strtoupper($_POST["pol"]);

        $td = $_POST["td-pol"];
        $td_pol = date('Y-m-d H:i:s', strtotime("$td"));

        $eta = $_POST["eta-prw"];
        $eta_prw = date('Y-m-d', strtotime("$eta"));

        $vessel_plan = $_POST["vessel-plan"];
        $code = 2; // Code 1 = trucking, Code 2 = Vessel
        $cargo_plan = $_POST["cargo-type"];
        $remark = $_POST["remark"];
        $vsl_active = 1;

        $sql = "INSERT INTO voy_in 
          (id_vessel, id_voy_in, voyage, pol, td_pol, eta_prw, vessel_plan, code, cargo_plan, remark, vsl_act)
          VALUES
          ('$id_vessel',
           '',
           '$voy_in',
           '$pol',
           '$td_pol',
           '$eta_prw',
           '$vessel_plan',
           '$code',
           '$cargo_plan',
           '$remark',
           '$vsl_active'
          )";

        mysqli_query($conn, $sql);

        $action = "Create";
        $desc = "Create Planning Shipment No : [" . $id_vessel . "] " . $vssl;
        $act_by = $_SESSION["full_name"];

        $error_msg = mysqli_error($conn);

        // Check apakah data berhasil ditambahkan atau tidak
        if (mysqli_affected_rows($conn) > 0) {
            historical($form, $action, $desc, $nik, $act_by);
            echo " 
          <script>
              alert('Shipment " . $vssl . " Berhasil di Create.');
          </script>
      ";
        } else {
            echo "
          <script>
              alert('GAGAL di simpan [ $error_msg ] ');
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
                            <h1>Create Shipment In</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Create Shipment</li>
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
                                    <h3 class="card-title">Create Shipment</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">

                                        <!-- Vessel -->
                                        <div class="form-group">
                                            <label for="vessel">Vessel<span class="text-danger">*</span></label>
                                            <select name="vessel" id="vessel" class="form-control shadow-sm select2" style="width: 100%;">
                                                <option value="0" selected disabled>Choose Option..</option>
                                                <?php
                                                $i = 1;
                                                $shipment = query(1, "SELECT * FROM view_shipment WHERE code = 1 AND active = 1 ORDER BY feeder_code ASC");

                                                foreach ($shipment as $row) :
                                                    $vessel = sprintf('%02s', $i)  . ". [" . $row["feeder_code"] . "] - " . $row["type_code"] . ". " . $row["vessel_name"];
                                                ?>
                                                    <option value="<?= $row["id_vessel"] ?>"><?= $vessel; ?></option>
                                                <?php $i++;
                                                endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- [AKhir] Vessel -->


                                        <!-- VOyage in -->
                                        <div class="form-group">
                                            <label for="voy_in">Voyage in<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control shadow-sm" id="nik" placeholder="Enter Voyage IN" name="voy-in" required autocomplete="off">
                                        </div>
                                        <!-- [Akhir] Voyage in -->

                                        <!-- POL -->
                                        <div class="form-group">
                                            <label for="pol">POL<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control shadow-sm" name="pol" id="pol" placeholder="Enter POL" required autocomplete="off">
                                        </div>
                                        <!-- [Akhir] POL -->

                                        <!-- TD POL -->
                                        <div class="form-group">
                                            <label>TD POL<span class="text-danger">*</span></label>
                                            <div class="input-group date" id="td-pol" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#td-pol" />
                                                <div class="input-group-append" data-target="#td-pol" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- [Akhir] POL -->

                                        <!-- ETA Perawang -->
                                        <div class="form-group">
                                            <label>ETA PRW<span class="text-danger">*</span></label>
                                            <div class="input-group date shadow-sm" id="eta-prw" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" name="eta-pol" data-target="#eta-prw">
                                                <div class="input-group-append" data-target="#eta-prw" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- [Akhir] ETA Perawang -->

                                        <!-- Vessel Plan -->
                                        <div class="form-group">
                                            <label for="gender">Vessel Plan<span class="text-danger">*</span></label>
                                            <select name="gender" id="gender" class="form-control shadow-sm">
                                                <option value="0" selected disabled>Choose Option..</option>
                                                <option value="1">1. Bongkar</option>
                                                <option value="2">2. Muat</option>
                                                <option value="3">3. Bongkar & Muat</option>
                                            </select>
                                        </div>
                                        <!-- [Akhir] Vessel Plan -->


                                        <!-- Cargo Plan -->
                                        <div class="form-group">
                                            <label for="cargo-type">Cargo Type<span class="text-danger">*</span></label>
                                            <select name="cargo-type" id="cargo-type" class="form-control shadow-sm select2">
                                                <option value="0" selected disabled>Choose Option..</option>
                                                <option value="1">1. Breakbulk</option>
                                                <option value="2">2. Container</option>
                                                <option value="3">3. Inbulk Cargo</option>
                                            </select>
                                        </div>
                                        <!-- [Akhir] Cargo Plan -->

                                        <!-- Remark -->
                                        <div class="form-group">
                                            <label for="Remark">Remark<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control shadow-sm" id="Remark" placeholder="Enter Remark" name="remark" equired autocomplete="off">
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

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        })
    </script>
</body>

</html>