<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard Administrator') ?> - NNSRC UMRAH</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-navy-950/60 backdrop-blur-xs lg:hidden transition-opacity"></div>

    <!-- Sidebar Navigation -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-navy-950 text-white flex flex-col justify-between transition-transform duration-300 ease-in-out shadow-xl border-r border-slate-800 shrink-0">
        
        <!-- Brand Header -->
        <div class="p-6 border-b border-white/10">
            <a href="<?= base_url('admin') ?>" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gold-500/20 border border-gold-400/40 flex items-center justify-center text-gold-400 text-lg group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <div>
                    <h1 class="text-sm font-extrabold text-white tracking-tight leading-tight">NNSRC Admin</h1>
                    <span class="text-[10px] text-gold-400/90 font-medium block">Pusat Studi Laut Natuna Utara</span>
                </div>
            </a>
        </div>

        <!-- Menu Links -->
        <nav class="p-4 space-y-1.5 flex-1 overflow-y-auto text-xs">
            <?php 
                $uri = service('uri');
                $segment2 = $uri->getSegment(2) ?? '';
            ?>
            <a href="<?= base_url('admin') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= empty($segment2) || $segment2 === 'dashboard' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-chart-pie text-sm w-5 text-center"></i>
                <span>Ringkasan & Statistik</span>
            </a>

            <a href="<?= base_url('admin/profil') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'profil' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-landmark text-sm w-5 text-center"></i>
                <span>Profil, MoU & Visi Misi</span>
            </a>

            <a href="<?= base_url('admin/sambutan') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'sambutan' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-bullhorn text-sm w-5 text-center"></i>
                <span>Sambutan Pimpinan</span>
            </a>

            <a href="<?= base_url('admin/peneliti') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'peneliti' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-user-graduate text-sm w-5 text-center"></i>
                <span>Dewan Peneliti & Pakar</span>
            </a>

            <a href="<?= base_url('admin/klaster') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'klaster' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-compass text-sm w-5 text-center"></i>
                <span>Klaster Riset Kemaritiman</span>
            </a>

            <a href="<?= base_url('admin/roadmap') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'roadmap' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-timeline text-sm w-5 text-center"></i>
                <span>Roadmap Riset</span>
            </a>

            <a href="<?= base_url('admin/berita') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'berita' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-regular fa-newspaper text-sm w-5 text-center"></i>
                <span>Kelola Berita & Agenda</span>
            </a>

            <a href="<?= base_url('admin/publikasi') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'publikasi' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-file-shield text-sm w-5 text-center"></i>
                <span>Policy Brief & Publikasi</span>
            </a>

            <a href="<?= base_url('admin/layanan') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'layanan' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-microchip text-sm w-5 text-center"></i>
                <span>Layanan & Laboratorium</span>
            </a>

            <a href="<?= base_url('admin/unduhan') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'unduhan' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-folder-open text-sm w-5 text-center"></i>
                <span>Repositori & SOP Unduhan</span>
            </a>

            <a href="<?= base_url('admin/banners') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'banners' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-sliders text-sm w-5 text-center"></i>
                <span>Banner & Slider Beranda</span>
            </a>

            <a href="<?= base_url('admin/mitra') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'mitra' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-handshake-simple text-sm w-5 text-center"></i>
                <span>Mitra Kerjasama</span>
            </a>

            <a href="<?= base_url('admin/galeri') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'galeri' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-camera-retro text-sm w-5 text-center"></i>
                <span>Galeri Riset & Ekspedisi</span>
            </a>

            <a href="<?= base_url('admin/statistik') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'statistik' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-chart-simple text-sm w-5 text-center"></i>
                <span>Counter Metrik & KPI</span>
            </a>

            <div class="pt-3 pb-1 px-3.5">
                <span class="text-[10px] uppercase font-bold tracking-wider text-slate-500">Aktivitas & Interaksi</span>
            </div>

            <a href="<?= base_url('admin/permohonan') ?>" 
               class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'permohonan' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-envelope-open-text text-sm w-5 text-center"></i>
                    <span>Permohonan Unduh</span>
                </div>
            </a>

            <a href="<?= base_url('admin/kontak') ?>" 
               class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'kontak' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-handshake-angle text-sm w-5 text-center"></i>
                    <span>Pesan Kerjasama</span>
                </div>
            </a>

            <div class="pt-3 pb-1 px-3.5">
                <span class="text-[10px] uppercase font-bold tracking-wider text-slate-500">Sistem & Keamanan</span>
            </div>

            <a href="<?= base_url('admin/identitas') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'identitas' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-address-card text-sm w-5 text-center"></i>
                <span>Identitas & Kontak Situs</span>
            </a>

            <a href="<?= base_url('admin/users') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'users' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-users-gear text-sm w-5 text-center"></i>
                <span>Pengguna Administrator</span>
            </a>

            <a href="<?= base_url('admin/logs') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'logs' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-list-check text-sm w-5 text-center"></i>
                <span>Audit Trail & Log Aktivitas</span>
            </a>

            <a href="<?= base_url('admin/pengaturan') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'pengaturan' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-user-gear text-sm w-5 text-center"></i>
                <span>Pengaturan Profil Akun</span>
            </a>

            <a href="<?= base_url('admin/sistem') ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold <?= $segment2 === 'sistem' ? 'bg-gold-500 text-navy-950 shadow-md font-bold' : 'text-slate-300 hover:bg-white/5 hover:text-white' ?>">
                <i class="fa-solid fa-server text-sm w-5 text-center"></i>
                <span>Status Sistem & Cron (20m)</span>
            </a>

            <div class="pt-3 pb-1 px-3.5">
                <span class="text-[10px] uppercase font-bold tracking-wider text-slate-500">Pintasan Portal</span>
            </div>

            <a href="<?= base_url() ?>" target="_blank"
               class="flex items-center gap-3 px-3.5 py-2 rounded-xl transition-all text-slate-400 hover:text-gold-400 hover:bg-white/5">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs w-5 text-center"></i>
                <span>Buka Web Publik</span>
            </a>
        </nav>

        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-white/10 bg-navy-900/50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-full bg-gold-500 text-navy-950 flex items-center justify-center font-bold text-xs shrink-0">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="truncate">
                        <span class="block text-xs font-bold text-white truncate"><?= esc(session('admin_name') ?? 'Administrator') ?></span>
                        <span class="block text-[10px] text-slate-400 truncate"><?= esc(session('admin_username') ?? 'admin') ?></span>
                    </div>
                </div>
                <a href="<?= base_url('admin/logout') ?>" 
                   onclick="return confirm('Apakah Anda yakin ingin keluar dari panel admin?')"
                   class="p-2 rounded-lg text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 transition-colors"
                   title="Keluar">
                    <i class="fa-solid fa-power-off text-sm"></i>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- Topbar -->
        <header class="h-16 bg-white border-b border-slate-200 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-3">
                <button type="button" @click="sidebarOpen = !sidebarOpen" 
                        class="p-2 rounded-lg text-slate-600 hover:bg-slate-100 lg:hidden cursor-pointer"
                        aria-label="Toggle Sidebar">
                    <i class="fa-solid fa-bars text-base"></i>
                </button>
                <div class="text-xs sm:text-sm font-bold text-navy-950 hidden sm:block">
                    Pusat Studi Laut Natuna Utara UMRAH &bull; Panel Administrasi
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <span class="text-[11px] font-mono text-slate-500 block"><?= date('l, d F Y') ?></span>
                </div>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Sistem Aktif
                </span>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 p-4 sm:p-8 overflow-y-auto">
            
            <!-- Global Flash Alerts -->
            <?php if (!empty(session()->getFlashdata('success'))): ?>
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-3 shadow-xs">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0"></i>
                <span><?= esc(session()->getFlashdata('success')) ?></span>
            </div>
            <?php endif; ?>

            <?php if (!empty(session()->getFlashdata('error'))): ?>
            <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm flex items-center gap-3 shadow-xs">
                <i class="fa-solid fa-triangle-exclamation text-rose-600 text-base shrink-0"></i>
                <span><?= esc(session()->getFlashdata('error')) ?></span>
            </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </main>
    </div>

</body>
</html>
