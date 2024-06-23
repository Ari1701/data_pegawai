<?php
include '../auth/koneksi.php'; // Pastikan path ini benar sesuai struktur direktori Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $gaji = $_POST['gaji'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    if (!empty($nama) && !empty($email) && !empty($jenis_kelamin)) {
        $sql = "INSERT INTO pegawai (nama, email, telepon, alamat, jabatan, tanggal_masuk, gaji, jenis_kelamin) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssds", $nama, $email, $telepon, $alamat, $jabatan, $tanggal_masuk, $gaji, $jenis_kelamin);

        if ($stmt->execute()) {
            header("Location: ../../tambahpegawai.php?success=Data pegawai berhasil ditambahkan.");
            exit();
        } else {
            header("Location: ../../tambahpegawai.php?error=Terjadi kesalahan saat menambahkan data pegawai.");
            exit();
        }
    } else {
        header("Location: ../../tambahpegawai.php?error=Silakan lengkapi semua bidang yang diperlukan.");
        exit();
    }
}
?>
