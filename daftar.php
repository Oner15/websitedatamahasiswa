<?php 
include 'koneksi.php'; 

// SEARCH LOGIC
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$where = "";

if (!empty($search)) {
    $where = "WHERE nama LIKE '%$search%' OR nim LIKE '%$search%'";
}

// Query dengan search
$query = mysqli_query($conn, "SELECT * FROM mahasiswa $where ORDER BY nama ASC");

// Hitung jumlah mahasiswa
$total = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { 
            background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%); 
            min-height: 100vh; 
        }
        .glass { 
            background: rgba(255,255,255,0.12); 
            backdrop-filter: blur(20px); 
            border: 1px solid rgba(255,255,255,0.25); 
        }
    </style>
</head>
<body class="text-white flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="glass border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="img/logo bimen - Diedit.png" alt="Logo" class="w-11 h-11 rounded-2xl">
                <div class="text-2xl font-bold">Layanan<span class="text-blue-300"> Simensa</span></div>
            </div>
            <ul class="flex gap-8 text-lg">
                <li><a href="index.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="daftar.php" class="text-blue-400 border-b-2 border-blue-400 pb-1"><i class="fas fa-list"></i> Daftar Mahasiswa</a></li>
                <li><a href="tambah.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-plus"></i> Tambah</a></li>
            </ul>
        </div>
    </nav>

    <main class="flex-1 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="glass rounded-3xl p-8">

                <!-- Header + Search Bar (seperti gambar) -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                    <h2 class="text-4xl font-bold">Daftar Mahasiswa <span class="text-blue-300"> (<?= $total ?> orang)</span></h2>
                    
                    <form method="GET" class="flex gap-3 w-full md:w-auto">
                        <input 
                            type="text" 
                            name="search" 
                            value="<?= htmlspecialchars($search) ?>"
                            placeholder="Cari Nama atau NIM..." 
                            class="flex-1 md:w-80 px-5 py-3 bg-white/10 border border-white/30 rounded-2xl focus:outline-none focus:border-blue-400 placeholder:text-white/50">
                        
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 px-8 py-3 rounded-2xl flex items-center gap-2 font-medium transition">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        
                        <a href="daftar.php" 
                           class="bg-yellow-500 hover:bg-yellow-600 px-8 py-3 rounded-2xl flex items-center gap-2 font-medium transition">
                            Reset
                        </a>
                    </form>
                </div>

                <!-- Tabel -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-white/10">
                                <th class="p-5 text-center">Foto</th>
                                <th class="p-5">NIM</th>
                                <th class="p-5">Nama Lengkap</th>
                                <th class="p-5">Jurusan</th>
                                <th class="p-5">Alamat</th>
                                <th class="p-5">Email</th>
                                <th class="p-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            <?php if(mysqli_num_rows($query) > 0): ?>
                                <?php while($row = mysqli_fetch_assoc($query)): ?>
                                <tr class="hover:bg-white/5">
                                    <td class="p-5 text-center">
                                        <?php if(!empty($row['foto'])): ?>
                                            <img src="uploads/<?= $row['foto'] ?>" 
                                                 class="w-14 h-14 rounded-xl object-cover mx-auto border border-white/30">
                                        <?php else: ?>
                                            <div class="w-14 h-14 bg-gray-700 rounded-xl flex items-center justify-center mx-auto text-3xl">👤</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-5 font-mono"><?= htmlspecialchars($row['nim']) ?></td>
                                    <td class="p-5 font-semibold"><?= htmlspecialchars($row['nama']) ?></td>
                                    <td class="p-5"><?= htmlspecialchars($row['jurusan'] ?? '-') ?></td>
                                    <td class="p-5 text-sm"><?= htmlspecialchars($row['alamat'] ?? '-') ?></td>
                                    <td class="p-5"><?= htmlspecialchars($row['email'] ?? '-') ?></td>
                                    <td class="p-5 text-center">
                                        <a href="edit.php?nim=<?= $row['nim'] ?>" class="text-yellow-400 hover:text-yellow-300 mx-2 text-xl"><i class="fas fa-edit"></i></a>
                                        <a href="hapus.php?nim=<?= $row['nim'] ?>" 
                                           onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')" 
                                           class="text-red-400 hover:text-red-300 text-xl"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="p-10 text-center text-white/60">
                                        <i class="fas fa-search text-4xl mb-3 block"></i>
                                        Tidak ada data ditemukan
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer class="glass py-8 text-center text-blue-200 mt-auto">
        &copy; 2026 Simensa
    </footer>
</body>
</html>