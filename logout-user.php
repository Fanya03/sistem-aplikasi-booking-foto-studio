<?php
session_start();
session_destroy(); // Hapus semua session

header("Location: login-user.php"); // Arahkan ke halaman login
exit;
?>
