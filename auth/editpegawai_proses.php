<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $gaji = $_POST['gaji'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $sql = "UPDATE pegawai SET nama=?, email=?, telepon=?, alamat=?, jabatan=?, tanggal_masuk=?, gaji=?, jenis_kelamin=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdsi", $nama, $email, $telepon, $alamat, $jabatan, $tanggal_masuk, $gaji, $jenis_kelamin, $id);

    if ($stmt->execute()) {
        header("Location: ../page/user/lihatpegawai.php?success=Data pegawai berhasil diperbarui.");
        exit();
    } else {
        
        header("Location: ../../editpegawai.php?id=$id&error=Terjadi kesalahan saat memperbarui data pegawai.");
        exit();
    }
} else {
    header("Location: ../../lihatPegawai.php");
    exit();
}
?>
