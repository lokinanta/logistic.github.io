<?php

require '../../functions.php';

$user_id = $_GET['userid'];
$method = $_GET['method'];

if ($method == 'Member') {

    $q_member = query(2, "SELECT * FROM user_member WHERE user_id = '$user_id'");

    if ($q_member['aktif'] == 1) {
        $aktif = 0;
    } else if ($q_member['aktif'] == 0) {
        $aktif = 1;
    } else {
        echo "
            <script>
                Alert('User member aktifasi Not Found');
            </script>
        ";
    }

    $sql = "UPDATE user_member SET aktif = '$aktif' WHERE user_id = '$user_id' ";
    mysqli_query($conn, $sql);

    header("Location: ../det_member.php?userid=" . $user_id);
} else if ($method == 'admin') {
    $q_admin = query(2, "SELECT * FROM user_admin WHERE user_id = '$user_id'");

    if ($q_admin['aktif'] == 1) {
        $aktif = 0;
    } else if ($q_admin['aktif'] == 0) {
        $aktif = 1;
    }

    $sql = "UPDATE user_admin SET aktif = '$aktif' WHERE user_id = '$user_id'";
    mysqli_query($conn, $sql);
}
