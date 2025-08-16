<?php
session_start();
if (!isset($_SESSION['booking_data']) || !isset($_SESSION['booking_data']['booking_code'])) {
    header('Location: konfirmasi.html');
    exit();
}

$booking = $_SESSION['booking_data'];
$booking_code = $booking['booking_code'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Booking - Snapora Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous">
    <style>
        :root {
            --primary: #121212;
            --light: #ffffff;
            --dark-bg: rgba(0, 0, 0, 0.85);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--dark-bg) url('images/1.jpg') no-repeat center center;
            background-size: cover;
            color: var(--light);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            line-height: 1.6;
        }
        
        .confirmation-box {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            padding: 40px 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        
        .confirmation-icon {
            font-size: 50px;
            color: #2ecc71;
            margin-bottom: 20px;
        }
        
        h1 {
            color: var(--primary);
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .booking-code {
            background: #f8f9fa;
            color: var(--primary);
            padding: 15px;
            border-radius: 5px;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 1px;
            margin: 20px 0;
            border: 1px solid #e0e0e0;
        }
        
        .payment-details {
            background: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            text-align: left;
            color: #333;
        }
        
        .payment-details h3 {
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .payment-details p {
            margin-bottom: 5px;
        }
        
        .instruction {
            color: #333;
            background: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            margin: 25px 0;
            font-size: 15px;
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }
        
        .btn {
            padding: 12px 20px;
            border-radius: 5px;
            font-weight: 500;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
            flex: 1;
            text-decoration: none;
            text-align: center;
        }
        
        .btn-primary {
            background: var(--primary);
            color: var(--light);
        }
        
        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        
        .btn-primary:hover {
            background: #333;
        }
        
        .btn-outline:hover {
            background: #f5f5f5;
        }
        
        @media (max-width: 576px) {
            .confirmation-box {
                padding: 30px 20px;
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
    <div class="confirmation-box">
        <div class="confirmation-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Booking Anda Berhasil</h1>
        
        <div class="booking-code">
            <?php echo $booking_code; ?>
        </div>
        
        <div class="payment-details">
            <h3>Detail Pembayaran</h3>
            <p><strong>Paket:</strong> <?php echo htmlspecialchars($booking['kategori']); ?></p>
            <p><strong>Jumlah Orang:</strong> <?php echo htmlspecialchars($booking['jumlah_orang']); ?></p>
            <p><strong>Total Harga:</strong> Rp <?php echo number_format($booking['total_harga'], 0, ',', '.'); ?></p>
            <p><strong>Tanggal:</strong> <?php echo htmlspecialchars($booking['tanggal']); ?></p>
            <p><strong>Jam:</strong> <?php echo htmlspecialchars($booking['jam']); ?></p>
        </div>
        
        <div class="instruction">
            Tunjukkan kode booking ini kepada petugas studio saat kedatangan Anda.
            <br><br>
            Untuk melanjutkan pembayaran, silakan transfer ke:
            <br>
            <strong>Bank BCA - 1234567890 (Snapora Studio)</strong>
            <br>
            Jumlah: <strong>Rp <?php echo number_format($booking['total_harga'], 0, ',', '.'); ?></strong>
            <br><br>
            Konfirmasi pembayaran via WhatsApp: 085794332322
        </div>
        
        <div class="button-group">
            <a href="studio.html" class="btn btn-primary">Kembali ke Beranda</a>
            <a href="booking.html" class="btn btn-outline">Booking Lagi</a>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>