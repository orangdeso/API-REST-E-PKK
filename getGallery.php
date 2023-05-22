<?php
require("koneksi.php");

if ($_SERVER['REQUEST_METHOD']==='POST') {
$id = $_POST['id_user'];
$perintah = "SELECT * FROM galery WHERE id_user =  '$id'";
$eksekusi = mysqli_query($koneksi, $perintah);
$cek= mysqli_affected_rows($koneksi);

if($cek > 0) {
    $response["kode"] = 1;
    $response["message"] = "Data Tersedia";
    $response["data"] = array();

    while($ambil= mysqli_fetch_object($eksekusi)) {
        $F["id_galery"] = $ambil->id_galery;
        $F["judul"] = $ambil->judul;
        $F["deskripsi"] = $ambil->deskripsi;
        $F["tanggal"] = $ambil->tanggal;
        $F["status"] = $ambil->status;
        $F["image"] = $ambil->image;
        $F["id_user"] = $ambil->id_user;
        
        array_push($response["data"], $F);
    }
}
else {
    $response["kode"] = 0;
    $response["message"] = "Data Tidak Tersedia";
    $response["data"] = null;

}
}
echo json_encode($response);
mysqli_close($koneksi);
