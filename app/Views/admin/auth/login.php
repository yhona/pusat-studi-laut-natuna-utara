<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Login Administrator') ?></title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-navy-950 via-slate-900 to-navy-900 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <!-- Brand Header -->
        <div class="text-center mb-8 space-y-3">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 border border-gold-500/30 shadow-lg text-gold-400 text-2xl mb-2">
                <i class="fa-solid fa-compass"></i>
            </div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight">Panel Administrasi Konten</h1>
            <p class="text-xs text-slate-300">Pusat Studi Laut Natuna Utara (NNSRC UMRAH)</p>
        </div>

        <!-- Card Form -->
        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-2xl border border-slate-200/20 space-y-6">
            
            <div class="border-b border-slate-100 pb-4">
                <h2 class="text-lg font-bold text-navy-950">Masuk ke Sistem</h2>
                <p class="text-xs text-slate-500 mt-0.5">Gunakan kredensial pengelola resmi Anda untuk melanjutkan.</p>
            </div>

            <!-- Flash Error -->
            <?php if (!empty($error)): ?>
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-start gap-3">
                <i class="fa-solid fa-circle-exclamation text-rose-600 text-base mt-0.5 shrink-0"></i>
                <div class="leading-relaxed"><?= esc($error) ?></div>
            </div>
            <?php endif; ?>

            <!-- Flash Success -->
            <?php if (!empty($success)): ?>
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-start gap-3">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5 shrink-0"></i>
                <div class="leading-relaxed"><?= esc($success) ?></div>
            </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/login-action') ?>" method="POST" class="space-y-4">
                <?= csrf_field() ?>

                <div class="space-y-1.5">
                    <label for="username" class="block text-xs font-bold text-slate-700">Nama Pengguna atau Email</label>
                    <div class="relative">
                        <input type="text" id="username" name="username" value="<?= old('username') ?>" required autofocus
                               placeholder="admin_nnsrc atau email"
                               class="w-full pl-10 pr-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-slate-50/50">
                        <i class="fa-solid fa-user absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-bold text-slate-700">Kata Sandi</label>
                    </div>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                               placeholder="••••••••••••"
                               class="w-full pl-10 pr-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-slate-50/50">
                        <i class="fa-solid fa-lock absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-3 px-4 bg-navy-950 hover:bg-maritime-700 text-gold-400 hover:text-white rounded-xl font-bold text-xs shadow-md transition-all active:scale-[0.98] flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        <span>Masuk ke Dashboard</span>
                    </button>
                </div>
            </form>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                <a href="<?= base_url() ?>" class="hover:text-maritime-700 flex items-center gap-1 transition-colors">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Beranda
                </a>
                <span class="font-mono text-[10px] text-slate-400">NNSRC v2.4</span>
            </div>
        </div>

        <!-- Security Note -->
        <p class="text-center text-[11px] text-slate-400 mt-6">
            Akses portal ini diproteksi dan diaudit secara berkala untuk menjaga keaslian data publikasi ilmiah.
        </p>
    </div>

</body>
</html>
