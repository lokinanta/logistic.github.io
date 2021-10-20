<?php

require '../../../functions.php';

$id_sliner = $_GET['idsliner'];
$user_id = $_GET['userid'];


$sql = "DELETE FROM sliner WHERE id_sliner = '$id_sliner'";

mysqli_query($conn, $sql);
$error_msg = mysqli_error($conn);

if (mysqli_affected_rows($conn) > 0) {
    echo "
        <script>
            alert('Data Berhasil di delete');
        </script>
    ";
    header("Location: ../det_member.php?userid=" . $user_id);
} else {
    echo "
      <script>
          alert('GAGAL di hapus [ $error_msg ] ');
      </script>   
          ";
}
