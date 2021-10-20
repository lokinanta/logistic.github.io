<?php
session_start();

require '../functions.php';

$form = 'List Request Booking Trucking';

//Dashboard
$dashboard = 'menu-open';
$sb_home = 'active';

$data = query(1, "SELECT * FROM vw_req_booking_trucking WHERE stat >= 0");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS [Dashboard]</title>

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
                            <h1>Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./in_cms.php">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
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
                                                    <th class="align-middle">Req By</th>
                                                    <th class="align-middle">Req Date</th>
                                                    <th class="align-middle">Shipping Liner</th>
                                                    <th class="align-middle">Quantity</th>
                                                    <th class="align-middle">Laden</th>
                                                    <!-- <th class="align-middle">Remark</th> -->
                                                    <th class="align-middle">Stat</th>
                                                    <th class="align-middle">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($data as $row) :

                                                    $sliner = cek_sliner('nama', $row['id_liner']);
                                                    $size_cont = get_cont_code($row['id_type_cont'], 'size');
                                                    $date = $row['create_date'];
                                                    $req_date = date('d-M', strtotime("$date"));
                                                    $req_time = date('[H:i]', strtotime($date));

                                                ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?= $i; ?></td>
                                                        <td class="text-center align-middle"><?= $row['user_id']; ?></td>
                                                        <td class="text-center align-middle"><?= $req_date; ?> <br> <?= $req_time; ?></td>
                                                        <td class="align-middle"><?= $sliner; ?></td>
                                                        <td class="text-center align-middle"><?= $row['quantity'] . " x " . $size_cont ?></td>
                                                        <td class="text-center align-middle"><?= $row['laden']; ?></td>
                                                        <!-- <td class="align-middle"><?= $row['remark']; ?></td> -->
                                                        <td class="align-middle"><?= $row['stat']; ?></td>
                                                        <!-- <td class="text-center align-middle" data-toggle="tooltip" title="<?= $remark; ?>"><i class="fas fa-circle <?= $stat; ?>"></i></td> -->
                                                        <td class="text-center align-middle">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default">
                                                                    <a href="./det_member.php?userid=<?= $row['user_id'] ?>">
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