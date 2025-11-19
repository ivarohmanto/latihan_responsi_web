<?php
require 'koneksi.php';

if(isset($_POST['tambah'])){
    $f = $_FILES['foto'];
    $nm = time() . "_" . $f['name'];
    move_uploaded_file($f['tmp_name'], "uploads/" . $nm);

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "INSERT INTO kue (nama,harga,stok,foto) VALUES ('$nama','$harga','$stok','$nm')");
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Kue</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
body {
    background: #f5f7fb;
}

.form-card {
    max-width: 600px;
    margin: 60px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}
</style>

</head>

<body>

<div class="form-card">

    <h3 class="mb-4">Tambah Kue</h3>

    <form method="POST" enctype="multipart/form-data">
        
        <label>Foto</label>
        <input type="file" name="foto" class="form-control mb-3" required>

        <label>Nama Kue</label>
        <input type="text" name="nama" class="form-control mb-3" required>

        <label>Harga</label>
        <input type="number" name="harga" class="form-control mb-3" required>

        <label>Stok</label>
        <input type="number" name="stok" class="form-control mb-3" required>

        <button class="btn btn-primary" name="tambah">Tambah</button>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
