<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 sm:space-y-8 min-w-0">
    
    <!-- Welcome Banner Header -->
    <div class="bg-gradient-to-r from-navy-950 via-navy-900 to-maritime-900 rounded-3xl p-6 sm:p-8 text-white shadow-lg border border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden min-w-0">
        <div class="space-y-2 relative z-10 max-w-2xl min-w-0">
            <span class="text-gold-400 uppercase text-[10px] font-bold tracking-widest block">Dashboard Kendali Konten</span>
            <h2 class="text-xl sm:text-2xl font-extrabold text-white truncate">Selamat Datang, <?= esc(session('admin_name') ?? 'Admin') ?></h2>
            <p class="text-xs text-slate-300 leading-relaxed">
                Kelola seluruh konten riset kemaritiman, publikasi ilmiah, repositori SOP unduhan, serta tinjau pesan kemitraan dan permohonan akses data.
            </p>
        </div>

        <div class="relative z-10 flex flex-wrap items-center gap-3 shrink-0">
            <?php if (!empty($cronStatus)): ?>
            <div class="hidden xl:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white/10 border border-white/15 text-[11px] text-slate-300 font-mono">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Auto-Maintenance: <?= esc($cronStatus['status'] ?? 'Active') ?></span>
            </div>
            <?php endif; ?>
            
            <a href="<?= base_url() ?>" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs border border-white/20 shadow-sm transition-all active:scale-[0.98]">
                <i class="fa-solid fa-arrow-up-right-from-square text-gold-400"></i>
                <span>Lihat Situs Publik</span>
            </a>
        </div>
    </div>

    <!-- Stat Metrics Cards Grid -->
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Statistik & Metrik Konten</h3>
            <span class="text-[11px] text-slate-400 font-mono">Total <?= count($stats) ?> Metrik Terhubung</span>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 2xl:grid-cols-5 gap-3.5 sm:gap-4">
            
            <!-- Total Dewan Peneliti -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Dewan Peneliti">Dewan Peneliti</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_peneliti'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/peneliti') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Klaster Riset -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-atom"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Klaster Riset">Klaster Riset</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_klaster'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/klaster') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Policy Brief & Publikasi -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-file-shield"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Policy Brief & Publikasi">Policy Brief</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_publikasi'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/publikasi') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Jurnal Ilmiah -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Jurnal Ilmiah Kemaritiman">Jurnal Ilmiah</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_jurnal'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/jurnal') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Layanan & Lab -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-cyan-50 text-cyan-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-microchip"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Layanan & Laboratorium">Layanan & Lab</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_layanan'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/layanan') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Berita -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-regular fa-newspaper"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Berita & Agenda">Total Berita</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_berita'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/berita') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Unduhan -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Repositori & SOP Unduhan">Dokumen SOP</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_unduhan'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/unduhan') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Permohonan Unduh -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Permohonan Akses Unduhan">Permohonan</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_permohonan'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/permohonan') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Tinjau</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Banner Slider -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-sliders"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Banner & Slider Beranda">Banner Slider</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_banners'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/banners') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Mitra Kerjasama -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-orange-50 text-orange-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-handshake-simple"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Mitra Kerjasama">Mitra Strategis</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_mitra'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/mitra') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Galeri Riset -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-camera-retro"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Galeri Riset & Dokumentasi">Galeri Riset</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_galeri'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/galeri') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Roadmap Riset -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-violet-50 text-violet-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-timeline"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Roadmap Riset Kemaritiman">Roadmap Riset</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_roadmap'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/roadmap') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Capaian Statistik & KPI -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-chart-simple"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="KPI & Statistik Capaian">KPI & Statistik</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_statistik'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/statistik') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Admin Users -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Pengguna Administrator">Pengguna Admin</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_users'] ?? '1') ?></span>
                    <a href="<?= base_url('admin/users') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Total Activity Logs -->
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-3 sm:gap-3.5 hover:border-maritime-500 hover:shadow-md transition-all min-w-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center text-base sm:text-lg shrink-0">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-[11px] text-slate-500 font-semibold block truncate" title="Audit Trail & Log Aktivitas">Audit Trail Log</span>
                    <span class="text-lg sm:text-xl font-extrabold text-navy-950 font-mono block tracking-tight"><?= esc($stats['total_logs'] ?? '0') ?></span>
                    <a href="<?= base_url('admin/logs') ?>" class="text-[11px] text-maritime-700 hover:text-maritime-800 font-medium inline-flex items-center gap-1 group mt-0.5">
                        <span>Tinjau</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Quick Management Action Hub -->
    <div class="bg-white p-5 sm:p-6 lg:p-7 rounded-3xl border border-slate-200 shadow-xs space-y-4 min-w-0">
        <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h3 class="text-sm font-bold text-navy-950">Aksi Cepat Pengaturan Konten & Akses</h3>
                <p class="text-[11px] text-slate-500 mt-0.5">Pintasan praktis untuk menambah konten baru dan memperbarui konfigurasi sistem</p>
            </div>
            <span class="text-[10px] font-mono text-slate-400 bg-slate-100 px-2.5 py-1 rounded-lg shrink-0">12 Pintasan Operasional</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
            <a href="<?= base_url('admin/identitas') ?>" 
               class="p-3.5 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50 hover:bg-white min-w-0">
                <div class="w-9 h-9 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-address-card"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-xs text-navy-950 truncate group-hover:text-maritime-700 transition-colors">Identitas & Kontak</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 truncate">Alamat, jam & medsos</p>
                </div>
            </a>

            <a href="<?= base_url('admin/users') ?>" 
               class="p-3.5 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50 hover:bg-white min-w-0">
                <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-xs text-navy-950 truncate group-hover:text-maritime-700 transition-colors">Kelola Pengguna</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 truncate">Akun & hak akses admin</p>
                </div>
            </a>

            <a href="<?= base_url('admin/logs') ?>" 
               class="p-3.5 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50 hover:bg-white min-w-0">
                <div class="w-9 h-9 rounded-xl bg-slate-200 text-slate-800 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-xs text-navy-950 truncate group-hover:text-maritime-700 transition-colors">Audit Trail Log</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 truncate">Rekam jejak sistem</p>
                </div>
            </a>

            <a href="<?= base_url('admin/sambutan') ?>" 
               class="p-3.5 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50 hover:bg-white min-w-0">
                <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-xs text-navy-950 truncate group-hover:text-maritime-700 transition-colors">Sambutan Pimpinan</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 truncate">Pengantar & visi pimpinan</p>
                </div>
            </a>

            <a href="<?= base_url('admin/berita/create') ?>" 
               class="p-3.5 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50 hover:bg-white min-w-0">
                <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-xs text-navy-950 truncate group-hover:text-maritime-700 transition-colors">Tambah Berita</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 truncate">Rilis agenda & ekspedisi</p>
                </div>
            </a>

            <a href="<?= base_url('admin/publikasi/create') ?>" 
               class="p-3.5 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50 hover:bg-white min-w-0">
                <div class="w-9 h-9 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-file-circle-plus"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-xs text-navy-950 truncate group-hover:text-maritime-700 transition-colors">Tambah Policy Brief</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 truncate">Rilis kajian kebijakan baru</p>
                </div>
            </a>

            <a href="<?= base_url('admin/unduhan/create') ?>" 
               class="p-3.5 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50 hover:bg-white min-w-0">
                <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-upload"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-xs text-navy-950 truncate group-hover:text-maritime-700 transition-colors">Tambah SOP</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 truncate">Unggah dokumen repositori</p>
                </div>
            </a>

            <a href="<?= base_url('admin/peneliti/create') ?>" 
               class="p-3.5 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50 hover:bg-white min-w-0">
                <div class="w-9 h-9 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-xs text-navy-950 truncate group-hover:text-maritime-700 transition-colors">Tambah Peneliti</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 truncate">Daftarkan dewan pakar baru</p>
                </div>
            </a>

            <a href="<?= base_url('admin/roadmap/create') ?>" 
               class="p-3.5 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50 hover:bg-white min-w-0">
                <div class="w-9 h-9 rounded-xl bg-violet-100 text-violet-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-timeline"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-xs text-navy-950 truncate group-hover:text-maritime-700 transition-colors">Tambah Roadmap</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 truncate">Fase riset kemaritiman</p>
                </div>
            </a>

            <a href="<?= base_url('admin/banners/create') ?>" 
               class="p-3.5 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50 hover:bg-white min-w-0">
                <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-sliders"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-xs text-navy-950 truncate group-hover:text-maritime-700 transition-colors">Tambah Banner</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 truncate">Sorotan beranda baru</p>
                </div>
            </a>

            <a href="<?= base_url('admin/mitra/create') ?>" 
               class="p-3.5 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50 hover:bg-white min-w-0">
                <div class="w-9 h-9 rounded-xl bg-orange-100 text-orange-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-handshake-simple"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-xs text-navy-950 truncate group-hover:text-maritime-700 transition-colors">Tambah Mitra</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 truncate">Kemitraan strategis baru</p>
                </div>
            </a>

            <a href="<?= base_url('admin/galeri/create') ?>" 
               class="p-3.5 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50 hover:bg-white min-w-0">
                <div class="w-9 h-9 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-bold text-xs text-navy-950 truncate group-hover:text-maritime-700 transition-colors">Dokumentasi Galeri</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 truncate">Foto ekspedisi baru</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Data Grids (Permohonan & Kontak) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 min-w-0">
        
        <!-- Tabel Permohonan Unduh Terakhir -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200 shadow-xs space-y-4 min-w-0 overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 gap-2">
                <div class="min-w-0">
                    <h3 class="text-sm font-bold text-navy-950 flex items-center gap-2 truncate">
                        <i class="fa-solid fa-envelope-open-text text-maritime-600 shrink-0"></i>
                        <span class="truncate">Permohonan Unduh Terbaru</span>
                    </h3>
                    <span class="text-[11px] text-slate-400 block truncate">Tinjauan izin akses dokumen SOP & berkas riset</span>
                </div>
                <a href="<?= base_url('admin/permohonan') ?>" class="text-xs text-maritime-700 font-bold hover:underline shrink-0">Lihat Semua</a>
            </div>

            <?php if (empty($recentPermohonan)): ?>
            <p class="text-xs text-slate-400 py-6 text-center italic">Belum ada permohonan unduh yang tercatat.</p>
            <?php else: ?>
            <div class="divide-y divide-slate-100 text-xs">
                <?php foreach ($recentPermohonan as $req): ?>
                <div class="py-3 flex items-start justify-between gap-3 min-w-0">
                    <div class="space-y-1 min-w-0 flex-1">
                        <div class="font-bold text-navy-950 truncate"><?= esc($req['applicant_name']) ?></div>
                        <div class="text-[11px] text-slate-500 truncate"><?= esc($req['applicant_institution']) ?> &bull; <?= esc($req['applicant_email']) ?></div>
                        <div class="text-[11px] text-slate-700 font-mono font-medium truncate"><?= esc($req['document_title']) ?></div>
                    </div>
                    <span class="text-[10px] px-2 py-0.5 rounded-full font-bold uppercase shrink-0 <?= $req['email_status'] === 'sent' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' ?>">
                        <?= esc($req['email_status']) ?>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Tabel Pesan Kerjasama Terakhir -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200 shadow-xs space-y-4 min-w-0 overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 gap-2">
                <div class="min-w-0">
                    <h3 class="text-sm font-bold text-navy-950 flex items-center gap-2 truncate">
                        <i class="fa-solid fa-handshake-angle text-maritime-600 shrink-0"></i>
                        <span class="truncate">Pesan Kerjasama Terakhir</span>
                    </h3>
                    <span class="text-[11px] text-slate-400 block truncate">Pengajuan kemitraan dari portal publik</span>
                </div>
                <a href="<?= base_url('admin/kontak') ?>" class="text-xs text-maritime-700 font-bold hover:underline shrink-0">Lihat Semua</a>
            </div>

            <?php if (empty($recentKontak)): ?>
            <p class="text-xs text-slate-400 py-6 text-center italic">Belum ada pesan kerjasama masuk.</p>
            <?php else: ?>
            <div class="divide-y divide-slate-100 text-xs">
                <?php foreach ($recentKontak as $k): ?>
                <div class="py-3 flex items-start justify-between gap-3 min-w-0">
                    <div class="space-y-1 min-w-0 flex-1">
                        <div class="font-bold text-navy-950 truncate"><?= esc($k['nama']) ?> <span class="text-slate-500 font-normal">(<?= esc($k['instansi']) ?>)</span></div>
                        <div class="text-[11px] text-slate-500 truncate"><?= esc($k['kategori']) ?> &bull; <?= esc($k['email']) ?></div>
                        <div class="text-[11px] text-slate-600 truncate italic">"<?= esc($k['pesan']) ?>"</div>
                    </div>
                    <span class="text-[10px] px-2 py-0.5 rounded-full font-bold uppercase shrink-0 <?= $k['status'] === 'baru' ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-slate-100 text-slate-700' ?>">
                        <?= esc($k['status']) ?>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Audit Trail & Log Aktivitas Terbaru -->
    <div class="bg-white rounded-3xl p-5 sm:p-6 lg:p-8 border border-slate-200 shadow-xs space-y-4 min-w-0 overflow-hidden">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3 gap-2">
            <div class="min-w-0">
                <h3 class="text-sm font-bold text-navy-950 flex items-center gap-2 truncate">
                    <i class="fa-solid fa-list-check text-maritime-600 shrink-0"></i>
                    <span class="truncate">Log Aktivitas & Audit Trail Terbaru</span>
                </h3>
                <span class="text-[11px] text-slate-400 block truncate">Rekam jejak autentikasi dan mutasi data administratif</span>
            </div>
            <a href="<?= base_url('admin/logs') ?>" class="text-xs text-maritime-700 font-bold hover:underline shrink-0">Lihat Semua Log</a>
        </div>

        <?php if (empty($recentLogs)): ?>
        <p class="text-xs text-slate-400 py-6 text-center italic">Belum ada catatan aktivitas admin yang terekam.</p>
        <?php else: ?>
        <div class="divide-y divide-slate-100 text-xs">
            <?php foreach ($recentLogs as $log): ?>
            <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2 min-w-0">
                <div class="space-y-1 min-w-0 flex-1">
                    <div class="flex items-center gap-2 flex-wrap min-w-0">
                        <span class="font-bold text-navy-950 truncate"><?= esc($log['admin_name'] ?? 'System') ?></span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700 font-mono shrink-0">
                            <?= esc($log['action']) ?>
                        </span>
                    </div>
                    <div class="text-[11px] text-slate-600 truncate"><?= esc($log['description']) ?></div>
                </div>
                <div class="text-[10px] text-slate-400 sm:text-right shrink-0 font-mono">
                    <div><?= date('d M Y, H:i', strtotime($log['created_at'])) ?> WIB</div>
                    <div>IP: <?= esc($log['ip_address'] ?? '127.0.0.1') ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>
