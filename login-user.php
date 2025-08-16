<?php
session_start();
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "snapora_studio");

    // Ambil data dari form
    $email = $koneksi->real_escape_string($_POST['email']);
    $password = $koneksi->real_escape_string($_POST['password']);

    // Query cek user
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $koneksi->query($query);

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        
        // Cek password
        if (password_verify($password, $data['password'])) {
            // Login berhasil
            $_SESSION['user'] = $data['name'];
            header("Location: studio.html");
            exit;
        } else {
            $pesan = "Password salah!";
        }
    } else {
        $pesan = "Akun tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Snapora</title>
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

.login-container {
    background-color: #fff;
    border: 2px solid #000;
    border-radius: 10px;
    padding: 30px;
    width: 100%;
    max-width: 400px;
    box-shadow: 5px 5px 0px #000;
    text-align: center;
}

.login-container h2 {
    font-size: 28px;
    margin-bottom: 20px;
    border-bottom: 2px solid #000;
    padding-bottom: 10px;
    letter-spacing: 1px;
}

.login-container form input {
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

.login-container form button {
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

.login-container form button:hover {
    background-color: #fff;
    color: #000;
}

.login-container p {
    margin-top: 15px;
    font-size: 14px;
}

.login-container a {
    color: #000;
    text-decoration: none;
    padding: 0;
    border: none;
    background: none;
    display: inline;
    transition: color 0.3s;
}

.login-container a:hover {
    color: #000;
    text-decoration: underline;
}

.pesan-error {
    color: red;
    margin-bottom: 10px;
}
.password-container {
    position: relative;
}

.password-container img {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    height: 20px;
    cursor: pointer;
}



    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="mb-4 text-center">Login ke Snapora</h2>
        
        <?php if ($pesan) : ?>
            <p class="pesan-error"><?= $pesan; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
            </div>
            
            <div class="mb-3">
                <label>Password</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                    <img src="images/close_eyes.png" id="togglePassword" alt="toggle">
                </div>
            </div>
      
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        
        <p class="mt-3 text-center">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
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
