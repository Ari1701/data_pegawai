<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'koneksi.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        session_start();

        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role']; 

        if ($_SESSION['role'] == 'admin') {
            header("Location: ../page/admin/admin_dashboard.php");
            exit();
        } else {
            header("Location: ../page/user/index.php");
            exit();
        }
    } else {
        header("Location: ../index.php?error=invalid_credentials");
        exit();
    }
} else {
    header("index.php");
    exit();
}
?>
