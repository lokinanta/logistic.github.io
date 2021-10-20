<?php

$conn = mysqli_connect("localhost", "root", "", "gr");
date_default_timezone_set("Asia/Jakarta");

function server_date_time()
{
    return $_SERVER["REQUEST_TIME_FLOAT"];
}

function query($code, $query)
{

    global $conn;
    $result = mysqli_query($conn, $query);

    // Code 1 : Show many data to ARRAY
    // Code 2 : Untuk Select Spesifik data

    if ($code == 1) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {   // Melooping data yang di databse
                $rows[] = $row;                            // Menyimpan data yang di tarik dari database ke Array Rows 
            }
        } else {
            $rows = [];
        }
    } else if ($code == 2) {
        $rows = mysqli_fetch_assoc($result);
    } else {
        $rows = '<b style = "color : red;">Parameter ($code) is not found, Please recheck. </b>';
    }

    return $rows;
}

function cr_new_inbound($in_via)
{
    global $conn;

    $server_date = date('Y-m-d H:i:s', server_date_time());

    //Kode Booking (OK DONE)
    if ($in_via == "Trucking") {
        $kode = "IKT" . date('ymd', strtotime($server_date));
    } else if ($in_via == "Vessel") {
        $kode = "IKV" . date('ymd', strtotime($server_date));
    }

    $result = mysqli_query($conn, "SELECT MAX(booking_num) as maxkode FROM booking WHERE booking_num like '$kode%'");
    $bn = mysqli_fetch_assoc($result);
    $bn_lama = $bn['maxkode']; // AMBIL DATA MAXKODE DARI ARRAY

    // Baca nomor Urut transaksi terakhir
    $lastnourut = substr($bn_lama, 9, 3); // Ambil 3 nomor terakhir dari nomor terakhir
    $new_kode = (int) $lastnourut + 1;  //nomor terakhir ditambah 1

    // Create format nomor transaksi baru
    $new_bn = $kode . sprintf('%03s', $new_kode); //Create new booking Number

    return $new_bn;
}


function cek_admin_id($id, $sap, $nik)
{
    global $conn;

    // Check user id
    $cek_id  = mysqli_query($conn, "SELECT * FROM user_admin WHERE user_id = '$id' ");
    $cek_sap = mysqli_query($conn, "SELECT * FROM user_admin WHERE id_sap = '$sap' ");
    $cek_nik = mysqli_query($conn, "SELECT * FROM user_admin WHERE nik = '$nik' ");

    $cek = '';
    if (mysqli_num_rows($cek_id) >= 1) {
        $cek .= '[User ID]';
    }
    if (mysqli_num_rows($cek_sap) >= 1) {
        $cek .= '[ID SAP]';
    }
    if (mysqli_num_rows($cek_nik) >= 1) {
        $cek .= '[NIK]';
    }

    if ($cek <> "") {
        $result = "Data sudah pernah di Registrasi, Silahkan ubah bagian : " . $cek;
    } else {
        $result = 1;
    }

    return $result;
}

function cek_id($user_id, $pass, $method)
{
    global $conn;

    if ($method == 1) {

        // Check data ke data Member
        $query_member = mysqli_query($conn, "SELECT * FROM user_member WHERE email = '$user_id' OR user_id = '$user_id' ");

        // Check apakah data ada ?
        if (mysqli_num_rows($query_member) == 1) {  // Jika data ada, Maka
            $qr = mysqli_fetch_assoc($query_member);
            if (password_verify($pass, $qr['pass'])) { // Check Password, Jika Sesuai, maka,
                $hasil = 11; // Jika data Email dan Password Valid
            } else {
                $hasil = "Data member Not Valid"; // Jika data Email dan Password non Valid
            }
        } else {
            $hasil = "Data not found";
        }
    } else if ($method == 2) {
        // $query = mysqli_query($conn, "SELECT * FROM user_admin WHERE email = '$user_id' OR user_id = '$user_id' OR nik ='$user_id'");
        $query_admin = mysqli_query($conn, "SELECT * FROM user_admin WHERE email = '$user_id'OR id_sap = '$user_id' OR nik = '$user_id' OR user_id = '$user_id'");

        // Check apakah data ada ?
        if (mysqli_num_rows($query_admin) == 1) {  // Jika data ada, Maka
            $qr = mysqli_fetch_assoc($query_admin);
            if (password_verify($pass, $qr['pass'])) { // Check Password, Jika Sesuai, maka,
                $hasil = 21; // Jika data Email dan Password Valid
            } else {
                $hasil = "password not Valid"; // Jika data Email dan Password non Valid
            }
        } else {
            $hasil = "Data not found";
        }
    }
    return $hasil;
}

