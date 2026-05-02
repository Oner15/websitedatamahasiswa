<?php
include 'koneksi.php';

// Cek apakah tombol submit ditekan
if (isset($_POST['submit'])) {
    $nim     = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama    = mysqli_real_escape_string($conn, $_POST['nama']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);

    $foto = "";

    // Proses Upload Foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "uploads/";

        // Buat folder uploads jika belum ada
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_ext   = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allowed    = ['jpg', 'jpeg', 'png'];

        if (in_array($file_ext, $allowed)) {
            $foto_baru   = $nim . "_" . time() . "." . $file_ext;
            $target_file = $target_dir . $foto_baru;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $foto = $foto_baru;
            } else {
                echo "<script>alert('Gagal mengupload foto!'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Hanya boleh file JPG, JPEG, atau PNG!'); window.history.back();</script>";
            exit;
        }
    }

    // Query Insert ke database
    $query = "INSERT INTO mahasiswa (nim, nama, jurusan, email, foto) 
              VALUES ('$nim', '$nama', '$jurusan', '$email', '$foto')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data mahasiswa berhasil disimpan!');
                window.location.href = 'daftar.php';
              </script>";
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
} else {
    header("Location: tambah.php");
}
?>