<?php
include '../../auth/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'];

    $sql = "DELETE FROM users WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            $successMessage = "Pengguna berhasil dihapus.";
            header("Location: ../admin/lihatUser.php?success=" . urlencode($successMessage));
            exit();
        } else {
            $errorMessage = "Terjadi kesalahan saat menghapus pengguna.";
            header("Location: ../admin/lihatUser.php?error=" . urlencode($errorMessage));
            exit();
        }

        $stmt->close();
    } else {
        $errorMessage = "Terjadi kesalahan saat mempersiapkan penghapusan pengguna.";
        header("Location: ../admin/lihatUser.php?error=" . urlencode($errorMessage));
        exit();
    }

    $conn->close();
} else {
    header("Location: ../admin/lihatUser.php");
    exit();
}
?>
