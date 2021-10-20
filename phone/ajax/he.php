<?php

require '../koneksi.php';

$keyword = $_GET['keyword'];

$query = "SELECT * FROM he WHERE rfid_code = '$keyword'";
$data = mysqli_query($conn, $query);
$datas = mysqli_fetch_assoc($data);

?>

<div class="card-body">
    <div class="row" style="margin-top:-10px;">
        <h3 class="text-primary" style="font-weight: bold;"><?= $datas['he_code']; ?></h3>
    </div>
    <div class="row">
        <h6><?= $datas['he_type'] . ", " . $datas['brand']; ?></h6>
    </div>

</div>