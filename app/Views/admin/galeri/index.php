<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Galeri Dokumentasi Ekspedisi & Riset</h2>
            <p class="text-xs text-slate-500 mt-1">
                Atur dokumentasi pelayaran ilmiah bahari, kalibrasi instrumen laboratorium, dan observasi pasut pesisir.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url() ?>#galeri" target="_blank"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Lihat Galeri di Beranda</span>
            </a>
            <a href="<?= base_url('admin/galeri/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Dokumentasi Baru</span>
            </a>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($items as $item): ?>
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-xs flex flex-col justify-between hover:border-maritime-500 hover:shadow-md transition-all">
            <!-- Image Thumbnail -->
            <div class="h-44 relative bg-navy-950 overflow-hidden">
                <img src="<?= base_url(esc($item['image'])) ?>" alt="<?= esc($item['title']) ?>" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-navy-950/80 via-transparent to-black/20"></div>
                <div class="absolute top-3 left-3 right-3 flex items-center justify-between gap-2">
                    <span class="px-2.5 py-1 rounded bg-navy-900/90 text-gold-400 text-[10px] font-bold uppercase tracking-wider border border-gold-400/20">
                        <?= esc($item['category']) ?>
                    </span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold font-mono <?= $item['is_active'] ? 'bg-emerald-500/90 text-white' : 'bg-slate-700 text-slate-300' ?>">
                        <?= $item['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                    </span>
                </div>
                <div class="absolute bottom-3 left-3 right-3 text-white text-[11px] font-medium flex items-center gap-1.5 truncate">
                    <i class="fa-solid fa-location-dot text-gold-400 text-xs shrink-0"></i>
                    <span class="truncate"><?= esc($item['location']) ?></span>
                </div>
            </div>

            <!-- Body Content -->
            <div class="p-5 flex-grow flex flex-col justify-between space-y-3">
                <div class="space-y-1.5">
                    <span class="text-[11px] text-slate-500 flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar-check text-maritime-600"></i>
                        <span><?= esc($item['date_text']) ?></span>
                    </span>
                    <h3 class="text-sm font-bold text-navy-950 leading-snug line-clamp-2">
                        <?= esc($item['title']) ?>
                    </h3>
                    <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                        <?= esc($item['desc']) ?>
                    </p>
                </div>

                <div class="pt-2 text-[11px] text-slate-500 space-y-1">
                    <?php if (!empty($item['vessel'])): ?>
                    <div class="flex items-center gap-1.5 truncate">
                        <i class="fa-solid fa-ship text-maritime-500 text-[10px] shrink-0"></i>
                        <span class="truncate"><?= esc($item['vessel']) ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($item['focal'])): ?>
                    <div class="flex items-center gap-1.5 truncate">
                        <i class="fa-solid fa-compass text-emerald-500 text-[10px] shrink-0"></i>
                        <span class="truncate"><?= esc($item['focal']) ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-5 pb-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-[10px] font-mono text-slate-400">Urut: #<?= esc($item['order_seq']) ?></span>
                <div class="flex items-center gap-1.5">
                    <a href="<?= base_url('admin/galeri/edit/' . $item['id']) ?>" 
                       class="px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition-colors">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <form action="<?= base_url('admin/galeri/delete/' . $item['id']) ?>" method="POST" onsubmit="return confirm('Hapus dokumentasi riset ini?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold transition-colors">
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
