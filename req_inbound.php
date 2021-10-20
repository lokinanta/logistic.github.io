<?php

session_start();

require './functions.php';

$form = 'Request Inbound';
$nik = $_SESSION['user_id'];
$id_member = $_SESSION['id_member'];

if (isset($_SESSION['login_member'])) {
    $sidebar = 'pushmenu';
    $link = './logout.php';
    $caption = 'Logout';
} else {
    $sidebar = 'active';
    $link = './page-login.php';
    $caption = 'Login';
}

$t_inbound = 'menu-open';
$sb_req_inbound = 'active';

if (isset($_POST['post_req'])) {

    $in_via = 'Trucking';
    $id_liner = $_POST['shipping_liner'];
    $booking_num = cr_new_inbound($in_via);
    $quantity = $_POST['quantity'];
    $id_type_cont = $_POST['cont_size'];
    $remark = $_POST['remark'];
    $status = 1; //Stat = 1 () Req inbound has been created, Waiting Confirmation)
    $create_date = date('Y-m-d H:i:s', server_date_time());
    $laden = $_POST['laden'];

    $sql = "INSERT INTO booking_inbound 
                        (id_booking, 
                         req_booking_num,
                         request_by,
                         in_via,
                         id_liner, 
                         quantity,
                         laden, 
                         id_type_cont,
                         req_remark,
                         stat,
                         create_date)
            VALUES ('',
                    '$booking_num',
                    '$id_member',
                    '$in_via',
                    '$id_liner',
                    '$quantity',
                    '$laden',
                    '$id_type_cont',
                    '$remark',
                    '$stat',
                    '$create_date' )";

    // $sql = "INSERT INTO req_inbound 
    //                     (id_req_booking, 
    //                      booking_num,
    //                      id_member, 
    //                      in_via, 
    //                      id_liner, 
    //                      quantity, 
    //                      id_type_cont, 
    //                      req_remark, 
    //                      req_stat, 
    //                      create_date, 
    //                      laden) 
    //             VALUES ('',
    //                     '$id_member',
    //                     '$in_via',
    //                     '$id_liner',
    //                     '$quantity',
    //                     '$id_type_cont',
    //                     '$remark',
    //                     '$status',
    //                     '$create_date',
    //                     '$laden'
    //                    )";

    mysqli_query($conn, $sql);

    $action = "Request Booking Inbound";
    $desc = "Create Req Booking Inbound " . get_liner('nick', $id_liner) . ', Q: ' . $quantity . ' x ' . get_cont_code($id_type_cont, 'size');
    $act_by = $_SESSION["full_name"];

    $error_msg = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
        historical($form, $action, $desc, $nik, $act_by);
        echo " 
        <script>
            alert('Request booking Berhasil di Create.');
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
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Request Inbound Trucking</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <!-- left column -->
                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="card card-primary shadow">
                                <div class="card-header">
                                    <h3 class="card-title">Request Booking Inbound</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">

                                        <!-- in_via -->
                                        <div class="form-group">
                                            <label for="in_via">In Via</label>
                                            <select name="in_via" id="in_via" class="form-control shadow-sm" disabled>
                                                <option value="0" disabled>Choose Option..</option>
                                                <option value="Trucking" selected>1. Trucking</option>
                                            </select>
                                        </div>
                                        <!-- [AKhir] in_via -->

                                        <div class="form-group">
                                            <label for="s_liner">Shipping Liner</label>
                                            <select name="shipping_liner" id="s_liner" class="form-control shadow-sm">
                                                <option value="0" selected disabled>Choose Option..</option>

                                                <?php
                                                $i = 1;
                                                $liner = query(1, "SELECT * FROM vw_member_liner WHERE id_member = '$id_member' ORDER BY liner_name");

                                                foreach ($liner as $sl) :
                                                    $data = sprintf('%02s', $i) . '. ' . $sl['liner_name'];
                                                ?>
                                                    <option value="<?= $sl['id_liner']; ?>"><?= $data; ?></option>
                                                <?php $i++;
                                                endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Quantity -->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="number" class="form-control shadow-sm" name="quantity" id="quantity" min="1" placeholder="Enter Quantity" required autocomplete="off">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="laden">Laden</label>
                                                    <select name="laden" id="laden" class="form-control shadow-sm">
                                                        <option value="0" selected disabled>Choose Option..</option>
                                                        <option value="L">Laden</option>
                                                        <option value="E">Empty</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="cont_size">Cont Size</label>
                                                    <select name="cont_size" id="cont_size" class="form-control shadow-sm">
                                                        <option value="0" selected disabled>Choose Option..</option>

                                                        <?php
                                                        $cont_size = query(1, "SELECT * FROM cont_type WHERE aktif = 1 ORDER BY cont_code");

                                                        foreach ($cont_size as $ct) :
                                                        ?>
                                                            <option value="<?= $ct['id_type_cont'] ?>">[<?= $ct['iso_code']; ?>] - <?= $ct['cont_code']; ?></option>
                                                        <?php $i++;
                                                        endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- [Akhir] Quantity -->

                                        <!-- Remark -->
                                        <div class="form-group">
                                            <label for="Remark">Remark<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control shadow-sm" id="Remark" placeholder="Enter Remark" name="remark" equired autocomplete="off">
                                        </div>
                                        <!-- [Akhir] Remark -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" name="post_req">Post Request</button>
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

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <?php include './footer.php'; ?>
    </div>
    <!-- ./wrapper -->

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