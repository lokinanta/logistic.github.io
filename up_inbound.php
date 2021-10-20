<?php

session_start();

require './functions.php';

$id_member = $_SESSION['id_member'];

$Reader = [];

if (isset($_SESSION['login_member'])) {
    $sidebar = 'pushmenu';
    $link = './logout.php';
    $caption = 'Logout';
} else {
    $sidebar = '';
    $link = './page-login.php';
    $caption = 'Login';
}

$frm_code = 'semangat'; // Form Code
$booking_num = decrypt($_GET['bn'], $frm_code);

$sql = mysqli_query($conn, "SELECT * FROM vw_booking_inbound WHERE booking_num = '$booking_num' AND id_member = '$id_member' ");

if (mysqli_num_rows($sql) > 0) {
    $data = mysqli_fetch_assoc($sql);
    $jlh_req_data = $data['quantity'];
    // $temp_inbound = mysqli_query($conn, "SELECT * FROM temp_inbound WHERE id_booking = '$booking_num'");

    $sql_cek = "SELECT COUNT(id_booking) as result FROM temp_inbound WHERE id_booking ='$booking_num'";

    $result = query(2, $sql_cek);

    if ($result['result'] == 0) {
        $temp_inbound = [];
    } else {
        $temp_inbound = query(1, "SELECT * FROM temp_inbound WHERE id_booking = '$booking_num' ORDER BY seq ASC");
    }
} else {
    echo "
        <script>
            alert('Not Authorized');
        </script>
    ";
    exit;
}


// if (isset($_POST["upload"])) {

//     require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
//     require('spreadsheet-reader-master/SpreadsheetReader.php');

//     //Upload data Excel kedalam folder upload
//     $target_dir = "uploads/" . basename($_FILES['data_upload']['name']);

//     move_uploaded_file($_FILES['data_upload']['tmp_name'], $target_dir);

//     $Reader = new SpreadsheetReader($target_dir);

//     $i = 1;
//     foreach ($Reader as $key => $Row) {
//         // import data excel mulai baris ke-2 (karena ada header pada baris 1)
//         if ($key < 1) continue;

//         $cont_no = $Row[0];
//         $laden = $Row[1];
//         $soc = $Row[2];
//         $cond = $Row[3];
//         $remark = $Row[4];

//         // CHECKING DATA

//         $chk_data = cek_data_inbound($cont_no, $laden, $soc, $cond);

//         if ($chk_data == true) {
//             $status = 'Correct Format';
//             $stat = 0;
//         } else {
//             $status = 'Wrong Format';
//             $stat = 1;
//         }

//         $sql = "INSERT INTO temp_inbound ('id_booking', 'seq', 'cont_no', 'laden', 'soc', 'condition', 'remark', 'stat' )
//                             VALUES 
//                                 ('$booking_num',
//                                  '$i',
//                                  '$cont_no',
//                                  '$laden',
//                                  '$soc',
//                                  '$cond',
//                                  '$remark',
//                                  '$stat' 
//                                 )";
//         $query = mysqli_query($conn, $sql);

//         if ($i == $jlh_req_data) {
//             exit;
//         }
//         $i++;
//     }
// }

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
                                    <form action="./import-excel.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <h6>Select your inbound excel file to upload :</h6>
                                            <div class="input-group">
                                                <input type="file" name="data_upload" class="form-control shadow" id="inputGroupFile04" aria-label="Upload">
                                                <button class="btn btn-outline-secondary bg-primary text-light shadow" type="submit" name="upload" value="upload">Upload</button>
                                            </div>
                                            <p style="font-size : 12px; padding-top: 5px;">* Only .xls or .xlsx format allowed, maximum file size 500KB.</p>
                                            <p style="font-size : 12px; margin-top: -15px;">* Download Excel file Template <a href="File/Temp_e-inbound.xlsx">Download</a></p>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            <section id="cntr_table col-md-6">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="bg-gradient-dark text-center">
                                            <th class="align-middle">No</th>
                                            <th class="align-middle">Cont No</th>
                                            <th class="align-middle">Laden</th>
                                            <th class="align-middle">SOC</th>
                                            <th class="align-middle">Cont<br>Stat</th>
                                            <th class="align-middle">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($temp_inbound as $data) :

                                            if ($data['stat'] == 0) {
                                                $stat_class = "fas fa-check-circle";
                                                $stat_color = "bg_success";
                                                $stat_caption = "Available";
                                            } else {
                                                $stat_class = "fas fa-times-circle";
                                                $stat_color = "bg-danger";
                                                $stat_caption = "Wrong Format";
                                            }

                                            $cond = $data['condition'];
                                            if ($cond == 'GD') {
                                                $bg_cond = 'bg-success';
                                                $title_cond = 'Good';
                                            } else if ($cond == 'CL') {
                                                $bg_cond = 'bg-warning';
                                                $title_cond = 'Cleaning';
                                            } else if ($cond == 'DM') {
                                                $bg_cond = 'bg-danger';
                                                $title_cond = 'Damage';
                                            } else {
                                                $bg_cond = 'bg-dark';
                                                $title_cond = 'Error';
                                            }
                                        ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $data['seq']; ?></td>
                                                <td class="align-middle text-center"><?= $data['cont_no']; ?></td>
                                                <td class="align-middle text-center"><?= $data['laden']; ?></td>
                                                <td class="align-middle text-center"><?= $data['soc']; ?></td>
                                                <td class="align-middle text-center <?= $bg_cond; ?>" title="<?= $title_cond; ?>"><?= $data['condition']; ?></td>
                                                <td class="align-middle text-success text-center <?= $stat_color ?>"><i class="<?= $stat_class ?>">
                                                        <?= $stat_caption; ?>
                                                    </i>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>

                                    </tbody>



                                </table>
                            </section>


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