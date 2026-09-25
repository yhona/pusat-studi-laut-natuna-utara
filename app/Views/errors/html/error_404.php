<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | NNSRC UMRAH</title>
    
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
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gold-500/15 rounded-full blur-3xl"></div>
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
                <span class="hidden sm:inline">Kembali ke Beranda</span>
            </a>
        </div>
    </header>

    <!-- Main 404 Hero Section -->
    <main class="relative z-10 flex-grow flex items-center justify-center px-4 py-16 sm:py-24">
        <div class="max-w-2xl w-full text-center space-y-8">
            
            <!-- Graphic Emblem -->
            <div class="relative inline-block">
                <div class="w-28 h-28 sm:w-36 sm:h-36 mx-auto rounded-3xl bg-gradient-to-tr from-navy-950 via-maritime-900 to-navy-800 border-2 border-gold-500/40 shadow-2xl flex items-center justify-center text-gold-400 text-5xl sm:text-6xl relative z-10">
                    <i class="fa-solid fa-compass animate-spin-slow"></i>
                </div>
                <div class="absolute -top-3 -right-3 px-3 py-1 rounded-full bg-rose-500/90 text-white font-mono font-extrabold text-xs shadow-lg border border-rose-400/40">
                    404
                </div>
            </div>

            <!-- Heading & Message -->
            <div class="space-y-3">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-500/10 border border-gold-500/20 text-gold-400 text-xs font-semibold uppercase tracking-widest">
                    <i class="fa-solid fa-water text-[10px]"></i> Navigasi Keluar Jalur • Lost at Sea
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
                    Halaman Tidak Ditemukan
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm max-w-lg mx-auto leading-relaxed">
                    Tautan yang Anda tuju mungkin telah dipindahkan, diubah jalurnya, atau berkas telah diarsipkan ke dalam repositori resmi yang baru.
                </p>
                <p class="text-slate-400 text-xs italic max-w-md mx-auto">
                    The coordinate or document you requested does not exist or has been relocated to another maritime research cluster.
                </p>
            </div>

            <!-- Quick Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="<?= base_url() ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 font-bold text-xs sm:text-sm shadow-xl hover:shadow-gold-500/20 transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-house"></i>
                    <span>Beranda Utama</span>
                </a>
                <a href="<?= base_url('riset') ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs sm:text-sm border border-white/15 transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-compass text-gold-400"></i>
                    <span>Klaster Riset</span>
                </a>
                <a href="<?= base_url('publikasi') ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs sm:text-sm border border-white/15 transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-file-shield text-gold-400"></i>
                    <span>Policy Brief</span>
                </a>
                <a href="<?= base_url('unduhan') ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs sm:text-sm border border-white/15 transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-folder-open text-gold-400"></i>
                    <span>Repositori Dokumen</span>
                </a>
            </div>

            <!-- Safe Back Link -->
            <div class="pt-4">
                <button onclick="window.history.length > 1 ? window.history.back() : window.location.href='<?= base_url() ?>'" 
                        class="text-xs text-slate-400 hover:text-gold-400 transition-colors inline-flex items-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali ke halaman sebelumnya</span>
                </button>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 border-t border-white/10 bg-navy-950/80 backdrop-blur-md px-6 py-4 text-center text-xs text-slate-400">
        <p>© <?= date('Y') ?> Pusat Studi Laut Natuna Utara (NNSRC) — Universitas Maritim Raja Ali Haji (UMRAH)</p>
    </footer>

</body>
</html>
