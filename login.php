<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['login'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Simensa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%); min-height: 100vh; font-family: 'Inter', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.25); }
    </style>
</head>
<body class="flex items-center justify-center text-white">
    <div class="glass p-10 rounded-3xl w-full max-w-md shadow-2xl mx-6">
        <div class="text-center mb-8">
            <span class="text-5xl">🎓</span>
            <h2 class="text-3xl font-bold mt-4">Login Admin</h2>
            <p class="text-blue-200">Silakan masuk ke Layanan Simensa</p>
        </div>

        <?php if (isset($error)) : ?>
            <div class="bg-red-500/20 border border-red-500 text-red-200 p-3 rounded-xl mb-6 text-center text-sm shadow-inner">
                Username atau password salah!
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-5">
            <div>
                <input type="text" name="username" placeholder="Username " required class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 focus:border-blue-400 focus:bg-white/20 focus:outline-none text-white transition-all">
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 focus:border-blue-400 focus:bg-white/20 focus:outline-none text-white transition-all">
            </div>
            <button type="submit" name="login" class="w-full bg-blue-600 hover:bg-blue-700 py-3 mt-4 rounded-xl font-bold transition-all shadow-lg flex justify-center items-center gap-2">
                Masuk <i class="fas fa-sign-in-alt"></i>
            </button>
        </form>
    </div>
</body>
</html>