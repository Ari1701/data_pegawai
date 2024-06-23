<?php
session_start();

session_unset();

session_destroy();

$_SESSION['logout_message'] = "Anda telah berhasil logout.";

header("Location: ../index.php"); 
exit();
?>
