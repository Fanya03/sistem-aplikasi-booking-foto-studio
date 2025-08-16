<?php
session_start();
if (!isset($_SESSION['booking_data'])) {
    header('Location: tinjauan.php');
    exit();
}
$booking = $_SESSION['booking_data'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tinjau Booking - Snapora Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #121212;
            --light: #ffffff;
            --dark: #121212;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: var(--dark);
            line-height: 1.6;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        h1, h2 {
            color: var(--primary);
            font-weight: 700;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            font-size: 24px;
            margin-bottom: 10px;
            position: relative;
            padding-bottom: 15px;
        }
        .header h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }
        .header p {
            color: #666;
        }
        .review-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        .review-item {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        .review-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .review-label {
            flex: 0 0 200px;
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
        }
        .review-label i {
            margin-right: 10px;
            color: var(--primary);
            font-size: 18px;
        }
        .review-value {
            flex: 1;
            color: #333;
        }
        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        .btn {
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 14px;
            border: 2px solid;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }
        .btn-outline {
            background: transparent;
            color: var(--primary);
            border-color: var(--primary);
        }
        .btn-outline:hover {
            background: var(--primary);
            color: var(--light);
        }
        .btn-primary {
            background: var(--primary);
            color: var(--light);
            border-color: var(--primary);
        }
        .btn-primary:hover {
            background: transparent;
            color: var(--primary);
        }
        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 20px;
            }
            .review-item {
                flex-direction: column;
            }
            .review-label {
                flex: 1;
                margin-bottom: 5px;
            }
            .button-group {
                flex-direction: column;
            }
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Tinjau Booking Anda</h2>
            <p>Silakan periksa kembali detail pemesanan Anda sebelum konfirmasi</p>
        </div>

        <div class="review-card">
            <div class="review-item">
                <div class="review-label">
                    <i class="fas fa-map-marker-alt"></i> Lokasi Studio
                </div>
                <div class="review-value"><?php echo htmlspecialchars($booking['lokasi']); ?></div>
            </div>
            <div class="review-item">
                <div class="review-label">
                    <i class="fas fa-camera"></i> Kategori Paket
                </div>
                <div class="review-value"><?php echo htmlspecialchars($booking['kategori']); ?></div>
            </div>
            <div class="review-item">
                <div class="review-label">
                    <i class="fas fa-user"></i> Nama Lengkap
                </div>
                <div class="review-value"><?php echo htmlspecialchars($booking['nama']); ?></div>
            </div>
            <div class="review-item">
                <div class="review-label">
                    <i class="fas fa-envelope"></i> Email
                </div>
                <div class="review-value"><?php echo htmlspecialchars($booking['email']); ?></div>
            </div>
            <div class="review-item">
                <div class="review-label">
                    <i class="fas fa-calendar-alt"></i> Tanggal Booking
                </div>
                <div class="review-value"><?php echo htmlspecialchars($booking['tanggal']); ?></div>
            </div>
            <div class="review-item">
                <div class="review-label">
                    <i class="fas fa-clock"></i> Jam Booking
                </div>
                <div class="review-value"><?php echo htmlspecialchars($booking['jam']); ?></div>
            </div>
            <div class="review-item">
                <div class="review-label">
                    <i class="fas fa-users"></i> Jumlah Orang
                </div>
                <div class="review-value"><?php echo htmlspecialchars($booking['jumlah_orang']); ?></div>
            </div>
            <div class="review-item">
                <div class="review-label">
                    <i class="fas fa-money-bill-wave"></i> Total Harga
                </div>
                <div class="review-value">Rp <?php echo number_format($booking['total_harga'], 0, ',', '.'); ?></div>
            </div>
        </div>

        <div class="button-group">
            <a href="booking.html" class="btn btn-outline">
                <i class="fas fa-edit"></i> Kembali & Edit
            </a>
            <form action="simpan-booking.php" method="post" style="flex: 1;">
                <input type="hidden" name="confirm" value="1">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-circle"></i> Konfirmasi Booking
                </button>
            </form>
        </div>
    </div>
</body>
</html>