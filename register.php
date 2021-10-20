<?php

require './functions.php';


if (isset($_POST['regis'])) {

  // Collect data
  $user_id = strtoupper(htmlspecialchars($_POST['user_id']));
  $email = htmlspecialchars($_POST['email']);
  $pass = htmlspecialchars($_POST['pass']);
  $re_pass = htmlspecialchars($_POST['re-pass']);
  $first_name = htmlspecialchars($_POST['first_name']);
  $last_name = htmlspecialchars($_POST['last_name']);
  $phone = htmlspecialchars($_POST['phone']);
  $company = htmlspecialchars($_POST['company_name']);
  $comp_type = htmlspecialchars($_POST['comp_type']);
  $address = htmlspecialchars($_POST['address']);
  $city = htmlspecialchars($_POST['city']);
  $kode_pos = htmlspecialchars($_POST['postal_code']);

  // Cek
  if ($pass <> $re_pass) {
    echo "
        <script>
            alert('Data Password tidak sama');
        </script>
      ";
    die;
  } else {
    // Chek id member 
    if (!cek_id_member($user_id, $email, $phone)) {
      echo "
            <script>
                alert('User ID or Email or Phone Number been registered');
            </script>
            ";
      die;
    } else {

      $password = password_hash($pass, PASSWORD_DEFAULT);
      $create_date = date('Y-m-d H:i:s', server_date_time());

      $sql = "INSERT INTO user_member 
                      ( id_member, 
                        user_id, 
                        email, 
                        pass,
                        first_name,
                        last_name, 
                        phone, 
                        company, 
                        comp_tipe,
                        alamat, 
                        city,
                        postal_code,
                        aktif,
                        create_date
                      ) VALUES (
                        '',
                        '$user_id',
                        '$email',
                        '$password',
                        '$first_name',
                        '$last_name',
                        '$phone',
                        '$company',
                        '$comp_type',
                        '$address',
                        '$city',
                        '$kode_pos',
                        0,
                        '$create_date'
                      )";


      mysqli_query($conn, $sql);

      $error_msg = mysqli_error($conn);
      $user_id = strtoupper($user_id);

      if (mysqli_affected_rows($conn) > 0) {
        echo " 
        <script>
            alert('member id : $user_id berhasil di create, Please contact our Admin to activation');
        </script>
           ";
        header("Location:./page-login.php");
        exit;
      } else {
        echo "
      <script>
          alert('GAGAL di simpan [ $error_msg ] ');
      </script>   
          ";
      }
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Logistic Team | Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
  <div class="register-box shadow-sm">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="./index.php" class="h1"><b>Logistic</b> Team</a>
      </div>
      <div class="card-body">
        <!-- <p class="login-box-msg">Register a new membership</p> -->

        <form action="" method="post">

          <!-- User ID -->
          <div class="input-group mb-3 shadow-sm">
            <input type="text" class="form-control" placeholder="User ID" name="user_id" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-users"></span>
              </div>
            </div>
          </div>
          <!-- [Akhir] User ID -->

          <!-- email -->
          <div class="input-group mb-3 shadow-sm">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <!-- [akhir] Email -->

          <!-- Password -->
          <div class="input-group mb-3 shadow-sm">
            <input type="password" class="form-control" placeholder="Password" name="pass" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <!-- [Akhir] Password -->

          <!-- reconfirm Password -->
          <div class="input-group mb-3 shadow-sm">
            <input type="password" class="form-control" placeholder="Retype password" name="re-pass" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <!-- [akhir] reconfirm Password -->

          <!-- full Name -->
          <div class="input-group mb-3 shadow-sm">
            <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
            <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <!-- [Akhir] full Name -->

          <!-- Phone -->
          <div class="input-group mb-3 shadow-sm">
            <input type="text" class="form-control" placeholder="Phone Number" name="phone" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
          </div>
          <!-- [akhir] Phone -->

          <!-- Company -->
          <div class="input-group mb-3 shadow-sm">
            <input type="text" class="form-control" placeholder="Company Name" name="company_name" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="far fa-building"></span>
              </div>
            </div>
          </div>
          <!-- [Akhir] Company -->

          <!-- Comp Type -->
          <div class="input-group mb-3 shadow-sm">
            <!-- <input type="text" class="form-control" placeholder="Company Name" name="company_name"> -->
            <select name="comp_type" id="" class="form-control">
              <option value="0" selected disabled>Choose Option..</option>
              <option value="AGENCY">AGENCY</option>
              <option value="EMKL">EMKL</option>
              <option value="SHIPPING LINER">SHIPPING LINER</option>
            </select>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="far fa-building"></span>
              </div>
            </div>
          </div>
          <!-- [Akhir] Comp Type -->

          <!-- Address -->
          <div class="input-group mb-3 shadow-sm">
            <input type="text" class="form-control" placeholder="Address" name="address" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-address-card"></span>
              </div>
            </div>
          </div>
          <!-- [Akhir] Address -->

          <!-- City -->
          <div class="input-group mb-3 shadow-sm">
            <input type="text" class="form-control" placeholder="City" name="city" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-city"></span>
              </div>
            </div>
          </div>
          <!-- [Akhir] City -->


          <!-- postal Code -->
          <div class="input-group mb-3 shadow-sm">
            <input type="number" class="form-control" placeholder="Postal Code" name="postal_code" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-mail-bulk"></span>
              </div>
            </div>
          </div>
          <!-- [Akhir] postal Code -->

          <div class="row">
            <div class="col-8">
              <a href="./page-login.php" class="text-center">I already have a membership</a>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block" name="regis">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
</body>

</html>