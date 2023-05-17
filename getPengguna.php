<?php
// require("koneksi.php");


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $no_whatsapp = $_POST["no_whatsapp"];

// $perintah = "SELECT * FROM penggunas WHERE no_whatsapp = '$no_whatsapp'";
// $eksekusi = mysqli_query($koneksi, $perintah);
// $cek= mysqli_affected_rows($koneksi);

// if($cek > 0) {
//     $response["kode"] = 1;
//     $response["message"] = "Data Tersedia";
//     $response["data"] = array();

//     while($ambil= mysqli_fetch_object($eksekusi)) {
//         //$F["id"] = $ambil->id;
//         $F["nama_pengguna"] = $ambil->nama_pengguna;
//         $F["nama_kec"] = $ambil->nama_kec;
//         $F["no_whatsapp"] = $ambil->no_whatsapp;
//         $F["alamat"] = $ambil->alamat;
//         $F["password"] = $ambil->password;
//         $F["kode_otp"] = $ambil->kode_otp;
//         $F["status"] = $ambil->status;
        
//         array_push($response["data"], $F);
//     }
// }
// else {
//     $response["kode"] = 0;
//     $response["message"] = "Data Tidak Tersedia";
//     $response["data"] = null;

// }
// }
// echo json_encode($response);
// mysqli_close($koneksi);

// header('Content-Type: application/json/; charset=utf-8');
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_whatsapp = $_POST['no_whatsapp'];

    $koneksi->autocommit(false);
    try {
        $result = $koneksi->query("SELECT * FROM penggunas WHERE no_whatsapp = '$no_whatsapp'");
        $check = mysqli_affected_rows($koneksi);
        if ($check > 0) {
            $response['kode'] = 1;
            $response['pesan'] = "Berhasil Login";
        } else {
            $response['kode'] = 2;
            $response['pesan'] = "Gagal Login";
        }

        $koneksi->commit();

        // $response['data'] = $data;
    } catch (Exception $e) {
        $response['kode'] = 0;
        $response['pesan'] = $e->getMessage();
        //$response['data'] = null;
        $koneksi->rollback();
    }
    echo json_encode($response);
    mysqli_close($koneksi);
}
