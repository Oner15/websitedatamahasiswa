<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa - Universitas Bimenesia</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="logo">
            <span class="logo-icon">🎓</span>
            Universitas Bimenesia
        </div>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="daftar.php" class="active"><i class="fas fa-list-ul"></i> Daftar Mahasiswa</a></li>
            <li><a href="tambah.php"><i class="fas fa-plus"></i> Tambah Data</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="main-card">
            <!-- Header Card -->
            <div class="card-header">
                <div class="header-left">
                    <i class="fas fa-users fa-2x"></i>
                    <h1>Daftar Mahasiswa</h1>
                </div>
                <a href="tambah.php" class="btn-tambah">
                    <i class="fas fa-plus"></i> Tambah Mahasiswa
                </a>
            </div>

            <!-- Table -->
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Jurusan</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nama ASC");
                        if(mysqli_num_rows($query) > 0):
                            while($data = mysqli_fetch_array($query)):
                        ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($data['nim']) ?></strong></td>
                                <td><?= htmlspecialchars($data['nama']) ?></td>
                                <td><span class="badge-jurusan"><?= htmlspecialchars($data['jurusan']) ?></span></td>
                                <td><?= htmlspecialchars($data['email']) ?></td>
                                <td class="aksi">
                                    <a href="edit.php?nim=<?= $data['nim'] ?>" class="btn-action edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="hapus.php?nim=<?= $data['nim'] ?>" class="btn-action delete" 
                                       onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            endwhile;
                        else:
                        ?>
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <i class="fas fa-box-open fa-4x"></i>
                                    <h3>Belum ada data mahasiswa</h3>
                                    <p>Silakan tambahkan data mahasiswa baru</p>
                                    <a href="tambah.php" class="btn-tambah-small">Tambah Data Pertama</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>