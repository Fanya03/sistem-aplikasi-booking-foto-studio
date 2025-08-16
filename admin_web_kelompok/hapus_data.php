<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "db.php"; 
// Ini buat menghubungkan ke database yang ada di file db.php.

$id = intval($_GET['id']);

$stmt = mysqli_prepare($conn, "DELETE FROM booking WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Balik ke halaman booking
header("Location: booking.php");
exit;
?>
