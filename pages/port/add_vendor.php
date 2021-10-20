<?php

session_start();

require '../../functions.php';

$form = 'Adding Vendor';
$nik = $_SESSION["nik"];

// Base Data
$bsd = 'menu-open';
$add_vendor = 'active';


if (isset($_POST['submit'])) {

    $feeder_name = htmlspecialchars(strtoupper($_POST['feeder_name']));
    $feeder_code = htmlspecialchars(strtoupper($_POST['feeder_code']));

    // Cek Feeder Name dan Feeder Code, apakah sudah pernah di input sebelumnya?
    $sql = "SELECT * FROM feeder WHERE feeder_name = '$feeder_name' OR feeder_code = '$feeder_code'";

    $exc_sql = mysqli_query($conn, $sql);

    if (mysqli_num_rows($exc_sql) > 0) {
        echo "
            <script>
                alert('Feeder name atau Feeder Code sudah pernah digunakan. Please check..');
            </script>
             ";
    } else {  // Jika data nya tidak ada, langsung execute insert into database

        $feeder_address = htmlspecialchars($_POST['address']);

        $sql = "INSERT INTO feeder (id_feeder, feeder_name, feeder_code, trucking, feeder_address, active)
                VALUES (
                        '',
                        '$feeder_name',
                        '$feeder_code',
                        0,
                        '$feeder_address',
                        1
                        )";

        mysqli_query($conn, $sql);

        $action = "Create NEW Feeder";
        $desc = "Addding Feeder : [" . $feeder_code . "] " . $feeder_name;
        $act_by = $_SESSION['full_name'];

        $error_msg = mysqli_error($conn);

        // Check apakah data berhasil ditambahkan atau tidak
        if (mysqli_affected_rows($conn) > 0) {
            historical($form, $action, $desc, $nik, $act_by);
            echo " 
            <script>
                alert('Vendor " . $feeder_name . " Berhasil di tambahkan.');
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
    <title>Add Vendor</title>

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
                            <h1>Add Vendor</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add Vendor</li>
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
                                    <h3 class="card-title">Add Vendor</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="feeder_name">Feeder Name</label>
                                            <input type="text" class="form-control shadow-sm text-uppercase" name="feeder_name" id="feeder_name" placeholder="Enter Feeder Full Name" required autocomplete="off">
                                        </div>

                                        <div class="form-group">
                                            <label for="feeder_name">Feeder Code</label>
                                            <input type="text" class="form-control shadow-sm text-uppercase" name="feeder_code" id="feeder_code" placeholder="Enter Feeder Code" maxlength="4" required autocomplete="off">
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control shadow-sm" name="address" id="address" placeholder="Enter Address" required autocomplete="off">
                                        </div>


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

    <!-- dropzonejs -->
    <script src="../../plugins/dropzone/min/dropzone.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'DD-MMM-YYYY'
            });
        })
    </script>
</body>

</html>