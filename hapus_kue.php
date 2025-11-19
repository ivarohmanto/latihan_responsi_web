<?php require 'koneksi.php';
if(!isset($_SESSION['user'])) header("Location: login.php");
$id=$_GET['id'];


$q=mysqli_query($conn,"SELECT foto FROM kue WHERE id=$id");
$f=mysqli_fetch_assoc($q)['foto'];
unlink("uploads/".$f);
mysqli_query($conn,"DELETE FROM kue WHERE id=$id");
header("Location: dashboard.php");
?>