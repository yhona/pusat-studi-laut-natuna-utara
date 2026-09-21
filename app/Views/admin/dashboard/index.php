<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-8">
    
    <!-- Welcome Banner & Cron Action Header -->
    <div class="bg-gradient-to-r from-navy-950 via-navy-900 to-maritime-900 rounded-3xl p-6 sm:p-8 text-white shadow-lg border border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
        <div class="space-y-2 relative z-10 max-w-xl">
            <span class="text-gold-400 uppercase text-[10px] font-bold tracking-widest block">Dashboard Kendali Konten</span>
            <h2 class="text-xl sm:text-2xl font-extrabold text-white">Selamat Datang, <?= esc(session('admin_name') ?? 'Admin') ?></h2>
            <p class="text-xs text-slate-300 leading-relaxed">
                Kelola seluruh konten, publikasi kebijakan, berkas repositori unduhan, serta tinjau permohonan akses dari para peneliti dan pemangku kebijakan.
            </p>
        </div>

        <div class="relative z-10 bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/15 space-y-3 shrink-0">
            <div class="flex items-center justify-between gap-4 text-xs">
                <span class="text-slate-300"><i class="fa-solid fa-clock-rotate-left text-gold-400 mr-1.5"></i> Cron 15 Menit:</span>
                <span class="font-mono text-white font-bold"><?= $cronStatus ? esc($cronStatus['last_run_human']) : 'Belum pernah' ?></span>
            </div>

            <form action="<?= base_url('admin/cron/run') ?>" method="POST">
                <?= csrf_field() ?>
                <button type="submit" 
                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 font-bold text-xs shadow-md transition-all active:scale-[0.98] cursor-pointer">
                    <i class="fa-solid fa-arrows-rotate"></i>
                    <span>Jalankan Cron (15m) Sekarang</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Stat Metrics Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6">
        
        <!-- Total Klaster Riset -->
        <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-atom"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-semibold block">Klaster Riset</span>
                <span class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= esc($stats['total_klaster'] ?? '0') ?></span>
                <a href="<?= base_url('admin/klaster') ?>" class="text-[11px] text-maritime-700 hover:underline block font-medium mt-0.5">Kelola &rarr;</a>
            </div>
        </div>

        <!-- Total Berita -->
        <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl shrink-0">
                <i class="fa-regular fa-newspaper"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-semibold block">Total Berita</span>
                <span class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= esc($stats['total_berita']) ?></span>
                <a href="<?= base_url('admin/berita') ?>" class="text-[11px] text-maritime-700 hover:underline block font-medium mt-0.5">Kelola &rarr;</a>
            </div>
        </div>

        <!-- Total Unduhan -->
        <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-semibold block">Dokumen Unduhan</span>
                <span class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= esc($stats['total_unduhan']) ?></span>
                <a href="<?= base_url('admin/unduhan') ?>" class="text-[11px] text-maritime-700 hover:underline block font-medium mt-0.5">Kelola &rarr;</a>
            </div>
        </div>

        <!-- Total Permohonan Unduh -->
        <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-semibold block">Permohonan Unduh</span>
                <span class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= esc($stats['total_permohonan']) ?></span>
                <a href="<?= base_url('admin/permohonan') ?>" class="text-[11px] text-maritime-700 hover:underline block font-medium mt-0.5">Tinjau &rarr;</a>
            </div>
        </div>

        <!-- Pesan Kerjasama -->
        <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-handshake-angle"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-semibold block">Pesan Masuk</span>
                <span class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= esc($stats['total_kontak']) ?></span>
                <a href="<?= base_url('admin/kontak') ?>" class="text-[11px] text-maritime-700 hover:underline block font-medium mt-0.5">Lihat &rarr;</a>
            </div>
        </div>

    </div>

    <!-- Quick Management Action Hub -->
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-xs space-y-4">
        <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-navy-950">Aksi Cepat Pengaturan Konten</h3>
                <p class="text-xs text-slate-500">Pintasan praktis untuk memperbarui atau melengkapi informasi portal</p>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <a href="<?= base_url('admin/klaster/create') ?>" 
               class="p-4 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50">
                <div class="w-9 h-9 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-atom"></i>
                </div>
                <div>
                    <h4 class="font-bold text-xs text-navy-950">Tambah Klaster</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">Buat klaster riset baru</p>
                </div>
            </a>

            <a href="<?= base_url('admin/berita/create') ?>" 
               class="p-4 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50">
                <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div>
                    <h4 class="font-bold text-xs text-navy-950">Tambah Berita Baru</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">Rilis kegiatan riset & agenda</p>
                </div>
            </a>

            <a href="<?= base_url('admin/publikasi') ?>" 
               class="p-4 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50">
                <div class="w-9 h-9 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-file-signature"></i>
                </div>
                <div>
                    <h4 class="font-bold text-xs text-navy-950">Update Policy Brief</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">Perbarui naskah Dr. Ady</p>
                </div>
            </a>

            <a href="<?= base_url('admin/unduhan/create') ?>" 
               class="p-4 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50">
                <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-upload"></i>
                </div>
                <div>
                    <h4 class="font-bold text-xs text-navy-950">Tambah SOP / Unduhan</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">Unggah berkas panduan</p>
                </div>
            </a>

            <a href="<?= base_url('admin/permohonan') ?>" 
               class="p-4 rounded-2xl border border-slate-200 hover:border-maritime-500 hover:shadow-md transition-all group flex items-start gap-3 bg-slate-50/50">
                <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-sm shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-users-viewfinder"></i>
                </div>
                <div>
                    <h4 class="font-bold text-xs text-navy-950">Data Pemohon</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">Daftar instansi pengunduh</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Data Grids (Permohonan & Kontak) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Tabel Permohonan Unduh Terakhir -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-xs space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div>
                    <h3 class="text-sm font-bold text-navy-950 flex items-center gap-2">
                        <i class="fa-solid fa-envelope-open-text text-maritime-600"></i>
                        <span>Permohonan Unduh Terbaru</span>
                    </h3>
                    <span class="text-[11px] text-slate-400">Pemberitahuan otomatis ke email penyusun</span>
                </div>
                <a href="<?= base_url('admin/permohonan') ?>" class="text-xs text-maritime-700 font-bold hover:underline">Lihat Semua</a>
            </div>

            <?php if (empty($recentPermohonan)): ?>
            <p class="text-xs text-slate-400 py-6 text-center italic">Belum ada permohonan unduh yang tercatat.</p>
            <?php else: ?>
            <div class="divide-y divide-slate-100 text-xs">
                <?php foreach ($recentPermohonan as $req): ?>
                <div class="py-3 flex items-start justify-between gap-3">
                    <div class="space-y-1 min-w-0">
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
        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-xs space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div>
                    <h3 class="text-sm font-bold text-navy-950 flex items-center gap-2">
                        <i class="fa-solid fa-handshake-angle text-maritime-600"></i>
                        <span>Pesan Kerjasama Terakhir</span>
                    </h3>
                    <span class="text-[11px] text-slate-400">Pengajuan dari form kontak kemitraan</span>
                </div>
                <a href="<?= base_url('admin/kontak') ?>" class="text-xs text-maritime-700 font-bold hover:underline">Lihat Semua</a>
            </div>

            <?php if (empty($recentKontak)): ?>
            <p class="text-xs text-slate-400 py-6 text-center italic">Belum ada pesan kerjasama masuk.</p>
            <?php else: ?>
            <div class="divide-y divide-slate-100 text-xs">
                <?php foreach ($recentKontak as $k): ?>
                <div class="py-3 flex items-start justify-between gap-3">
                    <div class="space-y-1 min-w-0">
                        <div class="font-bold text-navy-950 truncate"><?= esc($k['nama']) ?> (<?= esc($k['instansi']) ?>)</div>
                        <div class="text-[11px] text-slate-500 truncate"><?= esc($k['kategori']) ?> &bull; <?= esc($k['email']) ?></div>
                        <div class="text-[11px] text-slate-600 line-clamp-1 italic">"<?= esc($k['pesan']) ?>"</div>
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

</div>

<?= $this->endSection() ?>
