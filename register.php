<?php
require 'koneksi.php';

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $q = "INSERT INTO users(username, password) VALUES('$username','$password')";

    if(mysqli_query($conn, $q)){
        header("Location: login.php");
        exit;
    } else {
        echo "<script>alert('Username sudah dipakai');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
body {
    background: #f5f7fb;
}

.register-card {
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

<div class="register-card">

    <h3 class="text-center mb-4">Register</h3>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" class="form-control mb-3" required>

        <label>Password</label>
        <input type="password" name="password" class="form-control mb-3" required>

        <button class="btn btn-success w-100" name="register">Register</button>

        <p class="text-center mt-3">
            Sudah punya akun? <a href="login.php">Login</a>
        </p>
    </form>

</div>

</body>
</html>
