<?php

require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
    $role = htmlspecialchars($role);

    try {
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param('sss', $username, $password, $role);

        $stmt->execute();

        $successMessage = "Pengguna $username berhasil ditambahkan.";

        header("Location: ../page/admin/tambahUser.php?success=" . urlencode($successMessage));
        exit();
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
