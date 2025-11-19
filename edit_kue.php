<?php
require 'db.php';

if(!isset($_GET['id'])){
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM kue WHERE id=$id");
$data = mysqli_fetch_assoc($q);

if(!$data){
    header("Location: dashboard.php");
    exit;
}

if(isset($_POST['edit'])){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Jika foto diganti
    if($_FILES['foto']['name'] != ""){
        $f = $_FILES['foto'];
        $nm = time() . "_" . $f['name'];
        move_uploaded_file($f['tmp_name'], "uploads/" . $nm);

        // Hapus foto lama
        if(file_exists("uploads/" . $data['foto'])){
            unlink("uploads/" . $data['foto']);
        }

        $foto_update = ", foto='$nm'";
    } else {
        $foto_update = "";
    }

    mysqli_query($conn, 
        "UPDATE kue SET 
            nama='$nama',
            harga='$harga',
            stok='$stok'
            $foto_update
        WHERE id=$id"
    );

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Kue</title>

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
    box-shadow: 0px 4px 12px rgba(0,0,0,0.08);
}

.preview-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 15px;
}
</style>

</head>

<body>

<div class="form-card">

    <h3 class="mb-4">Edit Kue</h3>

    <!-- Preview foto lama -->
    <img src="uploads/<?= $data['foto'] ?>" class="preview-img">

    <form method="POST" enctype="multipart/form-data">

        <label>Ganti Foto (Opsional)</label>
        <input type="file" name="foto" class="form-control mb-3">

        <label>Nama Kue</label>
        <input type="text" name="nama" class="form-control mb-3" value="<?= $data['nama'] ?>" required>

        <label>Harga</label>
        <input type="number" name="harga" class="form-control mb-3" value="<?= $data['harga'] ?>" required>

        <label>Stok</label>
        <input type="number" name="stok" class="form-control mb-3" value="<?= $data['stok'] ?>" required>

        <button class="btn btn-warning" name="edit" >simpan perubahan</button>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>

    </form>
</div>

</body>
</html>
