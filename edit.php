<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

if (!isset($_GET['nim'])) { header("Location: daftar.php"); exit; }
$nim = mysqli_real_escape_string($conn, $_GET['nim']);
$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$nim'");
$data = mysqli_fetch_assoc($query);

if (!$data) { echo "<script>alert('Data tidak ditemukan!'); window.location.href='daftar.php';</script>"; exit; }

if (isset($_POST['update'])) {
    $nama    = mysqli_real_escape_string($conn, $_POST['nama']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $alamat  = mysqli_real_escape_string($conn, $_POST['alamat']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $file_ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allowed  = ['jpg', 'jpeg', 'png'];

        if (in_array($file_ext, $allowed)) {
            $foto_baru = $nim . "_" . time() . "." . $file_ext;
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $foto_baru)) {
                if (!empty($data['foto']) && file_exists("uploads/" . $data['foto'])) { unlink("uploads/" . $data['foto']); }
                $foto = $foto_baru;
            } else { $foto = $data['foto']; }
        } else { echo "<script>alert('Hanya boleh JPG, JPEG, PNG!');</script>"; $foto = $data['foto']; }
    } else { $foto = $data['foto']; }

    $query_update = "UPDATE mahasiswa SET nama='$nama', jurusan='$jurusan', alamat='$alamat', email='$email', foto='$foto' WHERE nim='$nim'";
    if (mysqli_query($conn, $query_update)) { echo "<script>alert('✅ Data diperbarui!'); window.location.href = 'daftar.php';</script>"; } 
    else { echo "<script>alert('❌ Gagal update!');</script>"; }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data - Simensa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>body { background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%); min-height: 100vh; font-family: 'Inter', system-ui, sans-serif;} .glass { background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.25); } .form-input { background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.2); } .form-input:focus { background: rgba(255, 255, 255, 0.15); border-color: #60a5fa; box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.3); outline:none;} .input-readonly { background: rgba(0, 0, 0, 0.3); color: #94a3b8; cursor: not-allowed; }</style>
</head>
<body class="text-white flex flex-col min-h-screen">

    <nav class="glass border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between relative">
            <div class="flex items-center gap-3"><img src="img/logo bimen - Diedit.png" alt="Logo" class="w-11 h-11 rounded-2xl shadow-xl object-contain bg-white/10 p-1"><div><span class="text-2xl font-bold">Layanan</span> <span class="text-2xl font-bold text-blue-300">Simensa</span></div></div>
            <button id="hamburger-btn" class="md:hidden text-white p-2 rounded-lg bg-white/10 border border-white/20 hover:bg-white/20 transition"><i class="fas fa-bars text-xl"></i></button>
            <ul id="nav-menu" class="hidden absolute top-full left-0 w-full glass md:static md:w-auto md:bg-transparent md:border-none md:flex flex-col md:flex-row gap-4 md:gap-8 p-6 md:p-0 text-lg font-medium border-t border-white/20 md:border-t-0 shadow-xl md:shadow-none z-50">
                <li><a href="index.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="daftar.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-list"></i> Daftar</a></li>
                <li><a href="tambah.php" class="hover:text-blue-300 flex items-center gap-2"><i class="fas fa-plus"></i> Tambah</a></li>
                <li class="md:border-l md:border-white/20 md:pl-6"><a href="logout.php" onclick="return confirm('Keluar?')" class="text-red-400 hover:text-red-300 flex items-center gap-2"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="flex-1 flex items-center py-12">
        <div class="max-w-2xl mx-auto px-6 w-full">
            <div class="glass rounded-3xl p-10 md:p-14 relative">
                <a href="daftar.php" class="inline-flex items-center gap-2 text-blue-200 hover:text-white mb-6"><i class="fas fa-arrow-left"></i> Kembali</a>
                <h2 class="text-4xl font-bold text-center mb-2">Edit Data Mahasiswa</h2>
                <form action="" method="POST" enctype="multipart/form-data" class="space-y-6 mt-8">
                    <div class="text-center mb-8">
                        <label class="block text-sm font-medium mb-3">Foto (Opsional)</label>
                        <div id="preview" class="w-40 h-40 mx-auto rounded-2xl overflow-hidden border-4 border-white/30 bg-slate-800 mb-4 relative group">
                            <?php if(!empty($data['foto'])): ?><img id="previewImg" src="uploads/<?= htmlspecialchars($data['foto']) ?>" class="w-full h-full object-cover"><?php else: ?><img id="previewImg" src="" style="display:none;" class="w-full h-full object-cover"><div id="no-photo" class="flex items-center justify-center w-full h-full text-gray-400">No Photo</div><?php endif; ?>
                            <div onclick="document.getElementById('foto').click()" class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center cursor-pointer transition-all"><i class="fas fa-camera text-2xl"></i></div>
                        </div>
                        <input type="file" name="foto" id="foto" accept="image/*" onchange="previewImage(event)" hidden>
                    </div>
                    <div><label class="block text-sm font-medium mb-2">NIM (Readonly)</label><input type="text" value="<?= htmlspecialchars($data['nim']) ?>" readonly class="form-input input-readonly w-full px-5 py-4 rounded-2xl"></div>
                    <div><label class="block text-sm font-medium mb-2">Nama Lengkap</label><input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required class="form-input w-full px-5 py-4 rounded-2xl"></div>
                    <div><label class="block text-sm font-medium mb-2">Jurusan</label><input type="text" name="jurusan" value="<?= htmlspecialchars($data['jurusan']) ?>" required class="form-input w-full px-5 py-4 rounded-2xl"></div>
                    <div><label class="block text-sm font-medium mb-2">Alamat</label><textarea name="alamat" required rows="4" class="form-input w-full px-5 py-4 rounded-2xl resize-none"><?= htmlspecialchars($data['alamat']) ?></textarea></div>
                    <div><label class="block text-sm font-medium mb-2">Email</label><input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" class="form-input w-full px-5 py-4 rounded-2xl"></div>
                    <button type="submit" name="update" class="w-full mt-8 bg-yellow-500 hover:bg-yellow-600 text-slate-900 py-6 rounded-2xl font-bold text-lg flex items-center justify-center gap-3"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
    <footer class="glass border-t border-white/20 py-8 text-center text-blue-200 mt-auto">&copy; 2026 Simensa</footer>
    <script>
        function previewImage(event) { const reader = new FileReader(); const previewImg = document.getElementById('previewImg'); const noPhoto = document.getElementById('no-photo'); reader.onload = function() { previewImg.src = reader.result; previewImg.style.display = 'block'; if(noPhoto) noPhoto.style.display = 'none'; }; reader.readAsDataURL(event.target.files[0]); }
        const btn = document.getElementById('hamburger-btn'); const menu = document.getElementById('nav-menu'); const icon = btn.querySelector('i'); btn.addEventListener('click', () => { menu.classList.toggle('hidden'); menu.classList.toggle('flex'); if(menu.classList.contains('flex')) { icon.classList.remove('fa-bars'); icon.classList.add('fa-times'); } else { icon.classList.remove('fa-times'); icon.classList.add('fa-bars'); } });
    </script>
</body>
</html>