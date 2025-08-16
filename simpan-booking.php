<?php
session_start();
if (!isset($_SESSION['booking_data']) || !isset($_POST['confirm'])) {
    header('Location: booking.html');
    exit();
}

$booking = $_SESSION['booking_data'];

// Koneksi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'snapora_studio';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Generate booking code
$booking_code = 'BOOK-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));

// Simpan ke database
$sql = "INSERT INTO booking 
    (booking_code, lokasi_studio, kategori_paket, nama, email, tanggal_booking, jam_booking, jumlah_orang, total_harga, status_pembayaran) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

if (empty($booking['status_pembayaran'])) {
    $booking['status_pembayaran'] = 'Belum Dibayar';
}

$stmt->bind_param("sssssssiss", 
    $booking_code,
    $booking['lokasi'],
    $booking['kategori'],
    $booking['nama'],
    $booking['email'],
    $booking['tanggal_db'],  // format YYYY-MM-DD
    $booking['jam'],
    $booking['jumlah_orang'],
    $booking['total_harga'],
    $booking['status_pembayaran']
);



if ($stmt->execute()) {
    // Simpan kode booking ke session
    $booking['booking_code'] = $booking_code;
    $_SESSION['booking_data'] = $booking;

    // Arahkan ke halaman konfirmasi
    header('Location: konfirmasi.php');
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
