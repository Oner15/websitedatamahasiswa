<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nim     = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama    = mysqli_real_escape_string($conn, $_POST['nama']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $alamat  = mysqli_real_escape_string($conn, $_POST['alamat']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);

    $cek_nim = mysqli_query($conn, "SELECT nim FROM mahasiswa WHERE nim = '$nim'");
    if (mysqli_num_rows($cek_nim) > 0) {
        echo "<script>alert('❌ GAGAL: NIM $nim sudah ada di sistem!'); window.history.back();</script>"; exit;
    }

    $foto = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
        $file_ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allowed  = ['jpg', 'jpeg', 'png'];

        if (in_array($file_ext, $allowed)) {
            $foto_baru   = $nim . "_" . time() . "." . $file_ext;
            $target_file = $target_dir . $foto_baru;
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) { $foto = $foto_baru; } 
            else { echo "<script>alert('Gagal upload foto!'); window.history.back();</script>"; exit; }
        } else { echo "<script>alert('Hanya JPG, JPEG, PNG!'); window.history.back();</script>"; exit; }
    }

    $query = "INSERT INTO mahasiswa (nim, nama, jurusan, alamat, email, foto) VALUES ('$nim', '$nama', '$jurusan', '$alamat', '$email', '$foto')";
    if (mysqli_query($conn, $query)) { echo "<script>alert('✅ Data ditambahkan!'); window.location.href = 'daftar.php';</script>"; } 
    else { echo "<script>alert('❌ Gagal: " . mysqli_error($conn) . "');</script>"; }
} else { header("Location: tambah.php"); }
?>