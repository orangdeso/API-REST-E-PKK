<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $getJamban = $_POST['jamban'];
    $getSpal = $_POST['Spal'];
    $getTps = $_POST['tps'];
    $getMCK = $_POST['Mck'];
    $getPdam = $_POST['Pdam'];
    $getSumur = $_POST['Sumur'];
    $getDll = $_POST['dll'];
    $user_id = $_POST['id_user'];
    $file = $_FILES['file'];
    $tanggal = date('Y-m-d');

    if ($file != null) {
        // echo 'tes File' . $file;
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $destination = 'assets/Bidang_LingkunganHidup/' . $fileName;
        move_uploaded_file($fileTmpName, $destination);
        $query = "INSERT INTO laporan_kelestarian_lingkungan_hidup (jamban, spal, tps, mck, pdam, sumur , dll, gambar_upload , id_user,status,tanggal) 
        VALUES ('$getJamban', '$getSpal', '$getTps' , '$getMCK', '$getPdam' , '$getSumur' , '$getDll' , '$fileName' , '$user_id','Proses','$tanggal')";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);

        if ($check > 0) {
            $response['kode'] = 1;
            $response['message'] = "Data Gambar Masuk";
            $response['data'] = [
                'Berhasil' => $check
            ];
        } else {
            $response['kode'] = 0;
            $response['message'] = "Data Gagal Masuk";
        }
        echo json_encode($response);
        mysqli_close($koneksi);
    }
}
