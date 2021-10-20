<?php

session_start();

require '../functions.php';

$form = 'Detail Inbound';
$nik = $_SESSION["nik"];

// Base Data
$bsd = 'menu-open';
$add_vendor = 'active';

$id_req_booking = decrypt($_GET['inb'], 'Robin Lokinanta');

$sql_det = query(2, "SELECT * FROM vw_booking_inbound WHERE id_req_booking = '$id_req_booking'");

$id_member = $sql_det['id_member'];

$sql_member = query(2, "SELECT * FROM user_member WHERE id_member = '$id_member'");

$user_id_member = $sql_member['user_id'] . " - [" . $sql_member['first_name'] . " " . $sql_member['last_name'] . "]";

$stat_laden = $sql_det['laden'];

if ($stat_laden == 'E') {
    $stat_laden = "Empty";
} else if ($stat_laden == 'L') {
    $stat_laden = "Laden";
}

$booking_number = $sql_det['booking_num'];
if ($booking_number == null) {
    $btn_create = '';
} else {
    $btn_create = 'display:none;';
}

$valid_date = $sql_det['valid_date'];

if ($valid_date == null) {
    $valid_date = '';
} else {
    $valid_date = date("d M Y - [H:i]", strtotime($sql_det['valid_date']));
}

$expired_date = $sql_det['expired_date'];

if ($expired_date == null) {
    $expired_date = '';
} else {
    $expired_date = date("d M Y", strtotime($sql_det['expired_date']));
}


// Create Booking Number

if (isset($_POST['create_booking'])) {

    $id_req_booking = $sql_det['id_req_booking'];
    $booking_num = cr_new_inbound('Trucking');
    $valid_date = date('Y-m-d H:i:s', server_date_time());
    $create_by = $_SESSION['full_name'];
    $exp_date = date('Y-m-d', strtotime('+1 week'));
    $booking_remark = $_POST['remark'];
    $booking_stat = 4;

    $sql_booking = "INSERT INTO booking (id_booking, id_req_booking, booking_num, valid_date, create_by, expired_date, booking_remark, booking_stat)
                    VALUES ('',
                            '$id_req_booking',
                            '$booking_num',
                            '$valid_date',
                            '$create_by',
                            '$exp_date',
                            '$booking_remark',
                            '$booking_stat'
                        ) ";
    mysqli_query($conn, $sql_booking);

    $action = "Create Booking Number";
    $desc = "Create Booking Number : " . $id_req_booking;
    $act_by = $_SESSION['full_name'];

    $error_msg = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
        historical($form, $action, $desc, $nik, $act_by);
        echo "
        <script>
            alert('Booking Number has been Created');
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Gagal di Simpan[$error_msg]');
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
    <title>CMS-Detail Inbound</title>

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
        <?php include './cms_navbar.php';
        include './cms_sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Detail Booking</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Detail Inbound</li>
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
                                    <h3 class="card-title">Inbound ID : <?= $id_req_booking; ?></h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Request By</label>
                                            <div class="col-sm-8">
                                                <label class="form-control text-primary"><?= $user_id_member; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">In Via</label>
                                            <div class="col-sm-8">
                                                <label class="form-control text-primary"><?= $sql_det['in_via']; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Shipping Liner</label>
                                            <div class="col-sm-8">
                                                <label class="form-control text-primary"><?= cek_sliner('nama', $sql_det['id_liner']); ?></label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-4">
                                                <label for="">Quantity</label>
                                                <label class="form-control text-primary"><?= $sql_det['quantity'] . "x" . get_cont_code($sql_det['id_type_cont'], 'size'); ?></label>
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="">Laden</label>
                                                <label class="form-control text-primary"><?= $stat_laden; ?></label>
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="">Request Date</label>
                                                <label class="form-control text-primary"><?= date("d M Y - [H:i]", strtotime($sql_det['create_date'])); ?></label>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Booking Number</label>
                                            <div class="col-sm-8">
                                                <label class="form-control text-primary"><?= $sql_det['booking_num']; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Valid Date</label>
                                            <div class="col-sm-8">
                                                <label class="form-control text-primary"><?= $valid_date ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Expired Date</label>
                                            <div class="col-sm-8">
                                                <label class="form-control text-primary"><?= $expired_date; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Remark</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control text-primary" name="remark"><?= $sql_det['booking_remark']; ?></input>
                                            </div>
                                        </div>


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-success" name="create_booking" style=<?= $btn_create ?>>Create Booking Number</button>
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