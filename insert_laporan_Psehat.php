
<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $getPsubur = $_POST['J_Psubur'];
    $getWsubur = $_POST['J_Wsubur'];
    $getKb_p = $_POST['Kb_p'];
    $getKb_w = $_POST['Kb_w'];
    $Kk_tbg = $_POST['Kk_tbg'];

    $user_id = $_POST['id_user'];

    $file = $_FILES['file'];
    $tanggal = date('Y-m-d');

    if ($file != null) {
        // echo 'tes File' . $file;
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $destination = 'assets/Bidang_Perencaan_Sehat/' . $fileName;
        move_uploaded_file($fileTmpName, $destination);
        $query = "INSERT INTO laporan_perencanaan_sehat (J_Psubur, J_Wsubur, Kb_p, Kb_w, Kk_tbg, status , id_user, tanggal , gambar) 
        VALUES ('$getPsubur', '$getWsubur', '$getKb_p' , '$getKb_w', '$Kk_tbg' , 'Proses' , '$user_id' , '$tanggal','$fileName')";

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
