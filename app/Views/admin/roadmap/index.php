<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Roadmap Riset & Milestone Kemaritiman</h2>
            <p class="text-xs text-slate-500 mt-1">
                Atur tahapan rencana strategis jangka panjang penelitian maritim (2025–2030+) yang tampil pada halaman riset publik.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url('riset') ?>" target="_blank"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Lihat Halaman Riset</span>
            </a>
            <a href="<?= base_url('admin/roadmap/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Fase Roadmap</span>
            </a>
        </div>
    </div>

    <!-- Roadmap Timeline List -->
    <div class="space-y-4">
        <?php foreach ($roadmap as $r): ?>
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs flex flex-col md:flex-row md:items-start justify-between gap-6 hover:border-maritime-500 hover:shadow-md transition-all">
            <div class="space-y-3 flex-1">
                <!-- Badges -->
                <div class="flex flex-wrap items-center gap-2.5">
                    <span class="px-3 py-1 rounded-lg bg-navy-900 text-gold-400 text-xs font-extrabold font-mono shadow-xs">
                        <?= esc($r['phase']) ?>
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-maritime-50 text-maritime-700 border border-maritime-200">
                        <?= esc($r['status']) ?> <?= !empty($r['status_en']) ? ' / ' . esc($r['status_en']) : '' ?>
                    </span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold font-mono <?= $r['is_active'] ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600' ?>">
                        <?= $r['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                    </span>
                    <span class="text-[11px] text-slate-400 font-mono">Urut: #<?= esc($r['order_seq']) ?></span>
                </div>

                <!-- Title & Description ID -->
                <div>
                    <h3 class="text-base font-bold text-navy-950"><?= esc($r['title']) ?></h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed"><?= esc($r['desc']) ?></p>
                </div>

                <!-- Title & Description EN (if any) -->
                <?php if (!empty($r['title_en']) || !empty($r['desc_en'])): ?>
                <div class="pt-2 border-t border-slate-100 text-slate-500">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-0.5">Versi Bahasa Inggris (EN):</span>
                    <h4 class="text-xs font-semibold text-slate-700 italic"><?= esc($r['title_en']) ?></h4>
                    <p class="text-[11px] text-slate-500 mt-0.5 italic leading-relaxed"><?= esc($r['desc_en']) ?></p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-2 pt-2 md:pt-0 shrink-0">
                <a href="<?= base_url('admin/roadmap/edit/' . $r['id']) ?>" 
                   class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors flex items-center gap-1.5" title="Edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Edit</span>
                </a>
                <form action="<?= base_url('admin/roadmap/delete/' . $r['id']) ?>" method="POST" onsubmit="return confirm('Hapus fase roadmap riset ini?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="px-3 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition-colors flex items-center gap-1.5" title="Hapus">
                        <i class="fa-regular fa-trash-can"></i>
                        <span>Hapus</span>
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
