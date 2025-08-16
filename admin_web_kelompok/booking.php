<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Booking</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .table-container {
        margin: 20px auto;
        width: 90%;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }
    th, td {
        border: 1px solid #aaa;
        padding: 8px;
        text-align: center;
    }
    .admin-buttons-bottom {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        width: 100%;
        margin-top: 10px;
    }
    .admin-buttons-bottom a {
        padding: 8px 16px;
        background: black;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background 0.3s;
    }
    .admin-buttons-bottom a:hover {
        background: #333;
    }
    .hapus-btn {
        padding: 4px 8px;
        background: #dc3545;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        transition: background 0.3s;
    }
    .hapus-btn:hover {
        background: #b52b37;
    }
    </style>
</head>
<body>

<h2 style="text-align: center;">Data Booking</h2>

<div class="table-container">
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Lokasi Studio</th>
            <th>Kategori Paket</th>
            <th>Tanggal Booking</th>
            <th>Jam Booking</th>
            <th>Jumlah Orang</th>
            <th>Total Harga</th>
            <th>Status Pembayaran</th>
            <th>Hapus</th>
        </tr>

        <?php
        $no = 1;
        $data = mysqli_query($conn, "SELECT * FROM booking");
        $jumlah_data = mysqli_num_rows($data);

        if ($jumlah_data > 0) {
            while ($d = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['nama'] ?></td>
            <td><?= $d['email'] ?></td>
            <td><?= $d['lokasi_studio'] ?></td>
            <td><?= $d['kategori_paket'] ?></td>
            <td><?= date('d M Y', strtotime($d['tanggal_booking'])) ?></td>
            <td><?= $d['jam_booking'] ?></td>
            <td><?= $d['jumlah_orang'] ?></td>
            <td>Rp <?= number_format($d['total_harga'], 0, ',', '.') ?></td>
            <td>
                <form action="pembayaran.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $d['id'] ?>">
                    <input type="checkbox" name="sudah_dibayar" value="1"
                        onchange="this.form.submit()" 
                        <?= isset($d['status_pembayaran']) && $d['status_pembayaran'] === 'Sudah Dibayar' ? 'checked disabled' : '' ?>>
                    <label style="font-size: 12px;">Sudah Dibayar</label>
                </form>
            </td>
            <td>
                <a href="hapus_data.php?id=<?= $d['id'] ?>" class="hapus-btn" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php 
            }
        } else {
            echo "<tr><td colspan='11' style='text-align: center;'>Belum ada data booking</td></tr>";
        }
        ?>
    </table>

    <div class="admin-buttons-bottom">
        <a href="index.php">Kembali ke Dashboard</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>
</body>
</html>
