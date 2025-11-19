<?php
require 'koneksi.php';

if(isset($_SESSION['user'])){
    header("Location: dashboard.php");
    exit;
}

$err = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($q) == 1){
        $data = mysqli_fetch_assoc($q);

        if(password_verify($password, $data["password"])){
            $_SESSION['user'] = $data['username'];
            header("Location: dashboard.php");
            exit;
        }
    }

    $err = "Username atau password salah!";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
body {
    background: #f5f7fb;
}

.login-card {
    max-width: 380px;
    margin: 80px auto;
    padding: 35px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0px 5px 18px rgba(0,0,0,0.08);
}
</style>
</head>

<body>

<div class="login-card">

    <h3 class="text-center mb-4">Login</h3>

    <?php if($err): ?>
    <div class="alert alert-danger text-center">
        <?= $err ?>
    </div>
    <?php endif; ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" class="form-control mb-3" required>

        <label>Password</label>
        <input type="password" name="password" class="form-control mb-3" required>

        <button class="btn btn-primary w-100" name="login">Login</button>

        <p class="text-center mt-3">
            Belum punya akun? <a href="register.php">Register</a>
        </p>
    </form>

</div>

</body>
</html>
