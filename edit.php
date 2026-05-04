<?php
include 'koneksi.php';

// Ambil NIM dari URL
if (!isset($_GET['nim'])) {
    header("Location: daftar.php");
    exit;
}

$nim = mysqli_real_escape_string($conn, $_GET['nim']);

// Ambil data mahasiswa berdasarkan NIM
$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$nim'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='daftar.php';</script>";
    exit;
}

// Proses Update Data
if (isset($_POST['update'])) {
    $nama    = mysqli_real_escape_string($conn, $_POST['nama']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);

    // Cek apakah user mengupload foto baru
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "uploads/";
        $file_ext   = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allowed    = ['jpg', 'jpeg', 'png'];

        if (in_array($file_ext, $allowed)) {
            $foto_baru   = $nim . "_" . time() . "." . $file_ext;
            $target_file = $target_dir . $foto_baru;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                // Hapus foto lama jika ada
                if (!empty($data['foto']) && file_exists("uploads/" . $data['foto'])) {
                    unlink("uploads/" . $data['foto']);
                }
                
                // Update dengan foto baru
                $query_update = "UPDATE mahasiswa SET nama='$nama', jurusan='$jurusan', email='$email', foto='$foto_baru' WHERE nim='$nim'";
            } else {
                echo "<script>alert('Gagal mengupload foto!');</script>";
            }
        } else {
            echo "<script>alert('Hanya boleh file JPG, JPEG, atau PNG!');</script>";
        }
    } else {
        // Update tanpa ganti foto
        $query_update = "UPDATE mahasiswa SET nama='$nama', jurusan='$jurusan', email='$email' WHERE nim='$nim'";
    }

    if (isset($query_update) && mysqli_query($conn, $query_update)) {
        echo "<script>
                alert('Data mahasiswa berhasil diperbarui!');
                window.location.href = 'daftar.php';
              </script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data - Universitas Bimenesia</title>
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
        /* Style khusus untuk input readonly (NIM) */
        .input-readonly {
            background: rgba(0, 0, 0, 0.2);
            cursor: not-allowed;
            color: #94a3b8;
        }
    </style>
</head>
<body class="text-white">

    <!-- Navbar -->
    <nav class="glass border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-3xl">🎓</span>
                <div>
                    <span class="text-2xl font-bold tracking-tight">Universitas</span>
                    <span class="text-2xl font-bold text-blue-300">Bimenesia</span>
                </div>
            </div>

            <ul class="flex gap-8 text-lg font-medium">
                <li><a href="index.php" class="hover:text-blue-300 transition-all flex items-center gap-2"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="daftar.php" class="hover:text-blue-300 transition-all flex items-center gap-2"><i class="fas fa-list"></i> Daftar Mahasiswa</a></li>
                <li><a href="tambah.php" class="hover:text-blue-300 transition-all flex items-center gap-2"><i class="fas fa-plus"></i> Tambah Data</a></li>
            </ul>
        </div>
    </nav>

    <!-- Form Edit Data -->
    <div class="min-h-[85vh] flex items-center py-12">
        <div class="max-w-2xl mx-auto px-6 w-full">
            <div class="glass rounded-3xl p-10 md:p-14 relative overflow-hidden">
                
                <!-- Tombol Kembali -->
                <a href="daftar.php" class="absolute top-8 left-8 text-blue-200 hover:text-white transition-all flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <h2 class="text-4xl font-bold text-center mb-2 mt-6">Edit Data Mahasiswa</h2>
                <p class="text-blue-200 text-center mb-10">Perbarui informasi mahasiswa di bawah ini</p>

                <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                    
                    <!-- Upload Foto & Preview -->
                    <div class="text-center mb-8">
                        <label class="block text-sm font-medium mb-3 text-blue-100">Foto Profil (Opsional)</label>
                        <div id="preview" class="w-40 h-40 mx-auto rounded-2xl overflow-hidden border-4 border-white/30 bg-slate-800 mb-4 relative group">
                            
                            <!-- Menampilkan foto lama jika ada -->
                            <?php if(!empty($data['foto'])): ?>
                                <img id="previewImg" src="uploads/<?= $data['foto'] ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <img id="previewImg" src="" class="w-full h-full object-cover" style="display:none;">
                                <div id="no-photo" class="flex items-center justify-center w-full h-full text-gray-400 text-sm">Tanpa Foto</div>
                            <?php endif; ?>

                            <!-- Overlay Hover -->
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all cursor-pointer" onclick="document.getElementById('foto').click()">
                                <i class="fas fa-camera text-2xl"></i>
                            </div>
                        </div>
                        <input type="file" name="foto" id="foto" accept="image/*" onchange="previewImage(event)" hidden>
                        <p class="text-xs text-blue-200/70">Biarkan kosong jika tidak ingin mengubah foto.</p>
                    </div>

                    <!-- Input NIM (Readonly) -->
                    <div>
                        <label class="block text-sm font-medium mb-2">NIM (Tidak dapat diubah)</label>
                        <input type="text" name="nim" value="<?= htmlspecialchars($data['nim']) ?>" readonly class="form-input input-readonly w-full px-5 py-4 rounded-2xl">
                    </div>

                    <!-- Input Nama -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required class="form-input w-full px-5 py-4 rounded-2xl text-white">
                    </div>

                    <!-- Input Jurusan -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Jurusan</label>
                        <input type="text" name="jurusan" value="<?= htmlspecialchars($data['jurusan']) ?>" required class="form-input w-full px-5 py-4 rounded-2xl text-white">
                    </div>

                    <!-- Input Email -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required class="form-input w-full px-5 py-4 rounded-2xl text-white">
                    </div>

                    <button type="submit" name="update" 
                            class="w-full mt-8 bg-yellow-500 hover:bg-yellow-600 text-slate-900 py-6 rounded-2xl font-bold text-lg transition-all flex items-center justify-center gap-3 shadow-lg">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Preview Foto -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const previewImg = document.getElementById('previewImg');
            const noPhoto = document.getElementById('no-photo');
            
            reader.onload = function() {
                previewImg.src = reader.result;
                previewImg.style.display = 'block';
                if(noPhoto) noPhoto.style.display = 'none';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</body>
</html>