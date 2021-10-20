<?php

session_start();

require '../../functions.php';

// $user_id = $_GET['userid'];
$_SESSION['temp_userid'] = $_GET['userid'];
$user_id = $_SESSION['temp_userid'];

$sql = query(2, "SELECT * FROM user_member WHERE user_id = '$user_id'");

$full_name = $sql['first_name'] . " " . $sql['last_name'];
$comp_tipe = $sql['comp_tipe'];
$id_member = $sql['id_member'];

if (isset($_POST['adding'])) {

  $id_liner = $_POST['sliner'];

  $cek_sql = "SELECT * FROM sliner WHERE id_member = '$id_member' AND id_liner = '$id_liner'";

  $cek = mysqli_query($conn, $cek_sql);

  if (mysqli_num_rows($cek) > 0) {
    echo "
    <script>
      alert('Liner sudah terdaftar');
    </script>
    ";
  } else {
    $sql_add = "INSERT INTO sliner (id_sliner, id_member, id_liner) 
                    VALUES ('', '$id_member', '$id_liner')";

    mysqli_query($conn, $sql_add);

    $error_msg = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
      echo " 
      <script>
          alert('Data liner berhasil ditambahkan');
      </script>
           ";
      header("Location: ./det_member.php?userid=" . $_SESSION['temp_userid']);
    } else {
      echo "
      <script>
          alert('Data GAGAL di tambahkan [ $error_msg ] ');
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
  <title>Logistic Team | Member Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php
    include './user_navbar.php';
    include './user_sidebar.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">member Profile</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="../../dist/img/<?= $sql['foto']; ?>" alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center"><?= $full_name; ?></h3>

                  <p class="text-muted text-center"><?= $comp_tipe; ?></p>

                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>User ID</b> <a class="float-right"><?= $sql['user_id']; ?></a>
                    </li>

                    <li class="list-group-item">
                      <b>Email</b> <a class="float-right"><?= $sql['email']  ?></a>
                    </li>

                    <li class="list-group-item">
                      <b>Company</b> <a class="float-right"><?= $sql['company']; ?></a>
                    </li>

                    <li class="list-group-item">
                      <b>Phone</b> <a class="float-right"><?= $sql['phone']; ?></a>
                    </li>

                    <li class="list-group-item">
                      <b>City</b> <a class="float-right"><?= $sql['city']; ?></a>
                    </li>

                    <li class="list-group-item">
                      <b>Authority</b> <a class="float-right">Trucking</a>
                    </li>

                    <?php
                    $aktif = $sql['aktif'];

                    if ($aktif == 1) {
                      $caption = 'Active';
                      $clr = 'text-success';
                      $btn_cap = 'Non Activate';
                      $btn_clr = 'btn-danger';
                    } else {
                      $caption = 'Not Active';
                      $clr = 'text-danger';
                      $btn_cap = 'Activate';
                      $btn_clr = 'btn-success';
                    }
                    ?>

                    <li class="list-group-item">
                      <b>Status</b> <a class="float-right <?= $clr; ?>"><?= $caption; ?></a>
                    </li>
                  </ul>
                  <a href="./action/activate.php?userid=<?= $user_id; ?>&method=Member" class="btn btn-block <?= $btn_clr; ?>"><b><?= $btn_cap; ?></b></a>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-8">
              <div class="card">
                <div class="card-header bg-gradient-gray p-2">
                  <h3 class="card-title text-light">Liner Authority</h3>
                </div><!-- /.card-header -->

                <div class="card-body">
                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Shipping Liner</label>
                        <div class="col-sm-10">
                          <!-- <input type="email" class="form-control" id="inputName" placeholder="Name"> -->
                          <select name="sliner" id="sliner" class="form-control">
                            <option value="0" selected disabled>Choose Option..</option>
                            <?php
                            $sql = query(1, "SELECT * FROM liner ORDER BY liner_name ASC");

                            foreach ($sql as $row) :
                            ?>
                              <option value="<?= $row['id_liner']; ?>">[ <?= $row['liner_nick']; ?>] - <?= $row['liner_name']; ?> </option>
                            <?php endforeach; ?>
                          </select>

                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary" name="adding">Adding</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="active tab-pane">
                    <!-- <form action="" method="post">
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
                    </form> -->

                    <div id="container">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr class="bg-gradient-gray text-center">
                            <th class="align-middle">No</th>
                            <th class="align-middle">Code</th>
                            <th class="align-middle">Shipping Liner</th>
                            <th class="align-middle">Action</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php
                          $data = query(1, "SELECT * FROM sliner WHERE id_member = '$id_member'");

                          $i = 1;
                          foreach ($data as $row) :

                            $nick = get_liner('nick', $row['id_liner']);
                            $name = get_liner('name', $row['id_liner']);
                          ?>

                            <tr>
                              <td class="align-middle text-center"><?= $i; ?></td>
                              <td class="align-middle text-center"><?= $nick; ?></td>
                              <td class="align-middle"><?= $name; ?></td>
                              <td class="align-middle text-center">
                                <form action="" method="post">
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-default" name="delete">
                                      <a href="./action/del_member_autority.php?idsliner=<?= $row['id_sliner']; ?>&userid=<?= $user_id; ?>">
                                        <i class="far fa-trash-alt"></i>
                                      </a>
                                    </button>
                                  </div>
                                </form>
                              </td>
                            </tr>
                          <?php
                            $i++;
                          endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    </d>
                    <!-- Closed id Liner Authority -->

                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
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
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
</body>

</html>