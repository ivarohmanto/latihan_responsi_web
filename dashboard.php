<?php
require 'db.php';
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$q = mysqli_query($conn, "SELECT * FROM kue ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Katalog Kue</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
body {
    background: #f5f7fb;
}

.card-kue {
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: 0.2s;
}

.card-kue:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.12);
}

.card-kue img {
    height: 180px;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
</style>

</head>

<body class="container py-4">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Katalog Kue</h2>
    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
</div>

<div class="row g-4">
<?php while($k = mysqli_fetch_assoc($q)): ?>
    <div class="col-md-4">
        <div class="card card-kue">
            <img src="uploads/<?= $k['foto'] ?>" class="card-img-top">

            <div class="card-body">
                <h5><?= $k['nama'] ?></h5>
                <p class="mb-1">Harga: Rp <?= number_format($k['harga'],0,',','.') ?></p>
                <p class="mb-2">Stok: <?= $k['stok'] ?></p>

                <a href="edit_kue.php?id=<?= $k['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="hapus_kue.php?id=<?= $k['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus kue ini?')">Hapus</a>
            </div>
        </div>
    </div>
<?php endwhile; ?>
</div>

<a href="tambah_kue.php" class="btn btn-primary mt-4">Tambah Kue</a>

</body>
</html>
