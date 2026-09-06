<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Page Header Banner / Breadcrumbs -->
<div class="bg-navy-950 text-white py-14 relative overflow-hidden border-b-2 border-gold-500">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
        <nav class="flex items-center space-x-2 text-xs text-gold-400 font-medium">
            <a href="<?= base_url() ?>" class="hover:underline flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i> Beranda
            </a>
            <span>/</span>
            <a href="<?= base_url('riset') ?>" class="hover:underline">Klaster Riset</a>
            <span>/</span>
            <span class="text-slate-300"><?= esc($cluster['short_title']) ?></span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pt-2">
            <div class="space-y-2 max-w-3xl">
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 rounded-full bg-gold-500/20 text-gold-400 border border-gold-500/30 text-xs font-bold uppercase tracking-wider">
                        <?= esc($cluster['badge']) ?>
                    </span>
                    <span class="text-slate-400 text-xs italic hidden sm:inline">
                        <?= esc($cluster['title_en']) ?>
                    </span>
                </div>
                <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white leading-tight">
                    <?= esc($cluster['title']) ?>
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                    <?= esc($cluster['mandate']) ?>
                </p>
            </div>

            <!-- Icon Emblem Badge -->
            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gradient-to-tr from-navy-800 to-maritime-700 p-1 flex items-center justify-center text-white shadow-xl flex-shrink-0 border border-gold-500/30">
                <div class="w-full h-full rounded-[14px] bg-navy-950 flex items-center justify-center text-3xl sm:text-4xl text-gold-400">
                    <i class="fa-solid <?= esc($cluster['icon']) ?>"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Cluster Content Area -->
