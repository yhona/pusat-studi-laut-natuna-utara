<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Personalia & Dewan Peneliti</h2>
            <p class="text-xs text-slate-500 mt-1">
                Kelola profil 5 pimpinan departemen, anggota dewan peneliti lintas fakultas, serta afiliasi pakar kemaritiman.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url('profil#struktur') ?>" target="_blank"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Lihat Struktur Publik</span>
            </a>
            <a href="<?= base_url('admin/peneliti/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-user-plus"></i>
                <span>Tambah Peneliti Baru</span>
            </a>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex flex-wrap items-center gap-2 border-b border-slate-200 pb-3 text-xs font-semibold">
        <a href="<?= base_url('admin/peneliti') ?>" 
           class="px-3.5 py-2 rounded-xl transition-all <?= empty($selectedCategory) ? 'bg-navy-950 text-gold-400 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' ?>">
            Semua Peneliti (<?= count($peneliti) ?>)
        </a>
        <a href="<?= base_url('admin/peneliti?category=pimpinan') ?>" 
           class="px-3.5 py-2 rounded-xl transition-all <?= $selectedCategory === 'pimpinan' ? 'bg-navy-950 text-gold-400 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' ?>">
            Pimpinan Eksekutif (<?= $totalPimpinan ?>)
        </a>
        <a href="<?= base_url('admin/peneliti?category=dewan_peneliti') ?>" 
           class="px-3.5 py-2 rounded-xl transition-all <?= $selectedCategory === 'dewan_peneliti' ? 'bg-navy-950 text-gold-400 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' ?>">
            Dewan Peneliti (<?= $totalDewan ?>)
        </a>
        <a href="<?= base_url('admin/peneliti?category=eksternal') ?>" 
           class="px-3.5 py-2 rounded-xl transition-all <?= $selectedCategory === 'eksternal' ? 'bg-navy-950 text-gold-400 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' ?>">
            Mitra Eksternal (<?= $totalEksternal ?>)
        </a>
    </div>

    <!-- Researchers Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        <?php foreach ($peneliti as $p): ?>
        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col justify-between hover:border-maritime-500 hover:shadow-md transition-all">
            <div class="space-y-4">
                <div class="flex items-start gap-3.5">
                    <?php if (!empty($p['image'])): ?>
                        <img src="<?= base_url($p['image']) ?>" alt="<?= esc($p['name']) ?>" class="w-14 h-14 rounded-2xl object-cover border border-slate-200 shadow-sm shrink-0">
                    <?php else: ?>
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-navy-900 to-maritime-700 flex items-center justify-center text-gold-400 font-bold text-lg shadow-sm shrink-0">
                            <?= mb_strtoupper(mb_substr($p['name'], 0, 2)) ?>
                        </div>
                    <?php endif; ?>

                    <div class="overflow-hidden space-y-0.5">
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider <?= $p['category'] === 'pimpinan' ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-700' ?>">
                                <?= $p['category'] === 'pimpinan' ? 'Pimpinan' : ($p['category'] === 'dewan_peneliti' ? 'Dewan Peneliti' : 'Eksternal') ?>
                            </span>
                            <?php if ($p['is_active']): ?>
                                <span class="w-2 h-2 rounded-full bg-emerald-500" title="Status Aktif"></span>
                            <?php else: ?>
                                <span class="w-2 h-2 rounded-full bg-slate-300" title="Status Nonaktif"></span>
                            <?php endif; ?>
                        </div>
                        <h3 class="text-sm font-bold text-navy-950 truncate" title="<?= esc($p['name']) ?>">
                            <?= esc($p['name']) ?>
                        </h3>
                        <p class="text-xs text-maritime-700 font-semibold truncate">
                            <?= esc($p['role']) ?>
                        </p>
                    </div>
                </div>

                <div class="space-y-2 text-xs text-slate-600 bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                    <div>
                        <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Fakultas / Lembaga:</span>
                        <span class="text-slate-800 font-medium"><?= esc($p['faculty'] ?? '-') ?></span>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Fokus Riset:</span>
                        <p class="text-[11px] text-slate-700 line-clamp-2 leading-relaxed"><?= esc($p['focus']) ?></p>
                    </div>
                    <div class="flex items-center justify-between pt-1 border-t border-slate-200/60 text-[11px] font-mono">
                        <span class="text-slate-500"><?= esc($p['scopus'] ?? '-') ?></span>
                        <span class="text-maritime-700 font-semibold truncate max-w-[140px]"><?= esc($p['email']) ?></span>
                    </div>
                </div>
            </div>

            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                <span class="text-[10px] font-mono text-slate-400">Urutan: #<?= esc($p['order_num']) ?></span>
                <div class="flex items-center gap-2">
                    <a href="<?= base_url('admin/peneliti/edit/' . $p['id']) ?>" 
                       class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                        <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                    </a>
                    <form action="<?= base_url('admin/peneliti/delete/' . $p['id']) ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data peneliti ini?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition-colors">
                            <i class="fa-regular fa-trash-can mr-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
