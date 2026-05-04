<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

if (isset($_GET['nim'])) {
    $nim = mysqli_real_escape_string($conn, $_GET['nim']);
    $cek_foto = mysqli_query($conn, "SELECT foto FROM mahasiswa WHERE nim = '$nim'");
    $data = mysqli_fetch_assoc($cek_foto);
    
    if ($data && !empty($data['foto'])) {
        $path_foto = "uploads/" . $data['foto'];
        if (file_exists($path_foto)) { unlink($path_foto); }
    }
    
    $query_hapus = "DELETE FROM mahasiswa WHERE nim = '$nim'";
    if (mysqli_query($conn, $query_hapus)) {
        echo "<script>alert('✅ Data dihapus!'); window.location.href = 'daftar.php';</script>";
    } else {
        echo "<script>alert('❌ Gagal hapus!'); window.history.back();</script>";
    }
} else { header("Location: daftar.php"); }
?>