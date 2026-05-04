<?php 
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'koneksi.php'; 

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$where = !empty($search) ? "WHERE nama LIKE '%$search%' OR nim LIKE '%$search%'" : "";

$sort_option = isset($_GET['sort']) ? $_GET['sort'] : 'nama_asc';
$order_sql = "nama ASC"; 
if ($sort_option == 'nama_desc') $order_sql = "nama DESC";
elseif ($sort_option == 'nim_asc') $order_sql = "nim ASC";
elseif ($sort_option == 'nim_desc') $order_sql = "nim DESC";

$query = mysqli_query($conn, "SELECT * FROM mahasiswa $where ORDER BY $order_sql");
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
    <style>body { background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%); min-height: 100vh; font-family: 'Inter', system-ui, sans-serif; } .glass { background: rgba(255,255,255,0.12); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.25); }</style>
</head>
<body class="text-white flex flex-col min-h-screen">

    <nav class="glass border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between relative">
            <div class="flex items-center gap-3">
                <img src="img/logo bimen - Diedit.png" alt="Logo" class="w-11 h-11 rounded-2xl bg-white/10 p-1">
                <div class="text-2xl font-bold">Layanan<span class="text-blue-300"> Simensa</span></div>
            </div>
            <button id="hamburger-btn" class="md:hidden text-white p-2 rounded-lg bg-white/10 border border-white/20 hover:bg-white/20 transition"><i class="fas fa-bars text-xl"></i></button>
            <ul id="nav-menu" class="hidden absolute top-full left-0 w-full glass md:static md:w-auto md:bg-transparent md:border-none md:flex flex-col md:flex-row gap-4 md:gap-8 p-6 md:p-0 text-lg font-medium border-t border-white/20 md:border-t-0 shadow-xl md:shadow-none z-50">
                <li><a href="index.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="daftar.php" class="text-blue-400 border-b-2 border-blue-400 pb-1 flex items-center gap-2"><i class="fas fa-list"></i> Daftar</a></li>
                <li><a href="tambah.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-plus"></i> Tambah Data</a></li>
                <li class="md:border-l md:border-white/20 md:pl-6"><a href="logout.php" onclick="return confirm('Keluar?')" class="text-red-400 hover:text-red-300 flex items-center gap-2"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </nav>

    <main class="flex-1 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="glass rounded-3xl p-8">
                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-8">
                    <div>
                        <h2 class="text-4xl font-bold mb-2">Daftar Mahasiswa</h2>
                        <p class="text-blue-200">Total data: <span class="font-bold text-white bg-blue-600/30 px-3 py-1 rounded-lg"><?= $total ?></span></p>
                    </div>
                    <form method="GET" class="flex flex-wrap gap-3 w-full lg:w-auto">
                        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Cari Nama/NIM..." class="flex-1 min-w-[200px] px-5 py-3 bg-white/10 border border-white/30 rounded-2xl focus:outline-none focus:border-blue-400">
                        <div class="relative flex-1 min-w-[160px]">
                            <select name="sort" onchange="this.form.submit()" class="w-full bg-white/10 border border-white/30 text-white rounded-2xl focus:outline-none focus:border-blue-400 px-5 py-3 cursor-pointer appearance-none">
                                <option value="nama_asc" <?= $sort_option == 'nama_asc' ? 'selected' : '' ?> class="text-black">Urut: Nama (A-Z)</option>
                                <option value="nama_desc" <?= $sort_option == 'nama_desc' ? 'selected' : '' ?> class="text-black">Urut: Nama (Z-A)</option>
                                <option value="nim_asc" <?= $sort_option == 'nim_asc' ? 'selected' : '' ?> class="text-black">Urut: NIM (Naik)</option>
                                <option value="nim_desc" <?= $sort_option == 'nim_desc' ? 'selected' : '' ?> class="text-black">Urut: NIM (Turun)</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-white/50 pointer-events-none"></i>
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-2xl flex items-center justify-center gap-2"><i class="fas fa-search"></i> Cari</button>
                        <a href="daftar.php" class="bg-yellow-500 hover:bg-yellow-600 text-slate-900 px-6 py-3 rounded-2xl flex items-center justify-center gap-2 font-bold"><i class="fas fa-sync-alt"></i> Reset</a>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-white/10">
                                <th class="p-5 text-center">Foto</th><th class="p-5 text-left">NIM</th><th class="p-5 text-left">Nama Lengkap</th><th class="p-5 text-left">Jurusan</th><th class="p-5 text-left">Alamat</th><th class="p-5 text-left">Email</th><th class="p-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            <?php if(mysqli_num_rows($query) > 0): while($row = mysqli_fetch_assoc($query)): ?>
                                <tr class="hover:bg-white/5">
                                    <td class="p-5 text-center">
                                        <?php if(!empty($row['foto']) && file_exists("uploads/".$row['foto'])): ?>
                                            <img src="uploads/<?= $row['foto'] ?>" class="w-14 h-14 rounded-xl object-cover mx-auto border border-white/30">
                                        <?php else: ?>
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($row['nama']) ?>&background=random&color=fff&size=128" class="w-14 h-14 rounded-xl object-cover mx-auto border border-white/30">
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-5 font-mono"><?= htmlspecialchars($row['nim']) ?></td><td class="p-5 font-semibold"><?= htmlspecialchars($row['nama']) ?></td><td class="p-5"><?= htmlspecialchars($row['jurusan']) ?></td><td class="p-5 text-sm"><?= htmlspecialchars($row['alamat']) ?></td><td class="p-5"><?= htmlspecialchars($row['email']) ?></td>
                                    <td class="p-5 text-center whitespace-nowrap">
                                        <a href="edit.php?nim=<?= $row['nim'] ?>" class="text-yellow-400 hover:text-yellow-300 mx-2 text-xl"><i class="fas fa-edit"></i></a>
                                        <a href="hapus.php?nim=<?= $row['nim'] ?>" onclick="return confirm('Hapus <?= htmlspecialchars($row['nama']) ?>?')" class="text-red-400 hover:text-red-300 mx-2 text-xl"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endwhile; else: ?>
                                <tr><td colspan="7" class="p-10 text-center text-white/60"><i class="fas fa-search text-4xl mb-3 block"></i> Tidak ada data</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer class="glass py-8 text-center text-blue-200 mt-auto">&copy; 2026 Simensa</footer>
    <script>
        const btn = document.getElementById('hamburger-btn'); const menu = document.getElementById('nav-menu'); const icon = btn.querySelector('i');
        btn.addEventListener('click', () => { menu.classList.toggle('hidden'); menu.classList.toggle('flex'); if(menu.classList.contains('flex')) { icon.classList.remove('fa-bars'); icon.classList.add('fa-times'); } else { icon.classList.remove('fa-times'); icon.classList.add('fa-bars'); } });
    </script>
</body>
</html>