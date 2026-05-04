<?php
include 'koneksi.php';
// Ambil data mahasiswa dari database
$query = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa - Universitas Bimenesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%);
            min-height: 100vh;
            font-family: 'Inter', system-ui, sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }
    </style>
</head>
<body class="flex flex-col text-white min-h-screen">

    <!-- Navbar -->
    <nav class="glass border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="img/logo bimen - Diedit.png" alt="Logo" class="w-11 h-11 rounded-2xl shadow-xl object-contain bg-white/10 p-1">
                <div>
                    <span class="text-2xl font-bold">Universitas</span>
                    <span class="text-2xl font-bold text-blue-200">Bimenesia</span>
                </div>
            </div>
            <ul class="flex gap-8 text-lg font-medium">
                <li><a href="index.php" class="hover:text-blue-300 transition-all flex items-center gap-2"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="daftar.php" class="text-blue-400 border-b-2 border-blue-400 pb-1 flex items-center gap-2"><i class="fas fa-list"></i> Daftar Mahasiswa</a></li>
                <li><a href="tambah.php" class="hover:text-blue-300 transition-all flex items-center gap-2"><i class="fas fa-plus"></i> Tambah Data</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 py-12">
        <div class="max-w-7xl mx-auto px-6 w-full">
            <div class="glass rounded-3xl p-8 md:p-10">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-4xl font-bold mb-2">Data Mahasiswa</h2>
                        <p class="text-blue-200">Daftar seluruh mahasiswa Universitas Bimenesia</p>
                    </div>
                    <a href="tambah.php" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-xl font-semibold transition-all flex items-center gap-2 shadow-lg">
                        <i class="fas fa-plus"></i> Tambah Baru
                    </a>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-white/20">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/10 text-blue-100">
                                <th class="p-5 font-semibold text-center">Foto</th>
                                <th class="p-5 font-semibold">NIM</th>
                                <th class="p-5 font-semibold">Nama Lengkap</th>
                                <th class="p-5 font-semibold">Jurusan</th>
                                <th class="p-5 font-semibold">Email</th>
                                <th class="p-5 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            
                            <?php 
                            if (mysqli_num_rows($query) > 0):
                                while ($data = mysqli_fetch_assoc($query)): 
                            ?>
                            <tr class="hover:bg-white/5 transition-all">
                                <!-- KOLOM FOTO -->
                                <td class="p-5 text-center">
                                    <?php if (!empty($data['foto']) && file_exists("uploads/" . $data['foto'])): ?>
                                        <img src="uploads/<?= htmlspecialchars($data['foto']) ?>" alt="Foto" class="w-16 h-16 rounded-xl object-cover border-2 border-white/30 mx-auto">
                                    <?php else: ?>
                                        <div class="w-16 h-16 rounded-xl bg-black/20 flex flex-col items-center justify-center text-[10px] text-gray-400 mx-auto border border-white/10">
                                            <i class="fas fa-user mb-1 text-lg"></i>
                                            <span>No Foto</span>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                
                                <td class="p-5 font-medium"><?= htmlspecialchars($data['nim']); ?></td>
                                <td class="p-5 font-bold"><?= htmlspecialchars($data['nama']); ?></td>
                                <td class="p-5 text-blue-200">
                                    <span class="bg-blue-500/20 px-3 py-1 rounded-full text-sm border border-blue-400/30">
                                        <?= htmlspecialchars($data['jurusan']); ?>
                                    </span>
                                </td>
                                <td class="p-5 text-blue-200"><?= htmlspecialchars($data['email']); ?></td>
                                <td class="p-5 flex justify-center gap-3">
                                    <a href="edit.php?nim=<?= $data['nim'] ?>" class="w-10 h-10 rounded-xl bg-yellow-500/20 text-yellow-400 hover:bg-yellow-500 hover:text-slate-900 transition-all flex items-center justify-center" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="hapus.php?nim=<?= $data['nim'] ?>" onclick="return confirm('Yakin ingin menghapus data mahasiswa ini?')" class="w-10 h-10 rounded-xl bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                endwhile;
                            else: 
                            ?>
                            <tr>
                                <td colspan="6" class="p-12 text-center text-blue-200">
                                    <i class="fas fa-folder-open text-6xl mb-4 opacity-50"></i>
                                    <h3 class="text-2xl font-bold mb-2">Belum ada data</h3>
                                    <p>Silakan tambahkan data mahasiswa baru terlebih dahulu.</p>
                                </td>
                            </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="glass border-t border-white/20 py-8 text-center text-blue-200 mt-auto">
        <div class="max-w-7xl mx-auto px-6">
            &copy; 2026 Universitas Bimenesia - Admin Data Mahasiswa
        </div>
    </footer>

</body>
</html>