<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Layanan & Jasa Konsultasi Kemaritiman</h2>
            <p class="text-xs text-slate-500 mt-1">
                Kelola paket studi kepelabuhanan, pemetaan potensi pesisir, perizinan tata ruang laut (PKKPRL), dan kalibrasi laboratorium.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url('layanan') ?>" target="_blank"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Lihat Halaman Layanan</span>
            </a>
            <a href="<?= base_url('admin/layanan/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Paket Layanan</span>
            </a>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($services as $s): ?>
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs flex flex-col justify-between hover:border-maritime-500 hover:shadow-md transition-all">
            <div class="space-y-4">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid <?= esc($s['icon']) ?>"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono font-bold text-maritime-700 bg-maritime-50 px-2 py-0.5 rounded border border-maritime-200 block">
                                <?= esc($s['code'] ?? 'SOP') ?>
                            </span>
                            <h3 class="text-sm font-bold text-navy-950 mt-1"><?= esc($s['title']) ?></h3>
                        </div>
                    </div>
                </div>

                <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                    <?= esc($s['desc']) ?>
                </p>

                <!-- Standards & Instruments -->
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-2 text-xs">
                    <div>
                        <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Standar Acuan:</span>
                        <span class="text-[11px] text-slate-700 font-medium line-clamp-1"><?= esc($s['standards'] ?? '-') ?></span>
                    </div>
                    <?php if (!empty($s['instruments']) && is_array($s['instruments'])): ?>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Instrumen (<?= count($s['instruments']) ?>):</span>
                            <span class="text-[11px] text-slate-600 truncate block"><?= esc(implode(', ', array_slice($s['instruments'], 0, 2))) ?>...</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pt-5 mt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                <span class="text-[10px] font-mono text-slate-400">Slug: /<?= esc($s['slug']) ?></span>
                <div class="flex items-center gap-2">
                    <a href="<?= base_url('admin/layanan/edit/' . $s['id']) ?>" 
                       class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                        <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                    </a>
                    <form action="<?= base_url('admin/layanan/delete/' . $s['id']) ?>" method="POST" onsubmit="return confirm('Hapus paket layanan ini?');">
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
