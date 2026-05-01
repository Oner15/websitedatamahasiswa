<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $email = $_POST['email'];

    $insert = mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama, jurusan, email) 
                                   VALUES ('$nim', '$nama', '$jurusan', '$email')");

    if ($insert) {
        header("Location: daftar.php");
    } else {
        echo "Gagal menyimpan data.";
    }
}
?>;