<div class="py-14 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Left: Main Cluster Substance (8 cols) -->
            <div class="lg:col-span-8 space-y-10">
                
                <!-- Mandat & Visi Strategis Card -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-4">
                    <div class="flex items-center gap-2 text-maritime-600 text-xs font-bold uppercase tracking-wider">
                        <span class="w-6 h-0.5 bg-maritime-600"></span>
                        <span>Mandat Ilmiah & Arah Kebijakan</span>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold text-navy-950">
                        Kontribusi Strategis bagi Kedaulatan & Sains Maritim
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-700 leading-relaxed text-justify">
                        Klaster ini dirancang untuk menjawab tantangan spesifik kelautan kepulauan tropis di wilayah perbatasan barat Indonesia. Melalui integrasi pendekatan saintifik, instrumen akustik modern, serta kolaborasi pentahelix bersama kementerian teknis dan institusi global, riset yang dihasilkan bermuara pada hilirisasi teknologi dan advokasi kebijakan publik yang terukur.
                    </p>
                </div>

                <!-- Sub-Fokus Riset Prioritas Grid (4 Cards) -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block">Pilar Keilmuan</span>
                            <h3 class="text-xl font-bold text-navy-950">Sub-Fokus Riset Prioritas</h3>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <?php foreach ($cluster['focus_areas'] as $idx => $focus): ?>
                        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs hover:shadow-md transition-all duration-300 space-y-3 flex flex-col justify-between group">
                            <div class="space-y-2">
                                <div class="w-9 h-9 rounded-xl bg-maritime-50 text-maritime-600 flex items-center justify-center font-bold text-xs group-hover:bg-navy-900 group-hover:text-gold-400 transition-colors">
                                    0<?= $idx + 1 ?>
                                </div>
                                <h4 class="text-sm sm:text-base font-bold text-navy-950 group-hover:text-maritime-600 transition-colors">
                                    <?= esc($focus['title']) ?>
                                </h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    <?= esc($focus['desc']) ?>
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Proyek Riset Unggulan (Flagship Projects) -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-6">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div>
                            <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block">Portofolio Riset Aktif</span>
                            <h3 class="text-lg sm:text-xl font-bold text-navy-950">Proyek Riset Unggulan (Flagship Projects)</h3>
                        </div>
                        <span class="hidden sm:inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg">
                            <i class="fa-solid fa-circle text-[8px]"></i> Aktif 2024-2026
                        </span>
                    </div>

                    <div class="space-y-4">
                        <?php foreach ($cluster['flagship_projects'] as $proj): ?>
                        <div class="p-5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <span class="px-2.5 py-0.5 rounded bg-navy-900 text-gold-400 text-[11px] font-bold">
                                    <?= esc($proj['period']) ?>
                                </span>
                                <span class="text-xs font-medium text-maritime-700 flex items-center gap-1">
                                    <i class="fa-solid fa-hand-holding-dollar text-slate-400"></i> <?= esc($proj['funding']) ?>
                                </span>
                            </div>
                            <h4 class="text-sm sm:text-base font-bold text-navy-950">
                                <?= esc($proj['title']) ?>
                            </h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                <?= esc($proj['desc']) ?>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Fasilitas Laboratorium & Instrumen Riset -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-5">
                    <div class="flex items-center gap-2.5">
                        <div class="w-10 h-10 rounded-xl bg-maritime-50 text-maritime-600 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-toolbox"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-navy-950">Fasilitas Laboratorium & Instrumen Pendukung</h3>
                            <p class="text-xs text-slate-500">Infrastruktur penelitian terakreditasi dan peralatan oseanografi lapangan</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <?php foreach ($cluster['facilities'] as $fac): ?>
                        <div class="flex items-start gap-2.5 p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs text-slate-700">
                            <i class="fa-solid fa-circle-check text-gold-500 text-xs mt-0.5 flex-shrink-0"></i>
                            <span class="font-medium"><?= esc($fac) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Publikasi Ilmiah Pilihan (Selected Publications) -->
                <?php if (!empty($cluster['publications'])): ?>
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-4">
                    <div>
                        <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block">Diseminasi Internasional</span>
                        <h3 class="text-lg sm:text-xl font-bold text-navy-950">Publikasi Jurnal Bereputasi Pilihan</h3>
                    </div>

                    <div class="space-y-3">
                        <?php foreach ($cluster['publications'] as $pub): ?>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1.5">
                            <div class="flex flex-wrap items-center justify-between gap-2 text-xs">
                                <span class="font-semibold text-maritime-700"><?= esc($pub['journal']) ?></span>
                                <span class="text-slate-500 font-mono text-[11px]"><?= esc($pub['year']) ?></span>
                            </div>
                            <h4 class="text-xs sm:text-sm font-bold text-navy-950">
                                "<?= esc($pub['title']) ?>"
                            </h4>
                            <p class="text-[11px] text-slate-400 font-mono">
                                DOI: <?= esc($pub['doi']) ?>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>

            <!-- Right: Coordinator & Actions Sidebar (4 cols) -->
            <aside class="lg:col-span-4 space-y-6">
                
                <!-- Profil Koordinator Klaster Card -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-5">
                    <div class="flex items-center gap-2 text-maritime-600 text-xs font-bold uppercase tracking-wider">
                        <i class="fa-solid fa-user-tie"></i>
                        <span>Pimpinan Riset Klaster</span>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-navy-900 to-maritime-700 flex items-center justify-center text-gold-400 text-2xl font-bold shadow-md flex-shrink-0">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                        <div class="space-y-0.5 overflow-hidden">
                            <h4 class="text-sm font-bold text-navy-950 leading-tight truncate">
                                <?= esc($cluster['coordinator']['name']) ?>
                            </h4>
                            <p class="text-xs text-maritime-700 font-medium">
                                <?= esc($cluster['coordinator']['role']) ?>
                            </p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 space-y-2.5 text-xs text-slate-600">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">NIP:</span>
                            <span class="font-mono font-medium text-slate-800"><?= esc($cluster['coordinator']['nip']) ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">Scopus Author ID:</span>
                            <span class="font-mono font-bold text-maritime-700"><?= esc($cluster['coordinator']['scopus_id']) ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">Email Resmi:</span>
                            <a href="mailto:<?= esc($cluster['coordinator']['email']) ?>" class="font-medium text-navy-950 hover:underline"><?= esc($cluster['coordinator']['email']) ?></a>
                        </div>
                    </div>

                    <a href="mailto:<?= esc($cluster['coordinator']['email']) ?>" class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                        <i class="fa-regular fa-envelope"></i> Hubungi Peneliti Utama
                    </a>
                </div>

                <!-- Callout Kerjasama CTA -->
                <div class="bg-gradient-to-br from-navy-950 to-navy-900 text-white rounded-2xl p-6 shadow-md border border-gold-500/30 space-y-4">
                    <div class="w-10 h-10 rounded-xl bg-gold-500/20 text-gold-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-handshake-angle"></i>
                    </div>
                    <h4 class="text-base font-bold text-white">Inisiasi Kerjasama Klaster</h4>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Tertarik berkolaborasi dalam penelitian bersama, jasa survei hidro-oseanografi, atau perumusan policy brief bidang <?= strtolower(esc($cluster['short_title'])) ?>?
                    </p>
                    <a href="<?= base_url('kontak#kerjasama') ?>" class="inline-block w-full text-center py-3 px-4 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 font-bold text-xs shadow transition-colors">
                        Ajukan Kerjasama Riset
                    </a>
                </div>

                <!-- Link to Repositori Unduhan -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-3">
                    <h4 class="text-sm font-bold text-navy-950 flex items-center gap-2">
                        <i class="fa-solid fa-download text-maritime-600"></i> Dokumen & SOP Klaster
                    </h4>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Unduh SOP pengujian laboratorium, panduan metodologi survei, dan template KAK terkait klaster ini di pusat repositori.
                    </p>
                    <a href="<?= base_url('unduhan') ?>" class="inline-flex items-center gap-1.5 text-xs font-semibold text-maritime-600 hover:text-navy-950 pt-1">
                        <span>Buka Pusat Repositori</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

            </aside>

        </div>

        <!-- Cross-Cluster Navigation (3 Other Clusters) -->
        <?php if (!empty($otherClusters)): ?>
        <section class="mt-16 pt-12 border-t border-slate-200 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block">Eksplorasi Keilmuan</span>
                    <h3 class="text-xl sm:text-2xl font-bold text-navy-950 mt-0.5">Jelajahi Klaster Riset Lainnya</h3>
                </div>
                <a href="<?= base_url('riset') ?>" class="text-xs font-semibold text-maritime-700 hover:text-navy-950 flex items-center gap-1">
                    <span>Lihat Semua Klaster & Roadmap</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($otherClusters as $other): ?>
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between space-y-4 group">
                    <div class="space-y-3">
                        <div class="w-11 h-11 rounded-xl bg-maritime-50 group-hover:bg-navy-900 text-maritime-600 group-hover:text-gold-400 flex items-center justify-center text-xl transition-colors duration-300">
                            <i class="fa-solid <?= esc($other['icon']) ?>"></i>
                        </div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block"><?= esc($other['badge']) ?></span>
                        <h4 class="text-sm sm:text-base font-bold text-navy-950 group-hover:text-maritime-600 transition-colors leading-snug">
                            <?= esc($other['short_title']) ?>
                        </h4>
                        <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                            <?= esc($other['mandate']) ?>
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-400 text-[11px]"><?= esc($other['coordinator']['name']) ?></span>
                        <a href="<?= base_url('riset/' . $other['id']) ?>" class="font-bold text-maritime-600 hover:text-navy-950 flex items-center gap-1">
                            <span>Detail</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>
