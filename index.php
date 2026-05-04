<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MahasiswaDB - Simensa</title>
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

        .hero-bg {
            min-height: 92vh;
            background: linear-gradient(
                to right,
                rgba(15, 23, 42, 0.85) 0%,
                rgba(15, 23, 42, 0.75) 40%,
                rgba(15, 23, 42, 0.45) 70%,
                rgba(30, 64, 175, 0.3) 100%
            ), 
            url('img/bimensia.jpeg') center/cover no-repeat;
            display: flex;
            align-items: center;
        }

        .hero-content {
            max-width: 580px;
        }
    </style>
</head>
<body class="flex flex-col text-white">

    <!-- Navbar -->
    <nav class="glass border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="img/logo bimen - Diedit.png" 
                     alt="Logo Simensa" 
                     class="w-11 h-11 rounded-2xl shadow-xl object-contain bg-white/10 p-1">
                <div>
                    <span class="text-2xl font-bold">Layanan</span>
                    <span class="text-2xl font-bold text-blue-200">Simensa</span>
                </div>
            </div>

            <ul class="flex gap-8 text-lg font-medium">
                <li><a href="index.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="daftar.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-list"></i> Daftar Mahasiswa</a></li>
                <li><a href="tambah.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-plus"></i> Tambah Data</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-bg">
        <div class="max-w-7xl mx-auto px-6 w-full">
            <div class="hero-content">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-3">
                    Selamat Datang di
                </h1>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-white">
                    Simensa
                </h1>
                
                <p class="mt-6 text-lg text-blue-100 max-w-md">
                    Sistem manajemen data mahasiswa berbasis web yang modern, responsif, 
                    dan dirancang untuk memudahkan pengelolaan data akademik Simensa.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 mt-10">
                    <a href="daftar.php" 
                       class="px-10 py-5 bg-blue-600 hover:bg-blue-700 font-semibold text-lg rounded-2xl transition-all flex items-center justify-center gap-3">
                        <i class="fas fa-users"></i>
                        Lihat Daftar Mahasiswa
                    </a>
                    <a href="tambah.php" 
                       class="px-10 py-5 border-2 border-white hover:bg-white hover:text-blue-900 font-semibold text-lg rounded-2xl transition-all flex items-center justify-center gap-3">
                        <i class="fas fa-plus"></i>
                        Tambah Data Mahasiswa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Fitur Unggulan Section -->
    <div class="max-w-6xl mx-auto px-6 py-20">
        <h2 class="text-4xl font-bold text-center mb-16">Fitur Unggulan</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="glass rounded-3xl p-8 hover:scale-105 transition-all duration-300">
                <div class="w-14 h-14 bg-blue-500/20 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-list-check text-3xl text-blue-300"></i>
                </div>
                <h3 class="text-2xl font-semibold mb-3">CRUD Lengkap</h3>
                <p class="text-blue-100">Tambah, Lihat, Edit, dan Hapus data mahasiswa dengan mudah.</p>
            </div>

            <div class="glass rounded-3xl p-8 hover:scale-105 transition-all duration-300">
                <div class="w-14 h-14 bg-blue-500/20 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-search text-3xl text-blue-300"></i>
                </div>
                <h3 class="text-2xl font-semibold mb-3">Pencarian & Sorting</h3>
                <p class="text-blue-100">Cari mahasiswa berdasarkan nama atau NIM, dan urutkan data.</p>
            </div>

            <div class="glass rounded-3xl p-8 hover:scale-105 transition-all duration-300">
                <div class="w-14 h-14 bg-blue-500/20 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-camera text-3xl text-blue-300"></i>
                </div>
                <h3 class="text-2xl font-semibold mb-3">Upload Foto</h3>
                <p class="text-blue-100">Setiap mahasiswa bisa memiliki foto profil.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="glass border-t border-white/20 py-8 text-center text-blue-200 mt-auto">
        <div class="max-w-7xl mx-auto px-6">
            &copy; 2026 Simensa - Admin Data Mahasiswa
        </div>
    </footer>

</body>
</html>