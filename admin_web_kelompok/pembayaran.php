<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if (isset($_POST['sudah_dibayar'])) {
        $stmt = mysqli_prepare($conn, "UPDATE booking SET status_pembayaran = 'Sudah Dibayar' WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

header("Location: booking.php");
exit;
?>
