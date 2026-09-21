<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Banner & Slider Beranda</h2>
            <p class="text-xs text-slate-500 mt-1">
                Atur tayangan sorotan utama, agenda konferensi maritim, dan rekomendasi kebijakan di slider beranda web.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url() ?>" target="_blank"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Lihat Beranda Publik</span>
            </a>
            <a href="<?= base_url('admin/banners/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Banner Slider</span>
            </a>
        </div>
    </div>

    <!-- Banners Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($banners as $b): ?>
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-xs flex flex-col justify-between hover:border-maritime-500 hover:shadow-md transition-all">
            <!-- Preview Image -->
            <div class="h-44 relative bg-navy-950 overflow-hidden">
                <img src="<?= base_url(esc($b['image'])) ?>" alt="<?= esc($b['title']) ?>" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-navy-950/80 via-transparent to-black/20"></div>
                <div class="absolute top-3 left-3 right-3 flex items-center justify-between gap-2">
                    <span class="px-2.5 py-1 rounded bg-gold-500/90 text-navy-950 text-[10px] font-bold uppercase tracking-wider shadow-sm">
                        <?= esc($b['badge']) ?>
                    </span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold font-mono <?= $b['is_active'] ? 'bg-emerald-500/90 text-white' : 'bg-slate-700 text-slate-300' ?>">
                        <?= $b['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                    </span>
                </div>
                <?php if (!empty($b['tag'])): ?>
                <div class="absolute bottom-3 left-3 text-white text-[11px] font-medium flex items-center gap-1.5">
                    <i class="fa-solid fa-tag text-gold-400 text-xs"></i>
                    <span><?= esc($b['tag']) ?></span>
                </div>
                <?php endif; ?>
            </div>

            <!-- Content -->
            <div class="p-5 flex-grow flex flex-col justify-between space-y-3">
                <div class="space-y-2">
                    <h3 class="text-sm font-bold text-navy-950 leading-snug line-clamp-2">
                        <?= esc($b['title']) ?>
                    </h3>
                    <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                        <?= esc($b['desc']) ?>
                    </p>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                    <span>Urutan: #<?= esc($b['order_seq']) ?></span>
                    <span class="font-mono text-slate-400 truncate max-w-[150px]">Link: <?= esc($b['link_url'] ?: '/') ?></span>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-5 pb-5 pt-0 flex items-center justify-end gap-2 border-t border-slate-50">
                <a href="<?= base_url('admin/banners/edit/' . $b['id']) ?>" 
                   class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                    <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                </a>
                <form action="<?= base_url('admin/banners/delete/' . $b['id']) ?>" method="POST" onsubmit="return confirm('Hapus banner slider ini?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition-colors">
                        <i class="fa-regular fa-trash-can mr-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
