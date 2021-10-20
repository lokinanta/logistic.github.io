<?php


//encrypt Data
$DATE = $_SERVER["REQUEST_TIME_FLOAT"];

$mydate = date('Ymd', $DATE) . '23041991';

// echo $now . $mydate;

$data = "IKT230491";

$chipering = "AES-128-CTR";
$options = 0;
$enc_iv = $mydate;
$enc_key = 'havit';

$result = openssl_encrypt($data, $chipering, $enc_key, $options, $enc_iv);

echo 'Data : ' . $data;

echo "<br>";
echo "<br>";

echo 'Encrypt result : ' . $result;

Header('Location: ./test2.php?keyword=' . $result);






// Decrypt code (destination)

$DATE = $_SERVER["REQUEST_TIME_FLOAT"];

// $now = date('Ymd', $DATE);
$mydate = date('Ymd', $DATE) . '23041991';

$code = $_GET['keyword'];
// $code = 'OA==';
$chipering = "AES-128-CTR";
$options = 0;
$key = 'havit';
$iv = $mydate;

$decryption = openssl_decrypt(
    $code,
    $chipering,
    $key,
    $options,
    $iv
);

echo $decryption;
