<?php
require("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $perintah = "UPDATE penggunas SET password = '$password' WHERE id = '$id'";
    $eksekusi = mysqli_query($koneksi, $perintah);
    
    if ($eksekusi) {
        $response["kode"] = 1;
        $response["message"] = "Data berhasil diperbarui";
    } else {
        $response["kode"] = 0;
        $response["message"] = "Gagal memperbarui data";
    }
} else {
    $response["kode"] = 0;
    $response["message"] = "Metode yang digunakan tidak valid";
}

echo json_encode($response);
mysqli_close($koneksi);
?>
