<?php
session_start();

require '../functions.php';

$dashboard = '';
$mng_acc = 'menu-open';

$form = 'Add User';
$sb_add_user = 'active';
$sb_list_user = '';
$sb_home = '';

if (isset($_POST["submit"])) {

  // Check user id apakah sudah pernah terdaftar>

  $user_id = htmlspecialchars($_POST["user_id"]);
  $id_sap = htmlspecialchars($_POST["id_sap"]);
  $nik = htmlspecialchars($_POST["nik"]);

  $cek = cek_admin_id($user_id, $id_sap, $nik);

  if ($cek <> 1) {
    echo "
    <script>
        alert('$cek');
    </script>";
  } else {
    $now = date('Y-m-d H:i:s', strtotime("now"));
    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $email = htmlspecialchars($_POST["email"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $level = htmlspecialchars($_POST["level"]);
    $bd = $_POST["birth_date"];
    $birth_date = date('Y-m-d', strtotime($bd));
    $birth_place = htmlspecialchars($_POST["birth_place"]);
    $pass = password_hash($nik, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user_admin 
                       (id_user,
                        user_id,
                        id_sap,
                        nik,
                        first_name, 
                        last_name,
                        email,
                        pass,
                        birth_place,
                        birth_date,
                        gender, 
                        level,
                        aktif,
                        created_date)
                      VALUES (
                        '',
                        '$user_id',
                        '$id_sap',
                        '$nik',
                        '$first_name',
                        '$last_name',
                        '$email',
                        '$pass',
                        '$birth_place',
                        '$birth_date',
                        '$gender',
                        '$level',
                         0,
                         '$now'
                      )";

    mysqli_query($conn, $sql);

    $error_msg = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
      // historical($form, $action, $desc, $nik, $act_by);
      echo " 
      <script>
          alert('User id : $user_id berhasil di create');
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
  <title>Add User ID</title>

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
    <?php include './user_navbar.php';
    include './user_sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add User</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add User</li>
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
                  <h3 class="card-title">Input User Data</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST">
                  <div class="card-body">

                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-6">
                          <label for="first_name">First Name</label>
                          <input type="text" class="form-control shadow-sm" id="first_name" placeholder="Enter First name" name="first_name" required autocomplete="off">
                        </div>
                        <div class="col-lg-6">
                          <label for="last_name">Last Name</label>
                          <input type="text" class="form-control shadow-sm" id="last_name" placeholder="Enter Last name" name="last_name" required autocomplete="off">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-6">
                          <label for="nik">NIK</label>
                          <input type="number" class="form-control shadow-sm" id="nik" placeholder="Enter NIK" name="nik" required autocomplete="off">
                        </div>

                        <div class="col-lg-6">
                          <label for="id_sap">ID SAP</label>
                          <input type="number" class="form-control shadow-sm" id="id_sap" placeholder="Enter ID SAP" name="id_sap" required autocomplete="off">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="user_id">User ID</label>
                      <input type="text" class="form-control shadow-sm" name="user_id" id="user_id" placeholder="Enter User ID" required autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control shadow-sm" id="email" placeholder="Enter Email" name="email" required autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label for="birth_place">Birth Place</label>
                      <input type="text" class="form-control shadow-sm" name="birth_place" id="birth_place" placeholder="Enter Birth Place" required autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label>Birth date</label>
                      <div class="input-group date shadow-sm" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="birth_date" data-target="#reservationdate" />
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="gender">Gender</label>
                      <select name="gender" id="gender" class="form-control shadow-sm">
                        <option value="0" selected disabled>Choose Option..</option>
                        <option value="Male">Male (Pria)</option>
                        <option value="Female">Female (Wanita)</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="level">Level</label>
                      <input type="number" class="form-control shadow-sm" id="level" placeholder="Enter level" name="level" equired autocomplete="off">
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