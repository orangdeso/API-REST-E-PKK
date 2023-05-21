<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kategori = $_POST['kategori'];
    $jml_posyandu = $_POST['jml_posyandu'];
    $jml_posyandu_iterasi = $_POST['jml_posyandu_iterasi'];
    $jml_klp = $_POST['jml_klp'];
    $jml_anggota = $_POST['jml_anggota'];
    $jml_kartu = $_POST['jml_kartu'];
    $file = $_FILES['file'];
    $user_id = $_POST['id_user'];
    $tanggal = date('Y-m-d');

    // informasi file yang diupload
    if ($file != null) {
        // echo 'tes File' . $file;
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $destination = 'assets/Bidang_kesehatan/' . $fileName;
        move_uploaded_file($fileTmpName, $destination);
        $query = "INSERT INTO laporan_bidang_kesehatan (kategori_laporan, jumlah_posyandu, jumlah_posyandu_iterasi, jumlah_klp, jumlah_anggota , jumlah_kartu_gratis, gambar_upload , id_user , status , tanggal) 
        VALUES ('$kategori', '$jml_posyandu', '$jml_posyandu_iterasi', '$jml_klp' , '$jml_anggota' , '$jml_kartu' , '$fileName' , '$user_id' , 'Proses' , '$tanggal')";

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

        // echo 'Data berhasil disimpan!';
    } else {
        $query = "INSERT INTO laporan_bidang_kesehatan (kategori_laporan, jumlah_posyandu, jumlah_posyandu_iterasi, jumlah_klp, jumlah_anggota , jumlah_kartu_gratis, gambar_upload) VALUES ('$kategori', '$jml_posyandu', '$jml_posyandu_iterasi', '$jml_klp' , '$jml_anggota' , '$jml_kartu' , '')";

        $result = mysqli_query($koneksi, $query);
        $check = mysqli_affected_rows($koneksi);
        if ($check > 0) {
            $response['kode'] = 1;
            $response['message'] = "Data Saja Masuk";
            $response['data'] = [
                'Berhasil' => $check
            ];
        } else {
            $response['kode'] = 0;
            $response['message'] = "Data Gagal Masuk";
        }
        echo json_encode($response);
        mysqli_close($koneksi);

        // echo 'Data Saja berhasil disimpan!';
    }
}
