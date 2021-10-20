<?php


require '../functions.php';

$id = 'rlokinanta';
$id_sap = '01123511';
$nik = '859259';
$cek = cek_admin_id($id, $id_sap, $nik);

if ($cek <> 1) {
    echo 'Mantap';
} else {
    echo "
    <script>
        alert('$cek');
    </script>";
}
echo "<br>";
$hari_ini = date('Y-m-d H:i:s', strtotime("now"));
echo $hari_ini;
