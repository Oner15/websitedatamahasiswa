<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MahasiswaDB - Universitas Bimenesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            min-height: 100vh;
        }
        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        .hero-bg {
            background: linear-gradient(to bottom, rgba(30, 27, 75, 0.9), rgba(49, 46, 129, 0.95));
        }
    </style>
</head>
<body class="text-white">

    <!-- Navbar -->
    <nav class="glass border-b border-white/10 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            
            <!-- Logo Baru -->
           <div class="flex items-center gap-3">
            <img src="img/logo bimen - Diedit.png" 
                 alt="Logo Universitas Bimenesia" 
                 class="w-10 h-10 md:w-12 md:h-12 rounded-2xl shadow-xl object-contain bg-white/10 p-1.5 transition-all duration-300 hover:scale-105">
                <!-- Jika ingin pakai emoji langsung (lebih ringan): -->
                <!-- 
                <div class="w-11 h-11 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center text-3xl shadow-lg">
                    👨‍🎓
                </div>
                -->
                <div>
                    <span class="text-2xl font-bold tracking-tight">Universitas</span>
                    <span class="text-2xl font-bold text-purple-300">Bimenesia</span>
                </div>
            </div>

            <ul class="flex gap-8 text-lg">
                <li><a href="index.php" class="hover:text-purple-300 transition-colors font-medium flex items-center gap-2">
                    <i class="fas fa-home"></i> Home
                </a></li>
                <li><a href="daftar.php" class="hover:text-purple-300 transition-colors font-medium flex items-center gap-2">
                    <i class="fas fa-list"></i> Daftar Mahasiswa
                </a></li>
                <li><a href="tambah.php" class="hover:text-purple-300 transition-colors font-medium flex items-center gap-2">
                    <i class="fas fa-plus"></i> Tambah Data
                </a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-bg min-h-[90vh] flex items-center">
        <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
            <div class="glass rounded-3xl p-12 max-w-2xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                    Selamat Datang di<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-300">UNIVERSITAS BIMENSIA</span>
                </h1>
                
                <p class="text-xl text-purple-100 mb-10 leading-relaxed">
                    Sistem manajemen data mahasiswa berbasis web yang modern, responsif, 
                    dan dirancang untuk memudahkan pengelolaan data akademik Universitas Bimenesia.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="daftar.php" 
                       class="px-10 py-5 bg-white text-indigo-700 font-semibold text-lg rounded-2xl hover:bg-indigo-50 transition-all duration-300 shadow-2xl flex items-center justify-center gap-3">
                        <i class="fas fa-users"></i>
                        Lihat Daftar Mahasiswa
                    </a>
                    <a href="tambah.php" 
                       class="px-10 py-5 border-2 border-white/80 hover:border-white font-semibold text-lg rounded-2xl transition-all duration-300 flex items-center justify-center gap-3">
                        <i class="fas fa-plus"></i>
                        Tambah Data Mahasiswa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="glass border-t border-white/10 py-8 text-center text-purple-200">
        <div class="max-w-7xl mx-auto px-6">
            &copy; 2026 Universitas Bimenesia - Admin Panel MahasiswaDB
        </div>
    </footer>

</body>
</html>