<?php

require '../koneksi.php';

$keyword = $_GET['keyword'];

$query = "SELECT * FROM truck WHERE rfid_code = '$keyword'";

$data = mysqli_query($conn, $query);
$datas = mysqli_fetch_assoc($data);
?>


<div class="card-header">
    <h3 class="card-title">TRANSPORTATION</h3>
</div>
<div class="card-body">
    <div class="row" style="margin-top:-10px;">
        <h3 class="text-primary" style="font-weight: bold;"><?= $datas['truck_code']; ?></h3>
    </div>

    <div class="row">
        <h6><?= $datas['no_polisi'] . ", " . $datas['truck_type'] ?></h6>
    </div>
</div>