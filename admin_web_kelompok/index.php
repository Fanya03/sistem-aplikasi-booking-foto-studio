<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?> 
<!-- untuk melindungi halaman admin agar hanya bisa 
 diakses oleh user yang sudah login sebagai admin. -->

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard-container">
    <h1>Snapora Studio - Admin Dashboard</h1>
    <p>Selamat datang, <?php echo $_SESSION['admin']; ?>!</p>

    <div class="nav-links">
        <a href="booking.php">Lihat Data Booking</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
