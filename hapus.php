<?php
include 'koneksi.php';

// Menangkap NIM dari URL
if(isset($_GET['nim'])){
    $nim = mysqli_real_escape_string($conn, $_GET['nim']);
    
    // 1. Cari nama file foto di database terlebih dahulu
    $cek_foto = mysqli_query($conn, "SELECT foto FROM mahasiswa WHERE nim = '$nim'");
    $data = mysqli_fetch_assoc($cek_foto);
    
    // 2. Hapus file fisik foto jika ada
    if($data && !empty($data['foto'])){
        $path_foto = "uploads/" . $data['foto'];
        if(file_exists($path_foto)){
            unlink($path_foto); // Perintah untuk menghapus file
        }
    }
    
    // 3. Hapus data dari database
    $query_hapus = "DELETE FROM mahasiswa WHERE nim = '$nim'";
    
    if(mysqli_query($conn, $query_hapus)){
        echo "<script>
                alert('Data mahasiswa berhasil dihapus!');
                window.location.href = 'daftar.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($conn) . "');
                window.history.back();
              </script>";
    }
} else {
    header("Location: daftar.php");
}
?>