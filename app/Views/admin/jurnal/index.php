<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Jurnal Ilmiah Kemaritiman</h2>
            <p class="text-xs text-slate-500 mt-1">
                Kelola direktori berkala ilmiah, akreditasi SINTA, nomor ISSN, serta tautan portal OJS resmi UMRAH.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url('publikasi#jurnal') ?>" target="_blank"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Lihat di Halaman Publik</span>
            </a>
            <a href="<?= base_url('admin/jurnal/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Jurnal Baru</span>
            </a>
        </div>
    </div>

    <!-- Summary Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-maritime-50 text-maritime-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-book-bookmark"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium">Total Jurnal Ilmiah</span>
                <h4 class="text-xl font-extrabold text-navy-950"><?= esc($totalCount ?? count($journals)) ?></h4>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-award"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium">Terakreditasi SINTA</span>
                <h4 class="text-xl font-extrabold text-navy-950"><?= esc($sintaCount ?? 0) ?></h4>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium">Status Publikasi Aktif</span>
                <h4 class="text-xl font-extrabold text-navy-950"><?= esc($activeCount ?? 0) ?></h4>
            </div>
        </div>
    </div>

    <!-- Journals Grid -->
    <?php if (empty($journals)): ?>
    <div class="bg-white rounded-2xl p-12 text-center border border-slate-200 shadow-xs">
        <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fa-regular fa-folder-open"></i>
        </div>
        <h3 class="text-base font-bold text-navy-950 mb-1">Belum Ada Data Jurnal Ilmiah</h3>
        <p class="text-xs text-slate-500 mb-6">Tambahkan data jurnal kemaritiman pertama Anda melalui tombol di bawah.</p>
        <a href="<?= base_url('admin/jurnal/create') ?>"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Jurnal Pertama</span>
        </a>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($journals as $j): ?>
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs flex flex-col justify-between hover:border-maritime-500 hover:shadow-md transition-all">
            <div class="space-y-4">
                <div class="flex items-start justify-between gap-3">
                    <span class="px-2.5 py-1 rounded-lg bg-maritime-50 text-maritime-700 text-xs font-bold border border-maritime-200">
                        <?= esc($j['indexing']) ?>
                    </span>
                    <div class="flex items-center gap-2">
                        <?php if (! empty($j['is_active'])): ?>
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded-full border border-slate-200">
                                Nonaktif
                            </span>
                        <?php endif; ?>
                        <span class="text-[11px] font-mono text-slate-400">#<?= esc($j['order_num']) ?></span>
                    </div>
                </div>

                <div>
                    <h3 class="text-base font-bold text-navy-950 leading-snug">
                        <?= esc($j['name']) ?>
                    </h3>
                    <?php if (! empty($j['name_en']) && $j['name_en'] !== $j['name']): ?>
                        <p class="text-xs text-slate-400 italic mt-0.5"><?= esc($j['name_en']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="space-y-1.5 text-xs">
                    <div class="text-slate-500 flex items-center gap-2 font-mono">
                        <i class="fa-solid fa-barcode text-slate-400 text-[11px]"></i>
                        <span><?= esc($j['issn']) ?></span>
                    </div>
                    <div class="text-slate-500 flex items-center gap-2">
                        <i class="fa-regular fa-calendar-check text-slate-400 text-[11px]"></i>
                        <span><?= esc($j['frequency']) ?> (<?= esc($j['frequency_en'] ?? 'Biannual') ?>)</span>
                    </div>
                    <p class="text-slate-600 line-clamp-3 leading-relaxed pt-1">
                        <?= esc($j['description']) ?>
                    </p>
                </div>

                <div class="pt-2">
                    <a href="<?= esc($j['journal_url']) ?>" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-1.5 text-xs text-maritime-700 font-semibold bg-maritime-50 px-3 py-1.5 rounded-lg border border-maritime-200 hover:bg-maritime-100 transition-colors">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        <span>Portal OJS UMRAH</span>
                    </a>
                </div>
            </div>

            <div class="pt-5 mt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                <span class="text-[11px] font-mono text-slate-400">
                    Slug: <?= esc($j['slug']) ?>
                </span>
                <div class="flex items-center gap-2">
                    <a href="<?= base_url('admin/jurnal/edit/' . $j['id']) ?>" 
                       class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                        <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                    </a>
                    <form action="<?= base_url('admin/jurnal/delete/' . $j['id']) ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurnal <?= esc($j['name'], 'js') ?>?');">
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
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
