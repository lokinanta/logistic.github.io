<?php

session_start();

if (isset($_SESSION["login_admin"])) {
  header("Location: ../index.html");
  exit;
} else if (isset($_SESSION["login_member"])) {
  header("Location: ../index.html");
  exit;
}

require 'functions.php';

$form = "Page-Login";

// Login ada 2 Tahap
if (isset($_POST["sign-in"])) {

  $method = $_POST["method"];
  $user_id = $_POST["user_id"];
  $pass = $_POST["password"];

  if ($method == 0) {
    echo "
            <script>
                alert ('Method belum di input, Please check..');
            </script>
        ";
  } else if ($method == 1 or $method == 2) {
    $hsl_cek = cek_id($user_id, $pass, $method);

    if ($hsl_cek == 11) {  // 11 = kode member
      $data = get_data_member($user_id, $hsl_cek);

      // Copy data to Session.
      $_SESSION["login_member"] = true;
      $_SESSION["id_member"] = $data["id_member"];
      $_SESSION["user_id"] = $data["user_id"];
      $_SESSION["email"] = $data["email"];
      $_SESSION["pass"] = $data["pass"];
      $_SESSION["full_name"] = $data["first_name"] . " " . " " . $data["last_name"];
      $_SESSION["phone"] = $data["phone"];
      $_SESSION["company"] = $data["company"];
      $_SESSION["comp_tipe"] = $data["comp_tipe"];
      $_SESSION["alamat"] = $data["alamat"];
      $_SESSION["city"] = $data["city"];
      $_SESSION["kode_pos"] = $data["postal_code"];
      $_SESSION["aktif"] = $data["aktif"];
      $_SESSION["initial"] = substr($data["first_name"], 0, 1) . substr($data["last_name"], 0, 1);

      $action = "Login Member";
      $desc = "User Member Login [" . $_SESSION["user_id"] . "]";
      $nik = $data["user_id"];
      $act_by = $_SESSION["full_name"];

      historical($form, $action, $desc, $nik, $act_by);

      header("Location:../index.html");
      exit;
    } else if ($hsl_cek == 21) { // 21 = kode admin
      $data = get_data_member($user_id, $hsl_cek);

      // Copy data to Session
      $_SESSION["login_admin"] = true;
      $_SESSION["id_user"] = $data["id_user"];
      $_SESSION["id_sap"] = $data["id_sap"];
      $_SESSION["nik"] = $data["nik"];
      $_SESSION["name"] = $data["name"];
      $_SESSION["email"] = $data["email"];
      $_SESSION["pass"] = $data["pass"];
      $_SESSION["gender"] = $data["gender"];
      $_SESSION["level"] = $data["level"];
      $_SESSION["aktif"] = $data["aktif"];
      $_SESSION["foto"] = $data["foto"];
      $_SESSION["full_name"] = $data["first_name"] . " " . $data["last_name"];
      $_SESSION["initial"] = substr($data["first_name"], 0, 1) . substr($data["last_name"], 0, 1);

      $action = "Login Admin";
      $desc = "User Admin login [" . $_SESSION["id_sap"] . "]";
      $nik = $data["id_sap"];
      $act_by = $_SESSION["full_name"];

      historical($form, $action, $desc, $nik, $act_by);

      header("Location:cr_shipment.php");
      exit;
    } else if ($hsl_cek == 0) {
      echo $hsl_cek;
      echo "
            <script>
                alert('Data not Valid');
            </script>
            ";
    } else if ($hsl_cek == "Data not found") {
      echo "
            <script>
                alert('Data not found');
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
  <title>Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box shadow-sm">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../index.php" class="h1"><b>LOGISTIC</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <select name="method" id="login" class="form-control">
              <option value="0">Choose Option..</option>
              <option value="1">MEMBER</option>
              <option value="2">ADMIN</option>
            </select>
          </div>

          <div class="input-group mb-3">
            <input type="email" class="form-control" name="user_id" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <p class="mb-0">
                <a href="register.html" class="text-center">Register a new member</a>
              </p>
            </div>
            <!-- <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div> -->
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="sign-in" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p> -->

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>