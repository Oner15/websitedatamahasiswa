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
            background: linear-gradient(to bottom, rgba(15, 23, 42, 0.85), rgba(30, 64, 175, 0.90));
            min-height: 92vh;
        }

        /* Animasi Teks */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }

        .delay-200 { animation-delay: 200ms; }
        .delay-400 { animation-delay: 400ms; }
        .delay-600 { animation-delay: 600ms; }
    </style>
</head>
<body class="flex flex-col text-white">

    <!-- Navbar -->
    <nav class="glass border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="img/logo bimen - Diedit.png" 
                     alt="Logo Universitas Bimenesia" 
                     class="w-11 h-11 rounded-2xl shadow-xl object-contain bg-white/10 p-1">
                <div>
                    <span class="text-2xl font-bold">Universitas</span>
                    <span class="text-2xl font-bold text-blue-200">Bimenesia</span>
                </div>
            </div>

            <ul class="flex gap-8 text-lg font-medium">
                <li><a href="index.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="daftar.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-list"></i> Daftar Mahasiswa</a></li>
                <li><a href="tambah.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-plus"></i> Tambah Data</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1">
        <div class="hero-bg flex items-center">
            <div class="max-w-5xl mx-auto px-6 text-center">
                <div class="glass rounded-3xl p-14 max-w-3xl mx-auto">
                    
                    <!-- Teks yang Beranimasi -->
                    <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-3 animate-fade-in-up">
                        Selamat Datang di
                    </h1>
                    <h1 class="text-5xl md:text-6xl font-bold leading-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-white animate-fade-in-up delay-200">
                        Bimensia University
                    </h1>
                    
                    <p class="text-xl text-blue-100 mb-12 mt-8 animate-fade-in-up delay-400">
                        Sistem manajemen data mahasiswa berbasis web yang modern, responsif, 
                        dan dirancang untuk memudahkan pengelolaan data akademik Universitas Bimenesia.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-5 justify-center animate-fade-in-up delay-600">
                        <a href="daftar.php" 
                           class="px-12 py-6 bg-blue-600 hover:bg-blue-700 font-semibold text-lg rounded-2xl transition-all flex items-center justify-center gap-3">
                            <i class="fas fa-users"></i>
                            Lihat Daftar Mahasiswa
                        </a>
                        <a href="tambah.php" 
                           class="px-12 py-6 border-2 border-white hover:bg-white hover:text-blue-900 font-semibold text-lg rounded-2xl transition-all flex items-center justify-center gap-3">
                            <i class="fas fa-plus"></i>
                            Tambah Data Mahasiswa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="glass border-t border-white/20 py-8 text-center text-blue-200 mt-auto">
        <div class="max-w-7xl mx-auto px-6">
            &copy; 2026 Universitas Bimenesia - Admin Panel MahasiswaDB
        </div>
    </footer>

</body>
</html>