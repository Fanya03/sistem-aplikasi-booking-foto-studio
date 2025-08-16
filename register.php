<?php
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "snapora_studio");

    // Ambil data dari form
    $name = $koneksi->real_escape_string($_POST['name']);
    $email = $koneksi->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah email sudah terdaftar
    $cek = $koneksi->query("SELECT * FROM users WHERE email='$email'");
    
    if ($cek->num_rows > 0) {
        $pesan = "Email sudah terdaftar!";
    } else {
        // Insert ke database
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($koneksi->query($query)) {
            header("Location: login-user.php");
            exit;
        } else {
            $pesan = "Pendaftaran gagal, coba lagi!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Snapora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .register-container {
            background-color: #fff;
            border: 2px solid #000;
            border-radius: 10px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 5px 5px 0px #000;
            text-align: center;
            position: relative;
        }

        .register-container h2 {
            font-size: 28px;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            letter-spacing: 1px;
        }

        .register-container form input {
            padding: 12px;
            margin: 10px 0;
            width: 100%;
            font-size: 16px;
            border: 1px solid #000;
            border-radius: 8px;
            background-color: #fff;
            color: #000;
            box-sizing: border-box;
        }

        .register-container form button {
            padding: 12px;
            width: 100%;
            background-color: #000;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            border: 1px solid #000;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .register-container form button:hover {
            background-color: #fff;
            color: #000;
        }

        .register-container p {
            margin-top: 15px;
            font-size: 14px;
        }

        .register-container a {
            color: #000;
            text-decoration: none;
            transition: color 0.3s;
        }

        .register-container a:hover {
            text-decoration: underline;
        }

        .pesan-error {
            color: red;
            margin-bottom: 10px;
        }

        .position-relative {
    position: relative;
}

      .password-container {
    position: relative;
    width: 100%;
}

.password-container input {
    width: 100%;
    padding: 12px;
    padding-right: 40px; /* ruang buat icon */
    font-size: 16px;
    border: 1px solid #000;
    border-radius: 8px;
    box-sizing: border-box;
}

.toggle-password {
    position: absolute;
    top: 70%;
    right: 12px;
    transform: translateY(-50%);
    width: 22px;
    cursor: pointer;
}

    </style>
</head>
<body>
    <div class="register-container">
        <h2 class="mb-4 text-center">Daftar Akun Snapora</h2>

        <?php if ($pesan) : ?>
            <p class="pesan-error"><?= $pesan; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
            </div>
            
            <div class="mb-3 password-container">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                <img src="images/close_eyes.png" id="togglePassword" class="toggle-password">
            </div>


    
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </form>
        
        <p class="mt-3 text-center">Sudah punya akun? <a href="login-user.php">Login di sini</a></p>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordField.type === 'password';
            passwordField.type = isPassword ? 'text' : 'password';
            this.src = isPassword ? 'images/open_eyes.png' : 'images/close_eyes.png';
        });
    </script>
</body>
</html>
