<?php

session_start();

require './functions.php';

$id_member = $_SESSION['id_member'];

if (isset($_SESSION['login_member'])) {
    $sidebar = 'pushmenu';
    $link = './logout.php';
    $caption = 'Logout';
} else {
    $sidebar = '';
    $link = './page-login.php';
    $caption = 'Login';
}

// $req = query(1, "SELECT * FROM req_inbound WHERE id_member  = '$id_member' ORDER BY create_date");
// $req = query(1, "SELECT * FROM vw_booking_inbound WHERE id_member = '$id_member' ORDER BY create_date");
$req = query(1, "SELECT * FROM vw_booking_inbound WHERE id_member = '$id_member' ORDER BY create_date");
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
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Request Booking Inbound</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-gradient-dark text-center">
                                        <th class="align-middle">No</th>
                                        <th class="align-midlde">Req Date</th>
                                        <th class="align-middle">In Via</th>
                                        <th class="align-middle">Liner</th>
                                        <th class="align-middle text-center">Q</th>
                                        <th class="align-middle">BN</th>
                                        <th class="align-middle">Exp Date</th>
                                        <th class="align-middle">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($req as $row) :

                                        $stat = $row['req_stat'];

                                        if ($stat == 0) {
                                            $remark = "Waiting Confirmation";
                                            $stat = "text-warning";
                                        } else if ($stat == 1) {
                                            $remark = "Accepted";
                                            $stat = "text-success";
                                        } else if ($stat == 2) {
                                            $remark = "Rejected";
                                            $stat =  "text-danger";
                                        }

                                        $exp_date = $row['expired_date'];

                                        if ($exp_date == null) {
                                            $expired_date = '';
                                        } else {
                                            $expired_date = date("d-M", strtotime($row['expired_date']));
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $i; ?></td>
                                            <td class="text-center align-middle"><?= date("d-M", strtotime($row['create_date'])) ?> <br> <?= date("[H:i]", strtotime($row['create_date'])); ?> </td>
                                            <td class="text-center align-middle"><?= $row['in_via']; ?></td>
                                            <td class="align-middle"><?= get_liner('name', $row['id_liner']); ?></td>
                                            <td class="text-center align-middle"><?= $row['quantity'] . " x " . get_cont_code($row['id_type_cont'], 'size'); ?></td>
                                            <td class="text-center align-middle"><a href="./up_inbound.php?bn=<?= encrypt($row['booking_num'], 'semangat'); ?>"><?= $row['booking_num']; ?></a></td>
                                            <td class="text-center align-middle"><?= $expired_date; ?></td>
                                            <td class="text-center align-middle" data-toggle="tooltip" title="<?= $remark; ?>"><i class="fas fa-circle <?= $stat; ?>"></i></td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
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