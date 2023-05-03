<?php

// header('Content-Type: application/json/; charset=utf-8');
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kec = $_POST['nama_kec'];
    $no_whatsapp = $_POST['no_whatsapp'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];

    $koneksi->autocommit(false);
    try {
        $koneksi->query("INSERT INTO user VALUES(NULL, '$nama_kec', '$no_whatsapp', 
            '$alamat', '$password')");
        // $queryId = $koneksi->query("SELECT MAX(idPembeli) FROM pembeli");
        // $rows = mysqli_fetch_row($queryId);
        // $idPembeli = $rows[0];
        // $koneksi->query("INSERT INTO alamat VALUES(NULL, '$provinsi','$kota', '$kecamatan', '$kelurahan', '$address', '$idPembeli')");
        // $result = $koneksi->query("SELECT pembeli.*, alamat.* FROM pembeli JOIN alamat ON pembeli.idPembeli 
        //     = alamat.alamat_idPembeli WHERE pembeli.idPembeli = (SELECT MAX(pembeli.idPembeli) FROM pembeli)");
        //     while($row = mysqli_fetch_object($result)){
        //         $data[] = $row;
        //     }
        $koneksi->commit();
        $response['kode'] = 1;
        $response['pesan'] = "Berhasil Membuat Akun";
        $response['data'] = null;
    } catch (Exception $e) {
        $response['kode'] = 0;
        $response['pesan'] = $e->getMessage();
        $response['data'] = null;
        $koneksi->rollback();
    }
    echo json_encode($response);
    mysqli_close($koneksi);
}
