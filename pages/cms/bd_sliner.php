<?php
session_start();

require '../functions.php';

$form = 'Dashboard';

$query = query(1, "SELECT * FROM liner ORDER BY liner_nick ASC");

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
                                <li class="breadcrumb-item"><a href="#">Based Data</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid" style="border: 2px solid red">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="liner_nick">Liner Nick</label>
                                    <input type="text" class="form-control shadow-sm" id="liner_nick" placeholder="Enter Shipping Liner Nick" name="liner_nick" required autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="liner_name">Liner Name</label>
                                    <input type="text" class="form-control shadow-sm" id="liner_name" placeholder="Enter Shipping Liner Name" name="liner_name" required autocomplete="off">
                                </div>

                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>

                            </form>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-4">
                        <div class="col-md-8">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-gradient-dark text-center">
                                        <th class="align-middle">No</th>
                                        <th class="align-middle">Liner Nick</th>
                                        <th class="align-middle">Liner Name</th>
                                        <th class="align-middle">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($query as $row) :
                                    ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $i; ?></td>
                                            <td class=" text-center align-middle"><?= $row['liner_nick']; ?></td>
                                            <td class="align-middle"><?= $row['liner_name']; ?></td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default">
                                                        <a href="./det_member.php?userid=<?= $row['id_liner'] ?>">
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

                    <div class="row justify-content-center">
                        <!-- left column -->

                        <div class="col-lg-6" style="border: 1px solid green;">
                            <h1>TEST</h1>
                        </div>

                        <div class="col-lg-6" style="border: 1px solid blue;">
                            <h1>TEST 2</h1>
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