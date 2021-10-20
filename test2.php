<?php

require './functions.php';

$sql = "SELECT * FROM booking where booking_num = 'IKT210324002'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);

// $now = new Datetime(date('Y-m-d', server_date_time()));
$now = server_date_time();
$expired_date = strtotime($data['expired_date']);

$diff = $now - $expired_date;

echo "Tanggal Sekarang adalah : " . date('d-m-y', $now);
echo "<br>";
echo "<br>";
echo "Tanggal Expired adalah : " . date('d-m-y', $expired_date);
echo "<br>";
echo "<br>";
echo "Selisih hari adalah : " . floor($diff / (3600 * 24));
