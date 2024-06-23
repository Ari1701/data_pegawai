<?php
include '../auth/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM pegawai WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: lihatUser.php?success=Pengguna berhasil dihapus.");
            exit();
        } else {
            header("Location: lihatUser.php?error=Terjadi kesalahan saat menghapus pengguna.");
            exit();
        }
    } else {
        header("Location: lihatUser.php?error=ID pengguna tidak valid.");
        exit();
    }
} else {
    header("Location: lihatUser.php");
    exit();
}
?>