function get_data_member($id, $kode)
{
    global $conn;
    if ($kode == 11) {
        $query = mysqli_query($conn, "SELECT * FROM user_member WHERE email = '$id' OR user_id = '$id' OR id_member = '$id' ");

        if (mysqli_num_rows($query) > 0) {
            $rows = mysqli_fetch_assoc($query);
        } else {
            $rows = "not found";
        }
    } else if ($kode = 21) {
        $query = mysqli_query($conn, "SELECT * FROM user_admin WHERE email = '$id' OR nik = '$id' OR id_sap = '$id' ");

        if (mysqli_num_rows($query) > 0) {
            $rows = [];
            $rows = mysqli_fetch_assoc($query);
        } else {
            $rows = "not found";
        }
    }
    return $rows;
}

function ribuan($angka)
{
    $hsl_ribuan = number_format($angka, 0, ',', '.');
    return $hsl_ribuan;
}

function historical($form, $action, $desc, $nik, $act_by)
{
    global $conn;
    $now = date('Y-m-d H:i:s', server_date_time());
    $sql = "INSERT INTO ghistorical 
                (historical_id,
                act_date,
                form,
                action,
                description,
                nik,
                act_by )
            VALUES 
                ('',
                '$now',
                '$form',
                '$action',
                '$desc',
                '$nik',
                '$act_by'                
                )";

    mysqli_query($conn, $sql);
}

function cek_av_vessel($vessel_id)
{
    global $conn;

    // Check id Vessel (apakah ada vessel sudah ada masuk di list shipment atau tidak)
    $sql = "SELECT * FROM voy_in WHERE id_vessel = '$vessel_id' AND vsl_act = 1 ";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        return 0; // Ada data, jangan di proses lagi
    } else if (mysqli_affected_rows($conn) == 0) {
        return 1; // data kapal belum pernah open, Gas kan..
    }
}

function cek_sliner($method, $id_liner)
{
    global $conn;

    $sql = mysqli_query($conn, "SELECT * FROM liner WHERE id_liner = '$id_liner'");

    if (mysqli_num_rows($sql) <> 1) {
        echo "
            <script>
                alert('Data Shipping Liner Not Found');
            </script>
        ";
    } else {
        $data = mysqli_fetch_assoc($sql);

        if ($method == 'nama') {
            return $data['liner_name'];
        } else if ($method == 'nick') {
            return $data['liner_nick'];
        } else {
            echo "
            <script>
                alert('Data Shipping Liner Not Found');
            </script>
        ";
        }
    }
}

function get_cont_code($id_type, $code)
{
    if ($code === 'size') {
        $tipe_cont = query(2, "SELECT cont_code FROM cont_type WHERE id_type_cont = '$id_type' ");
        $result = $tipe_cont["cont_code"];
    } else if ($code === 'iso_code') {
        $tipe_cont = query(2, "SELECT iso_code FROM cont_type WHERE id_type_cont = '$id_type' ");
        $result = $tipe_cont["iso_code"];
    } else if ($code === 'tare_weight') {
        $tipe_cont = query(2, "SELECT tare_weight FROM cont_type WHERE id_type_cont = '$id_type' ");
        $result = ribuan($tipe_cont["tare_weight"]);
    } else if ($code === 'max_weight') {
        $tipe_cont = query(2, "SELECT max_weight FROM cont_type WHERE id_type_cont = '$id_type' ");
        $result = ribuan($tipe_cont["max_weight"]);
    } else if ($code === 'remark') {
        $tipe_cont = query(2, "SELECT remark FROM cont_type WHERE id_type_cont = '$id_type' ");
        $result = $tipe_cont["remark"];
    } else if ($code === 'aktif') {
        $aktif = query(2, "SELECT aktif FROM cont_type WHERE id_type_cont = '$id_type' ");
        $data = $aktif["aktif"];

        if ($data === '1') {
            $result = 'Aktif';
        } else if ($data === '0') {
            $result = 'Non Aktif';
        } else {
            '<b style = "color : red;">Parameter(aktif) is not found, Please recheck. </b>';
        }
    } else {
        $result = '<b style = "color : red;">Parameter is not found, Please recheck. </b>';
    }

    return $result;
}

function encrypt($data, $key)
{
    $date = $_SERVER["REQUEST_TIME_FLOAT"];

    $chp = "AES-128-CTR";
    $opt = 0;
    $iv = date('Ymd', $date) . '23041991';

    return openssl_encrypt($data, $chp, $key, $opt, $iv);
}

function decrypt($data, $key)
{
    $date = $_SERVER["REQUEST_TIME_FLOAT"];

    $chp = "AES-128-CTR";
    $opt = 0;
    $iv = date('Ymd', $date) . '23041991';

    return openssl_decrypt($data, $chp, $key, $opt, $iv);
}

function cek_expired_booking()
{
    global $conn;

    $now = date('Y-m-d H:i:s', server_date_time());

    $sql = "SELECT * FROM vw_booking_inbound WHERE expired_date =''";
}
