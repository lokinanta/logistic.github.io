<?php

session_start();

require './functions.php';

$id_member = $_SESSION['id_member'];
$frm_code = 'up_inbound.php'; // Form Code

if (isset($_SESSION['login_member'])) {
    $sidebar = 'pushmenu';
    $link = './logout.php';
    $caption = 'Logout';
} else {
    $sidebar = '';
    $link = './page-login.php';
    $caption = 'Login';
}

$booking_num = decrypt($_GET['bn'], $frm_code);

$sql = mysqli_query($conn, "SELECT * FROM vw_booking WHERE booking_num = '$booking_num' AND id_member = '$id_member' ");

if (mysqli_num_rows($sql) > 0) {
    $data = mysqli_fetch_assoc($sql);
} else {
    echo "
        <script>
            alert('Not Authorized');
        </script>
    ";
}


if (isset($_POST["upload"])) {


    require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
    require('spreadsheet-reader-master/SpreadsheetReader.php');

    //Upload data Excel kedalam folder upload
    $target_dir = "uploads/" . basename($_FILES['data_upload']['name']);

    move_uploaded_file($_FILES['data_upload']['tmp_name'], $target_dir);

    $Reader = new SpreadsheetReader($target_dir);

    $count_reader = count($Reader);
}

?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logistic Perawang</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="./plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="./plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="./plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="./plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="./plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="./plugins/dropzone/min/dropzone.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">
        <?php include './navbar.php';
        include './sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper pt-3">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-gradient-blue">
                            <h3 class="card-title">Booking Number : <?= $booking_num; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row border-bottom mb-3">
                                <h5>DETAIL : </h5>
                            </div>
                            <div class="row justify-content-center pt-2 border-bottom">
                                <div class="col-sm-12 col-md-12 col-lg-8">
                                    <div class="form-group row">
                                        <label for="liner" class="col-sm-2 col-form-label">Liner</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="liner" type="hidden" value="<?= get_liner('name', $data['id_liner']); ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="in_via" class="col-sm-2 col-form-label">In Via</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="in_via" value="<?= $data['in_via']; ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="quantity" value="<?= $data['quantity'] . " x " . get_cont_code($data['id_type_cont'], 'size'); ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="quantity" class="col-sm-2 col-form-label">Laden</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="quantity" value="<?= $data['laden']; ?>" disabled>
                                        </div>
                                    </div>

                                </div>


                            </div>

                            <div class="row justify-content-center pt-4">
                                <div class="col-md-10">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <h6>Select your inbound excel file to upload :</h6>
                                            <div class="input-group">
                                                <input type="file" name="data_upload" class="form-control shadow" id="inputGroupFile04" aria-label="Upload">
                                                <button class="btn btn-outline-secondary bg-primary text-light shadow" type="submit" name="upload">Upload</button>
                                            </div>
                                            <p style="font-size : 12px; padding-top: 5px;">* Only .xls or .xlsx format allowed, maximum file size 500KB.</p>
                                            <p style="font-size : 12px; margin-top: -15px;">* Download Excel file Template <a href="File/Temp_e-inbound.xlsx">Download</a></p>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.content-wrapper -->
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <?php include './footer.php'; ?>

    </div>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./dist/js/demo.js"></script>
</body>

</html>