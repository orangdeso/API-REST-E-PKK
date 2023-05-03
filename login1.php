<?php

// header('Content-Type: application/json/; charset=utf-8');
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_whatsapp = $_POST['no_whatsapp'];
    $password = $_POST['password'];

    $koneksi->autocommit(false);
    try {
        // $koneksi->query("SELECT * FROM pasien WHERE pasien_nowa = '$nowa' AND pasien_sandi = '$sandi'");
        // $queryId = $koneksi->query("SELECT MAX(idPembeli) FROM pembeli");
        // $rows = mysqli_fetch_row($queryId);
        // $idPembeli = $rows[0];
        // $koneksi->query("INSERT INTO alamat VALUES(NULL, '$provinsi','$kota', '$kecamatan', '$kelurahan', '$address', '$idPembeli')");
        $result = $koneksi->query("SELECT * FROM user WHERE no_whatsapp = '$no_whatsapp' AND password = '$password'");
        $check = mysqli_affected_rows($koneksi);
        if ($check > 0) {
            // while ($row = mysqli_fetch_object($result)) {
            //     $data[] = $row;
            // }
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
