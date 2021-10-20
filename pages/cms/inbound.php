<?php

session_start();

require '../functions.php';

$inbound_data = query(1, 'SELECT * FROM vw_booking_inbound');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS</title>

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

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include './cms_navbar.php';
        include './cms_sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Inbound Container List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Inbound Container</li>
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
                                    <h3 class="card-title">Inbound Container</h3>
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
                                                    <th class="align-middle text-center">No</th>
                                                    <th class="align-middle text-center">User ID</th>
                                                    <th class="align-middle text-center">In Via</th>
                                                    <th class="align-middle text-center">Liner</th>
                                                    <th class="align-middle text-center" title="Quantity">Q</th>
                                                    <th class="align-middle text-center" title="Laden or Empty">L/E</th>
                                                    <th class="align-middle text-center">Req <br> Date</th>
                                                    <th class="align-middle text-center" title="Booking Number">Booking No.</th>
                                                    <th class="align-middle text-center">Stat</th>
                                                    <th class="align-middle text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($inbound_data as $row) :

                                                    $member = get_data_member($row['id_member'], 11);

                                                ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?= $i; ?></td>
                                                        <td class="align-middle text-center"><?= $member['user_id']; ?></td>
                                                        <td class="align-middle text-center"><?= $row['in_via']; ?></td>
                                                        <td class="align-middle text-center" title="<?= cek_sliner('nama', $row['id_liner']); ?>"><?= cek_sliner('nick', $row['id_liner']); ?></td>
                                                        <td class="align-middle text-center"><?= $row['quantity'] . "x" . get_cont_code($row['id_type_cont'], 'size'); ?></td>
                                                        <td class="align-middle text-center"><?= $row['laden']; ?></td>
                                                        <td class="text-center align-middle"><?= date("d-M", strtotime($row["create_date"])); ?> <br> <?= date("[H:i]", strtotime($row["create_date"])); ?></td>
                                                        <td class="align-middle text-center"><a href=""><?= $row['booking_num']; ?> </a></td>
                                                        <td class="text-center align-middle">Stat</td>

                                                        <!-- <td class="text-center align-middle" data-toggle="tooltip" title="<?= $remark; ?>"><i class="fas fa-circle <?= $stat; ?>"></i></td> -->
                                                        <td class="text-center align-middle">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default">
                                                                    <a href="./det_inbound.php?inb=<?= encrypt($row['id_req_booking'], 'Robin Lokinanta') ?>">
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
                <b>Version</b> 1.0.1
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
    <script src="./script_member.js"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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