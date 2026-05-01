<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
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
        <div class="glass-card" style="max-width: 600px; margin: auto;">
            <h2>Input Data Baru</h2>
            <form action="proses.php" method="POST">
                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" required placeholder="Contoh: 24050974xxx">
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" required>
                </div>
                <div class="form-group">
                    <label>Jurusan</label>
                    <input type="text" name="jurusan" required placeholder="Pendidikan Teknologi Informasi">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <button type="submit" name="submit" class="btn">Simpan Data</button>
            </form>
        </div>
    </div>
</body>
</html>