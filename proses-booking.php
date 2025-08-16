<?php
session_start();

// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'snapora_studio';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$lokasi = $conn->real_escape_string($_POST['lokasi']);
$kategori = $conn->real_escape_string($_POST['kategori']);
$nama = $conn->real_escape_string($_POST['nama']);
$email = $conn->real_escape_string($_POST['email']);
$tanggal = $conn->real_escape_string($_POST['tanggal']);
$jam = $conn->real_escape_string($_POST['jam']); 
$jumlah_orang = (int)$_POST['jumlah_orang'];

// Validasi jumlah orang berdasarkan paket
$valid = true;
$error = '';

switch ($kategori) {
    case 'Photo Couple':
        if ($jumlah_orang > 2) {
            $valid = false;
            $error = 'Maksimal 2 orang untuk paket Photo Couple';
        }
        break;
    case 'Family Photo':
        if ($jumlah_orang > 50) {
            $valid = false;
            $error = 'Maksimal 50 orang untuk paket Family Photo';
        }
        break;
    case 'Pas Photo':
        if ($jumlah_orang > 1) {
            $valid = false;
            $error = 'Maksimal 1 orang untuk paket Pas Photo';
        }
        break;
}

if (!$valid) {
    die("<script>alert('$error'); window.history.back();</script>");
}

// Hitung total harga
$harga_per_orang = 25000;
$total_harga = $jumlah_orang * $harga_per_orang;

// Format tanggal untuk tampilan
$nama_bulan = [
    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
    '04' => 'April', '05' => 'Mei', '06' => 'Juni',
    '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
    '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
];

$tanggal_parts = explode('-', $tanggal);
$tahun = $tanggal_parts[0];
$bulan = $tanggal_parts[1];
$hari = $tanggal_parts[2];
$bulan_tampilan = $nama_bulan[$bulan];
$tanggal_tampilan = "$hari $bulan_tampilan $tahun";

// Simpan data di session untuk halaman tinjauan
$_SESSION['booking_data'] = [
    'lokasi' => $lokasi,
    'kategori' => $kategori,
    'nama' => $nama,
    'email' => $email,
    'tanggal' => $tanggal_tampilan,
    'jam' => $jam,
    'jumlah_orang' => $jumlah_orang,
    'total_harga' => $total_harga,
    'tanggal_db' => $tanggal
];

// Tampilkan halaman tinjauan
header('Location: tinjauan.php');
exit();
?>