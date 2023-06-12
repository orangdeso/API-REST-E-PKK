<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    //$desc = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $files = $_FILES['image'];
    $id_user = $_POST['id_user'];

    $response = array();

    //Get ID
    $query = "SELECT id FROM galerys ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    // Periksa hasil kueri
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastId = $row["id"];
    } else {
        $lastId = 0; // Jika tabel kosong, gunakan nilai awal
    }

    // Tambahkan 1 untuk mendapatkan ID berikutnya
    $nextId = $lastId + 1;

    foreach ($files['tmp_name'] as $key => $tmp_name) {
        $file = array(
            'name' => $files['name'][$key],
            'tmp_name' => $tmp_name
        );

        if ($file != null) {
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $destination = 'assets/gallery2/' . $fileName;
            move_uploaded_file($fileTmpName, $destination);

            // echo 'well';

            $query = "INSERT INTO galerys (id, judul, gambar, status, tanggal , id_user) 
            VALUES ($nextId,'$judul', '$fileName' , 'Proses', '$tanggal' , '$id_user' )";

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
        }
    }

    echo json_encode($response);
    mysqli_close($koneksi);
}
