<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Mitra Kerjasama Strategis</h2>
            <p class="text-xs text-slate-500 mt-1">
                Atur logo dan informasi kemitraan riset dengan kementerian, universitas dalam/luar negeri, dan lembaga sains maritim.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url() ?>" target="_blank"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Lihat Beranda Publik</span>
            </a>
            <a href="<?= base_url('admin/mitra/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Mitra Baru</span>
            </a>
        </div>
    </div>

    <!-- Partners Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($partners as $p): ?>
        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col justify-between hover:border-maritime-500 hover:shadow-md transition-all">
            <div class="space-y-4">
                <!-- Logo Box -->
                <div class="h-24 rounded-xl bg-slate-50 border border-slate-100 p-3 flex items-center justify-center relative">
                    <img src="<?= base_url(esc($p['logo'])) ?>" alt="<?= esc($p['name']) ?>" class="max-h-14 w-auto max-w-[140px] object-contain">
                    <span class="absolute top-2 right-2 px-2 py-0.5 rounded text-[9px] font-bold font-mono <?= $p['is_active'] ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600' ?>">
                        <?= $p['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                    </span>
                </div>

                <!-- Info -->
                <div class="space-y-1">
                    <span class="text-[10px] uppercase font-bold text-maritime-600 tracking-wider block"><?= esc($p['category']) ?></span>
                    <h3 class="text-sm font-bold text-navy-950 leading-snug"><?= esc($p['name']) ?></h3>
                    <?php if (!empty($p['short_name'])): ?>
                    <p class="text-xs font-semibold text-slate-500"><?= esc($p['short_name']) ?></p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($p['website_url'])): ?>
                <div class="pt-2">
                    <a href="<?= esc($p['website_url']) ?>" target="_blank" rel="noopener noreferrer" class="text-[11px] text-maritime-600 hover:underline truncate block flex items-center gap-1">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                        <span class="truncate"><?= esc($p['website_url']) ?></span>
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <!-- Bottom Actions -->
            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                <span class="text-[10px] font-mono text-slate-400">Urut: #<?= esc($p['order_seq']) ?></span>
                <div class="flex items-center gap-1.5">
                    <a href="<?= base_url('admin/mitra/edit/' . $p['id']) ?>" 
                       class="px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="<?= base_url('admin/mitra/delete/' . $p['id']) ?>" method="POST" onsubmit="return confirm('Hapus mitra kerjasama ini?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition-colors">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
