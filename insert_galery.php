<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $desc = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $file = $_FILES['file'];
    $id_user = $_POST['id_user'];


    if ($file != null) {
        // echo 'tes File' . $file;
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $destination = 'assets/gallery/' . $fileName;
        move_uploaded_file($fileTmpName, $destination);
        $query = "INSERT INTO galery (judul, deskripsi, tanggal, status, image , id_user) 
        VALUES ('$judul', '$desc', '$tanggal' , 'Proses', '$fileName' , '$id_user' )";

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
