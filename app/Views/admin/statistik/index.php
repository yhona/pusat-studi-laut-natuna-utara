<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Counter Capaian Riset & KPI</h2>
            <p class="text-xs text-slate-500 mt-1">
                Atur angka metrik, publikasi bereputasi, paten maritim, dan KPI capaian yang tampil dinamis di beranda publik.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url() ?>" target="_blank"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Lihat Beranda Publik</span>
            </a>
            <a href="<?= base_url('admin/statistik/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Statistik Baru</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($stats as $s): ?>
        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex flex-col justify-between hover:border-maritime-500 hover:shadow-md transition-all">
            <div class="space-y-4">
                <!-- Top icon + status -->
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center text-xl shadow-xs">
                        <i class="fa-solid <?= esc($s['icon']) ?>"></i>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[9px] font-bold font-mono <?= $s['is_active'] ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600' ?>">
                        <?= $s['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                    </span>
                </div>

                <!-- Number & Label -->
                <div class="space-y-1">
                    <span class="text-3xl font-black text-navy-950 font-mono tracking-tight"><?= esc($s['number']) ?></span>
                    <h3 class="text-sm font-bold text-slate-800 leading-snug"><?= esc($s['label']) ?></h3>
                    <?php if (!empty($s['label_en'])): ?>
                    <p class="text-xs text-slate-500 italic"><?= esc($s['label_en']) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bottom Actions -->
            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                <div class="flex items-center gap-2 text-[10px] text-slate-400 font-mono">
                    <span>Icon: <?= esc($s['icon']) ?></span>
                    <span>•</span>
                    <span>Urut: #<?= esc($s['order_seq']) ?></span>
                </div>
                <div class="flex items-center gap-1.5">
                    <a href="<?= base_url('admin/statistik/edit/' . $s['id']) ?>" 
                       class="px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors" title="Edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="<?= base_url('admin/statistik/delete/' . $s['id']) ?>" method="POST" onsubmit="return confirm('Hapus metrik capaian statistik ini?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition-colors" title="Hapus">
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
