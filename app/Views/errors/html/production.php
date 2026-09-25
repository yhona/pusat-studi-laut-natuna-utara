<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kendala Sistem | NNSRC UMRAH</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="min-h-screen bg-slate-900 text-slate-100 flex flex-col justify-between font-sans relative overflow-x-hidden selection:bg-gold-500 selection:text-navy-950">

    <!-- Ambient Maritime Background Glow -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-maritime-600/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-rose-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Top Utility Bar -->
    <header class="relative z-10 border-b border-white/10 bg-navy-950/80 backdrop-blur-md px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="<?= base_url() ?>" class="flex items-center gap-3 group">
                <img src="<?= base_url('images/logo_umrah.png') ?>" alt="Logo UMRAH" class="w-10 h-10 object-contain drop-shadow">
                <div>
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-gold-400">Pusat Studi Laut Natuna Utara</span>
                    <span class="block text-xs font-bold text-white group-hover:text-gold-300 transition-colors">Universitas Maritim Raja Ali Haji</span>
                </div>
            </a>
            <a href="<?= base_url() ?>" class="text-xs text-slate-300 hover:text-gold-400 transition-colors flex items-center gap-1.5 font-medium">
                <i class="fa-solid fa-house text-[11px]"></i>
                <span class="hidden sm:inline">Beranda</span>
            </a>
        </div>
    </header>

    <!-- Main Hero Section -->
    <main class="relative z-10 flex-grow flex items-center justify-center px-4 py-16 sm:py-24">
        <div class="max-w-xl w-full text-center space-y-6">
            
            <div class="w-24 h-24 mx-auto rounded-3xl bg-navy-950 border-2 border-rose-500/40 shadow-2xl flex items-center justify-center text-rose-400 text-4xl">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>

            <div class="space-y-3">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs font-semibold uppercase tracking-wider">
                    Sistem Sedang Menangani Permintaan
                </span>
                <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Terjadi Kendala Teknis Sementara
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Sistem sedang memproses pemulihan data atau pembaruan berkas riset. Silakan muat ulang halaman dalam beberapa saat atau hubungi tim pengelola melalui kontak resmi.
                </p>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="<?= base_url() ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 font-bold text-xs shadow-lg transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-house"></i>
                    <span>Kembali ke Beranda</span>
                </a>
                <a href="<?= base_url('kontak') ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs border border-white/15 transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-envelope text-gold-400"></i>
                    <span>Hubungi Sekretariat</span>
                </a>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 border-t border-white/10 bg-navy-950/80 backdrop-blur-md px-6 py-4 text-center text-xs text-slate-400">
        <p>© <?= date('Y') ?> Pusat Studi Laut Natuna Utara (NNSRC) — Universitas Maritim Raja Ali Haji</p>
    </footer>

</body>
</html>
