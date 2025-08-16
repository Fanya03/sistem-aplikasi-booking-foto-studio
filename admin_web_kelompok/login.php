<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="login-container">
    <h2>Login Admin</h2>
    <p class="snapora">Snapora Studio - Your Photo Experience</p>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required> <br><br>
        <input type="password" name="password" placeholder="Password" required> <br><br>
        <button type="submit" name="login">Login</button>
    </form>

    <?php
    if (isset($_POST['login'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        // Username & password default
        if ($user == "admin" && $pass == "123") {
            $_SESSION['admin'] = $user;
            header("Location: index.php");
            exit;
        } else {
            echo "<p style='color:red;'>Username atau password salah!</p>";
        }
    }
    ?>
</div>

</body>
</html>
