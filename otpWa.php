<?php

$token = "E81E3krC90YF22AI6xzp";
$target = "082142568403";

$kodeOtp = $_POST['kodeOtp'];
$noHp = $_POST['noHp'];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.fonnte.com/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0, +CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
        'target' => $noHp,
        'message' => "Kode verifikasi E-PKK Anda adalah: " . $kodeOtp,

    ),
    CURLOPT_HTTPHEADER => array(
        "Authorization: $token"
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
