<?php

session_start();

require '../functions.php';

if (isset($_SESSION['login_member'])) {
  $sidebar = 'pushmenu';
  $link = '../logout.php';
  $caption = 'Logout';
} else {
  $sidebar = '';
  $link = '../page-login.php';
  $caption = 'Login';
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Logistic Perawang</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
  <div class="wrapper">

    <?php include './phone_navbar.php';
    include './phone_sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"> Supply Container <small>1.0</small></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Supply Container</li>
                <!-- <li class="breadcrumb-item active">Top Navigation</li> -->
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">

          <form onsubmit="return false">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <input class="form-control shadow-sm" type="text" placeholder="RFID CODE" id="rfid_code" name="rfid_code" autocomplete="off" style="visibility: visible;">
              </div>
            </div>
          </form>


          <div class="row pt-3">
            <div class="col-md-6">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">HEAVY EQUIPMENT</h3>
                </div>
                <div id="he">
                  <div class="card-body">
                    <div class="row" style="margin-top:-10px;">
                      <h3 class="text-primary" style="font-weight: bold;">No data</h3>
                    </div>
                  </div>

                  <div class="row">
                    <h6>No data</h6>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">TRANSPORTATION</h3>
                </div>
                <div id="transport">
                  <div class="card-body">
                    <div class="row" style="margin-top:-10px;">
                      <h3 class="text-primary" style="font-weight: bold;">-</h3>
                    </div>

                    <div class="row">
                      <h6>-</h6>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <!-- Card untuk Container -->
            <div class="col-md-12">
              <div class="card card-warning" id="container">
                <div class="card-header text-center">
                  <h3 class="card-title text-center">CONTAINER</h3>
                </div>

                <div class="row pt-2 justify-content-center container">
                  <div class="col-md-6">
                    <div class="card card-info shadow-sm">
                      <div class="card-body">
                        <div class="row mb-2 border-bottom" style="margin-top:-10px;">
                          <h4 class="text-primary font-weight-bolder">TEGU 1234567 (20GP)</h4>
                        </div>

                        <div class="row">
                          <p class="col-sm-4 col-md-4 ">Liner</p>
                          <label class="col-sm-7 col-md-7 ">TEMAS LINE</label>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                          <p class="col-md-4">Used Days</p>
                          <label>24 Days</label>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                          <p class="col-md-4">Condition</p>
                          <label>GOOD</label>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                          <p class="col-md-4">COC / SOC</p>
                          <label>COC</label>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                          <p class="col-md-4">Delivery No</p>
                          <select name="delivery_no" id="delivery_no" class="col-md-8">
                            <option value="0" selected disabled>Choose Delivery No</option>
                            <option value="2160140513">2160140513</option>
                            <option value="2160140514">2160140514</option>
                          </select>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="card card-info shadow-sm">
                      <div class="card-body">
                        <div class="row mb-2 border-bottom" style="margin-top:-10px;">
                          <h4 class="text-primary font-weight-bolder">TEGU 1234567 (20GP)</h4>
                        </div>

                        <div class="row">
                          <p class="col-md-4">Liner</p>
                          <label class="col-md-7">TEMAS LINE</label>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                          <p class="col-md-4">Used Days</p>
                          <label>24 Days</label>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                          <p class="col-md-4">Condition</p>
                          <label>GOOD</label>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                          <p class="col-md-4">COC / SOC</p>
                          <label>COC</label>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                          <p class="col-md-4">Delivery No</p>
                          <select name="delivery_no" id="delivery_no" class="col-md-8">
                            <option value="0" selected disabled>Choose Delivery No</option>
                            <option value="2160140513">2160140513</option>
                            <option value="2160140514">2160140514</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <?php include '../footer.php'; ?>

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <script src="./ajax/find_rfid.js"></script>

</body>

</html>