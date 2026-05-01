<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="logo">MahasiswaDB</div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="daftar.php">Daftar Mahasiswa</a></li>
            <li><a href="tambah.php">Tambah Data</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="glass-card">
            <h2>Daftar Mahasiswa</h2>
            <table>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Email</th>
                </tr>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM mahasiswa");
                while($data = mysqli_fetch_array($query)) {
                    echo "<tr>
                            <td>{$data['nim']}</td>
                            <td>{$data['nama']}</td>
                            <td>{$data['jurusan']}</td>
                            <td>{$data['email']}</td>
                          </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>