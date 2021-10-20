<?php

$conn = mysqli_connect("localhost", "root", "", "gr");
date_default_timezone_set("Asia/Jakarta");


function server_date_time()
{
    return $_SERVER["REQUEST_TIME_FLOAT"];
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



function query($code, $query)
{
    global $conn;
    $result = mysqli_query($conn, $query);

    // Code 1 : Show many data to ARRAY
    // Code 2 : Untuk Select Spesifik data

    if ($code == 1) {
        while ($row = mysqli_fetch_assoc($result)) {   // Melooping data yang di databse
            $rows[] = $row;                            // Menyimpan data yang di tarik dari database ke Array Rows 
        }
    } else if ($code == 2) {
        $rows = mysqli_fetch_assoc($result);
    } else {
        $rows = '<b style = "color : red;">Parameter ($code) is not found, Please recheck. </b>';
    }

    return $rows;
}

function cek_admin_id($id, $sap, $nik)
{
    global $conn;

    $cek = mysqli_query($conn, "SELECT * FROM user_admin WHERE user_id = '$id' OR id_sap = '$sap' OR nik = '$nik'");
    $data = mysqli_fetch_assoc($cek);

    if (mysqli_num_rows($cek) < 1) {
        $result = 1;
    } else {
        $hsl = 'Data ';

        // Cek user id
        if ($data['user_id'] == $id) {
            $hsl .= '[User ID : ' . $id . '] ';
        }

        // Cek id_sap
        if ($data['id_sap'] == $sap) {
            $hsl .= '[ID SAP : ' . $sap .  '] ';
        }

        // Cek Nik
        if ($data['nik'] == $nik) {
            $hsl .= '[NIK : ' . $nik .  '] ';
        }
        $hsl .= ' sudah pernah digunakan, Please recheck..';
        $result = $hsl;
    }
    return $result;
}

function cek_id_admin($id, $sap, $nik)
{
    global $conn;

    // Cek User id, SAP, NIK

    $cek = mysqli_query($conn, "SELECT * FROM user_admin WHERE user_id = '$id' OR id_sap = '$sap' OR nik = '$nik'");
    $data = mysqli_fetch_assoc($cek);

    if (mysqli_fetch_row($cek) < 1) {
        $result = 1;
    } else {
        $hsl = '';
        if ($data['user_id'] == $id) {
        }
    }

    return $result;
}


function cek_id_member($user_id, $email, $phone)
{
    global $conn;

    $sql = "SELECT * FROM user_member WHERE user_id = '$user_id' OR email = '$email' OR phone = '$phone'";

    $data = mysqli_query($conn, $sql);

    if (mysqli_num_rows($data) > 0) {
        return false;
    } else {
        return true;
    }
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
        $query = mysqli_query($conn, "SELECT * FROM user_member WHERE email = '$id' OR user_id = '$id'  ");

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


function get_liner($params, $id_liner)
{
    $sql = "SELECT * FROM liner WHERE id_liner = '$id_liner'";

    $data = query(2, $sql);

    if ($params == 'name') {
        $result = $data['liner_name'];
    } else if ($params == 'nick') {
        $result = $data['liner_nick'];
    }

    return $result;
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


function get_booking_num($id_request)
{

    global $conn;

    $sql = "SELECT * FROM booking WHERE id_req_booking ='$id_request'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $hsl = mysqli_fetch_assoc($query);
        $hasil = $hsl['booking_num'];
    } else {
        $hasil = "";
    }
    return $hasil;
}

function upload_excel()
{
    $namaFile = $_FILES['data_upload']['name'];
    $ukuranFile = $_FILES['data_upload']['size'];
    $error = $_FILES['data_upload']['error'];
    $tempdir = $_FILES['data_upload']['size']['tmp_name'];

    // Cek apakah ada file yang di upload

    if ($error === 4) {
        echo "
            <script>
                alert('Pilih File terlebih dahulu');
            </script>;
        ";
        return false;
    }

    // Cek file yang diupload adalah excel File

    $ekstensiExcelValid = ['xls', 'xlsx'];
    $ekstensiExcel = explode('.', $namaFile);
    $ekstensiExcel = strtolower(end($ekstensiExcel));

    if (!in_array($ekstensiExcel, $ekstensiExcelValid)) {
        echo "
        <script>
            alert('Yang anda upload bukan Excel File');
        </script>;
        ";

        return false;
    }

    // cek jika ukurannya terlalu besar (Maximum 500kb)
    if ($ukuranFile > 500000) {
        echo "
        <script>
            alert('File yang anda upload terlalu besar');
        </script>;

        ";
        return false;
    }

    // Jika Semua oke, daripengecekan

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiExcel;

    move_uploaded_file($tempdir, './uploads/' . $namaFileBaru);
    return $namaFileBaru;
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

function cek_format_container($Container_Number)
{
    $cont_no = strtoupper($Container_Number);

    if (strlen($cont_no) <> 12) {
        return false;
    } else {
        $pattern = "/^([A-Z]{4}) ([0-9]{7})$/";
        preg_match($pattern, $cont_no, $matches, PREG_OFFSET_CAPTURE);

        if (empty($matches)) {
            return false;
        } else {
            return true;
        }
    }
}

function cek_data_inbound($cont_no, $laden, $soc, $condition)
{
    $cont_no = htmlspecialchars(strtoupper($cont_no));
    $laden = htmlspecialchars(strtoupper($laden));
    $soc = htmlspecialchars(strtoupper($soc));
    $condition = htmlspecialchars(strtoupper($condition));

    // Check Format penulisan container
    $chk_cont_no = cek_format_container($cont_no);

    // Cek Data Laden
    if ($laden == 'E' || $laden == 'L') {
        $chk_laden = true;
    } else {
        $chk_laden = false;
    }

    // Check SOC or COC
    if ($soc == 'SOC' || $soc == 'COC') {
        $chk_soc = true;
    } else {
        $chk_soc = false;
    }

    // Check Condition Container

    if ($condition == 'GD' || $condition == 'CL' || $condition == 'DM') {
        $chk_condition = true;
    } else {
        $chk_condition = false;
    }

    if ($chk_cont_no == true && $chk_laden == true && $chk_soc == true && $chk_condition == true) {
        return true;
    } else {
        return false;
    }
}


function auto_cek_exp_inbound()
{
    // MASIH TRIAL...
    global $conn;

    $sql = "SELECT * FROM booking";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);

    $now = server_date_time();
    $expired_date = strtotime($data['expired_date']);

    $diff = $now - $expired_date;

    echo "Selisih Hari adalah : " . floor($diff / (3600 * 24));
}
