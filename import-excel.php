<?php

include './functions.php';
include './spreadsheet-reader-master/php-excel-reader/excel_reader2.php';

if ($_POST['upload'] == "upload") {
    $type = explode(".", $_FILES['data_upload']['name']);

    if (empty($_FILES['data_upload']['name'])) {
        echo "
            <script>
                alert('Opps, Please Fill all / Select File..');
                document.location='./';
            </script>
        ";
    } else if (strtolower(end($type)) !== 'xls' || strtolower(end($type)) != 'xlsx') {
        echo "
            <script>
                alert('Please upload XLS or XLSX format Only..');
                document.location ='./';
            </script>
        ";
    } else {
        $target_dir = "uploads/" . basename($_FILES['data_upload']['name']);

        move_uploaded_file($_FILES['data_upload']['tmp_name'], $target_dir);

        $Reader = new SpreadsheetReader($target_dir);

        $i = 1;

        foreach ($Reader as $key => $Row) {
            // Import data excel mulai dari baris Ke-2 (Karena Header pada baris 1)

            if ($key < 1) continue;

            $cont_no = $Row[0];
            $laden = $Row[1];
            $soc = $Row[2];
            $cond = $Row[3];
            $remark = $Row[4];

            // Checking data

            $chk_data = cek_data_inbound($cont_no, $laden, $soc, $cond);

            if ($chk_data == true) {
                $stat = 0;
            } else {
                $stat = 1;
            }

            $sql =  "INSERT INTO temp_inbound ('id_booking', 'seq', 'cont_no', 'laden', 'soc', 'condition', 'remark', 'stat')
                     VALUES
                        ('$booking_num',
                        '$i',
                        '$cont_no',
                        '$laden',
                        '$soc',
                        '$cond',
                        '$remark',
                        '$stat')";

            $query = mysqli_query($conn, $sql);

            if ($i == $jlh_req_data) {
                exit;
            }
            $i++;
        }

        if (mysqli_affected_rows($conn) > 0) {
            echo "
            <script>
                alert('Data berhasil di upload');
            </script>
            ";
            header('Location : ./up_inbound.php');
        }
    }
}
