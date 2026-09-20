<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Login Administrator - NNSRC UMRAH') ?></title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('images/logo_umrah.png') ?>">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .hero-pattern {
            background-image: 
                radial-gradient(rgba(245, 158, 11, 0.12) 1px, transparent 0),
                radial-gradient(rgba(14, 165, 233, 0.12) 1px, transparent 0);
            background-size: 32px 32px;
            background-position: 0 0, 16px 16px;
        }
    </style>
</head>
<body class="bg-navy-950 text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-gold-500 selection:text-navy-950 relative overflow-x-hidden">

    <!-- Ambient Glowing Orbs Background -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-maritime-600/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -right-40 w-96 h-96 bg-gold-500/15 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 left-1/3 w-96 h-96 bg-navy-800/40 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 hero-pattern opacity-40"></div>
    </div>

    <!-- Top Minimal Navigation -->
    <header class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 flex items-center justify-between">
        <a href="<?= base_url() ?>" class="flex items-center gap-3 group transition-transform hover:scale-[1.02]">
            <img src="<?= base_url('images/logo_umrah.png') ?>" alt="Logo UMRAH" class="w-9 sm:w-11 h-9 sm:h-11 object-contain shrink-0 drop-shadow-md">
            <div>
                <span class="block text-[11px] sm:text-xs font-bold text-gold-400 uppercase tracking-wider">Pusat Studi Laut Natuna Utara</span>
                <span class="block text-[10px] sm:text-[11px] text-slate-300 font-medium">Universitas Maritim Raja Ali Haji</span>
            </div>
        </a>
        <a href="<?= base_url() ?>" 
           class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-xl text-xs font-semibold text-slate-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-all shadow-xs">
            <i class="fa-solid fa-house text-[11px]"></i>
            <span class="hidden sm:inline">Kembali ke</span> Portal Publik
        </a>
    </header>

    <!-- Main Container: 2-Column Responsive Split Screen on Desktop, Compact on Mobile -->
    <main class="relative z-10 w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 my-auto py-6 sm:py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 rounded-3xl overflow-hidden shadow-2xl border border-white/15 bg-navy-900/60 backdrop-blur-xl">
            
            <!-- Left Branding & Context Showcase (Desktop & Tablet) -->
            <div class="lg:col-span-6 relative p-8 sm:p-12 flex flex-col justify-between overflow-hidden bg-gradient-to-br from-navy-950 via-navy-900 to-maritime-900 text-white border-b lg:border-b-0 lg:border-r border-white/10">
                <!-- Background visual overlay -->
                <div class="absolute inset-0 opacity-20 bg-cover bg-center pointer-events-none mix-blend-overlay" style="background-image: url('<?= base_url('images/hero_ship.jpg') ?>');"></div>
                
                <div class="relative z-10 space-y-6">
                    <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-gold-500/15 border border-gold-500/30 text-gold-400 text-xs font-bold tracking-wide">
                        <span class="w-2 h-2 rounded-full bg-gold-400 animate-pulse"></span>
                        <span>Sistem Manajemen Konten (CMS)</span>
                    </div>

                    <div class="space-y-3">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white tracking-tight leading-snug">
                            Panel Kendali Riset & Publikasi Maritim
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                            Portal terintegrasi pengelolaan riset perbatasan, pengesahan permohonan unduh dokumen naskah kebijakan, dan pelaporan otomatisasi berkala 20 menit.
                        </p>
                    </div>

                    <!-- Highlight Badges -->
                    <div class="space-y-2.5 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10 text-xs">
                            <div class="w-8 h-8 rounded-xl bg-gold-500/20 text-gold-400 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-clock-rotate-left text-sm"></i>
                            </div>
                            <div class="min-w-0">
                                <span class="font-bold text-white block">Otomatisasi Cron 20 Menit</span>
                                <span class="text-[11px] text-slate-300 block truncate">Disposisi email permohonan & pembersihan cache</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10 text-xs">
                            <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-shield-halved text-sm"></i>
                            </div>
                            <div class="min-w-0">
                                <span class="font-bold text-white block">Keamanan Kredensial BCRYPT</span>
                                <span class="text-[11px] text-slate-300 block truncate">Audit sesi dan perlindungan token CSRF</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Quotes from Gurindam 12 -->
                <div class="relative z-10 pt-6 mt-6 border-t border-white/10">
                    <p class="text-xs font-serif italic text-gold-200">
                        "Jika hendak mengenal orang yang berilmu, bertanya dan belajar tiadalah jemu."
                    </p>
                    <span class="text-[10px] text-slate-400 font-sans mt-1 block">
                        — Gurindam 12 Pasal 5 (Raja Ali Haji)
                    </span>
                </div>
            </div>

            <!-- Right Interactive Form Card -->
            <div class="lg:col-span-6 p-6 sm:p-10 lg:p-12 glass-panel flex flex-col justify-center" 
                 x-data="{ showPass: false, submitting: false }">
                
                <div class="max-w-md w-full mx-auto space-y-6">
                    
                    <!-- Form Title & Badge -->
                    <div class="space-y-1">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl sm:text-2xl font-black text-navy-950 tracking-tight">Masuk Akun</h2>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-navy-100 text-navy-800">
                                <i class="fa-solid fa-lock text-[10px]"></i> Area Terbatas
                            </span>
                        </div>
                        <p class="text-xs text-slate-500">
                            Masukkan username atau email resmi serta kata sandi Anda.
                        </p>
                    </div>

                    <!-- Alerts Container -->
                    <?php if (!empty($error)): ?>
                    <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-start gap-3 shadow-xs">
                        <i class="fa-solid fa-circle-exclamation text-rose-600 text-base mt-0.5 shrink-0"></i>
                        <div class="leading-relaxed font-medium"><?= esc($error) ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($success)): ?>
                    <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-start gap-3 shadow-xs">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5 shrink-0"></i>
                        <div class="leading-relaxed font-medium"><?= esc($success) ?></div>
                    </div>
                    <?php endif; ?>

                    <!-- Login Form -->
                    <form action="<?= base_url('admin/login-action') ?>" method="POST" 
                          @submit="submitting = true" class="space-y-4">
                        <?= csrf_field() ?>

                        <!-- Username / Email Field -->
                        <div class="space-y-1.5">
                            <label for="username" class="block text-xs font-bold text-slate-700">
                                Nama Pengguna / Email Resmi <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-user-shield text-xs"></i>
                                </span>
                                <input type="text" id="username" name="username" 
                                       value="<?= old('username') ?>" required autofocus
                                       placeholder="admin_nnsrc atau email"
                                       autocomplete="username"
                                       class="w-full pl-10 pr-4 py-3 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-maritime-500 bg-slate-50/70 focus:bg-white transition-all text-slate-900 font-medium">
                            </div>
                        </div>

                        <!-- Password Field with Toggle Show/Hide -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-xs font-bold text-slate-700">
                                    Kata Sandi <span class="text-rose-500">*</span>
                                </label>
                                <button type="button" @click="showPass = !showPass" 
                                        tabindex="-1"
                                        class="text-[11px] font-semibold text-maritime-700 hover:text-maritime-900 transition-colors flex items-center gap-1 cursor-pointer">
                                    <i class="fa-solid" :class="showPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    <span x-text="showPass ? 'Sembunyikan' : 'Lihat Sandi'"></span>
                                </button>
                            </div>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-key text-xs"></i>
                                </span>
                                <input :type="showPass ? 'text' : 'password'" id="password" name="password" required
                                       placeholder="••••••••••••"
                                       autocomplete="current-password"
                                       class="w-full pl-10 pr-10 py-3 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-maritime-500 bg-slate-50/70 focus:bg-white transition-all text-slate-900 font-medium font-mono">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" :disabled="submitting"
                                    class="w-full py-3 sm:py-3.5 px-4 rounded-xl font-bold text-xs sm:text-sm bg-navy-950 hover:bg-navy-900 active:scale-[0.98] text-gold-400 hover:text-white shadow-lg shadow-navy-950/20 transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-75 disabled:cursor-not-allowed">
                                <template x-if="!submitting">
                                    <span class="inline-flex items-center gap-2">
                                        <span>Masuk ke Dashboard</span>
                                        <i class="fa-solid fa-arrow-right text-xs"></i>
                                    </span>
                                </template>
                                <template x-if="submitting">
                                    <span class="inline-flex items-center gap-2">
                                        <i class="fa-solid fa-circle-notch fa-spin text-xs"></i>
                                        <span>Memverifikasi Kredensial...</span>
                                    </span>
                                </template>
                            </button>
                        </div>
                    </form>

                    <!-- Bottom Assist & Info -->
                    <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
                        <a href="<?= base_url() ?>" class="hover:text-maritime-700 flex items-center gap-1.5 font-medium transition-colors">
                            <i class="fa-solid fa-arrow-left text-[10px]"></i>
                            <span>Kembali ke Beranda Utama</span>
                        </a>
                        <span class="font-mono text-[11px] text-slate-400 bg-slate-100 px-2 py-0.5 rounded-md">
                            NNSRC CMS v2.4
                        </span>
                    </div>

                </div>

            </div>

        </div>
    </main>

    <!-- Bottom Copyright -->
    <footer class="relative z-10 w-full max-w-7xl mx-auto px-4 py-4 text-center text-[11px] text-slate-400">
        &copy; <?= date('Y') ?> Pusat Studi Laut Natuna Utara &bull; Universitas Maritim Raja Ali Haji (UMRAH). Seluruh hak cipta dilindungi.
    </footer>

</body>
</html>
