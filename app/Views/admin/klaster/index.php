<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Klaster Riset Kemaritiman</h2>
            <p class="text-xs text-slate-500 mt-1">
                Kelola klaster riset strategis Laut Natuna Utara, mandat saintifik, dewan koordinator, area fokus, serta proyek unggulan.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url('riset') ?>" target="_blank"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Lihat Roadmap Publik</span>
            </a>
            <a href="<?= base_url('admin/klaster/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Klaster Baru</span>
            </a>
        </div>
    </div>

    <!-- Cluster Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($klasters as $c): ?>
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs flex flex-col justify-between hover:border-maritime-500 hover:shadow-md transition-all">
                <div class="space-y-4">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-navy-950 text-gold-400 flex items-center justify-center text-lg shrink-0">
                                <i class="<?= esc($c['icon'] ?? 'fa-solid fa-anchor') ?>"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-gold-600 block"><?= esc($c['badge'] ?? 'Klaster Riset') ?></span>
                                <h3 class="text-base font-bold text-navy-950"><?= esc($c['short_title'] ?? $c['title']) ?></h3>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                        <?= esc($c['mandate']) ?>
                    </p>

                    <!-- Coordinator Info -->
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-1 text-xs">
                        <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Koordinator Klaster:</span>
                        <div class="font-bold text-navy-900"><?= esc($c['coordinator']['name'] ?? '-') ?></div>
                        <div class="text-[11px] text-slate-500"><?= esc($c['coordinator']['role'] ?? '-') ?></div>
                        <?php if (!empty($c['coordinator']['scopus'])): ?>
                            <div class="text-[10px] font-mono text-gold-700 font-semibold"><?= esc($c['coordinator']['scopus']) ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="pt-5 mt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                    <a href="<?= base_url('riset/' . $c['slug']) ?>" target="_blank" 
                       class="text-xs text-slate-500 hover:text-maritime-700 font-medium inline-flex items-center gap-1.5">
                        <i class="fa-solid fa-external-link-alt text-[10px]"></i>
                        <span>Lihat Publik</span>
                    </a>
                    
                    <div class="flex items-center gap-2">
                        <form action="<?= base_url('admin/klaster/delete/' . $c['id']) ?>" method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus klaster riset <?= esc($c['short_title'] ?? $c['title']) ?>?')">
                            <?= csrf_field() ?>
                            <button type="submit" 
                                    class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors"
                                    title="Hapus Klaster">
                                <i class="fa-regular fa-trash-can text-sm"></i>
                            </button>
                        </form>

                        <a href="<?= base_url('admin/klaster/edit/' . $c['id']) ?>" 
                           class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 font-bold text-xs shadow-xs transition-colors">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span>Edit</span>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
