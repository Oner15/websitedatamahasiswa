<?php
// Login protection (opsional, bisa dihapus kalau belum pakai login)
session_start();
if(!isset($_SESSION['login'])) {
    // header("Location: login.php"); exit; // uncomment jika sudah ada login
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data - MahasiswaDB</title>
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
        .form-input {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-input:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.3);
        }
    </style>
</head>
<body class="text-white">

    <!-- Navbar -->
    <nav class="glass border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="img/logo bimen - Diedit.png" alt="Logo" class="w-11 h-11 rounded-2xl shadow-xl object-contain bg-white/10 p-1">
                <div>
                    <span class="text-2xl font-bold">Universitas</span>
                    <span class="text-2xl font-bold text-blue-300">Bimenesia</span>
                </div>
            </div>
            <ul class="flex gap-8 text-lg font-medium">
                <li><a href="index.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="daftar.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-list"></i> Daftar</a></li>
                <li><a href="tambah.php" class="text-blue-400 border-b-2 border-blue-400 pb-1 flex items-center gap-2"><i class="fas fa-plus"></i> Tambah Data</a></li>
            </ul>
        </div>
    </nav>

    <div class="min-h-[85vh] flex items-center py-12">
        <div class="max-w-2xl mx-auto px-6 w-full">
            <div class="glass rounded-3xl p-10 md:p-14">
                <h2 class="text-4xl font-bold text-center mb-2">Tambah Data Mahasiswa</h2>
                <p class="text-blue-200 text-center mb-10">Isi data mahasiswa baru</p>

                <?php if(isset($_GET['status']) && $_GET['status']=='error'): ?>
                <div class="bg-red-500/20 border border-red-400 p-4 rounded-2xl mb-6 text-center">
                    <?= htmlspecialchars($_GET['message'] ?? 'Terjadi kesalahan') ?>
                </div>
                <?php endif; ?>

                <form action="proses.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                    
                    <!-- Foto -->
                    <div class="text-center mb-8">
                        <label class="block text-sm font-medium mb-3">Foto Mahasiswa</label>
                        <div id="preview" class="w-40 h-40 mx-auto rounded-2xl overflow-hidden border-4 border-white/30 bg-slate-800 mb-4">
                            <img id="previewImg" src="" class="w-full h-full object-cover" style="display:none;">
                        </div>
                        <input type="file" name="foto" id="foto" accept="image/*" onchange="previewImage(event)" hidden>
                        <button type="button" onclick="document.getElementById('foto').click()" 
                                class="px-6 py-3 bg-white/10 hover:bg-white/20 rounded-2xl">
                            📷 Pilih Foto
                        </button>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">NIM</label>
                        <input type="text" name="nim" required maxlength="15" 
                               class="form-input w-full px-5 py-4 rounded-2xl">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" required 
                               class="form-input w-full px-5 py-4 rounded-2xl">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Jurusan</label>
                        <input type="text" name="jurusan" required 
                               class="form-input w-full px-5 py-4 rounded-2xl">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Alamat</label>
                        <textarea name="alamat" required rows="3" 
                                  class="form-input w-full px-5 py-4 rounded-2xl"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" name="email" 
                               class="form-input w-full px-5 py-4 rounded-2xl">
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" name="submit" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 py-6 rounded-2xl font-semibold text-lg">
                            <i class="fas fa-save"></i> Simpan Data
                        </button>
                        <a href="daftar.php" 
                           class="flex-1 text-center py-6 border border-white/30 hover:bg-white/10 rounded-2xl font-semibold">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const previewImg = document.getElementById('previewImg');
            reader.onload = () => {
                previewImg.src = reader.result;
                previewImg.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>