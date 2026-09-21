<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Policy Brief & Publikasi Kemaritiman</h2>
            <p class="text-xs text-slate-500 mt-1">
                Kelola rilis naskah policy brief, jurnal kajian luar negeri, serta dokumen rekomendasi kebijakan maritim.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url('publikasi') ?>" target="_blank"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Lihat Halaman Publik</span>
            </a>
            <a href="<?= base_url('admin/publikasi/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-file-circle-plus"></i>
                <span>Tambah Naskah Baru</span>
            </a>
        </div>
    </div>

    <!-- Briefs List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($briefs as $b): ?>
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs flex flex-col justify-between hover:border-maritime-500 hover:shadow-md transition-all">
            <div class="space-y-4">
                <div class="flex items-start justify-between gap-3">
                    <span class="font-mono text-xs font-bold text-maritime-700 bg-maritime-50 px-2.5 py-1 rounded-lg border border-maritime-200">
                        <?= esc($b['number']) ?>
                    </span>
                    <span class="text-xs font-bold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-lg">
                        Tahun <?= esc($b['year']) ?>
                    </span>
                </div>

                <h3 class="text-base font-bold text-navy-950 leading-snug">
                    <?= esc($b['title']) ?>
                </h3>

                <div class="space-y-1.5 text-xs">
                    <div class="text-slate-500"><strong class="text-slate-700">Penyusun:</strong> <?= esc($b['author']) ?></div>
                    <p class="text-slate-600 line-clamp-3 leading-relaxed"><?= esc($b['desc']) ?></p>
                </div>

                <?php if (!empty($b['file_path'])): ?>
                    <div class="pt-2">
                        <a href="<?= base_url($b['file_path']) ?>" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-emerald-700 font-semibold bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-200 hover:bg-emerald-100">
                            <i class="fa-solid fa-file-pdf text-rose-600"></i>
                            <span>Lihat Berkas Dokumen PDF</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="pt-5 mt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                <span class="text-[11px] font-mono text-slate-400">
                    <i class="fa-solid fa-download mr-1"></i> <?= esc($b['downloads_count'] ?? 0) ?> kali diunduh
                </span>
                <div class="flex items-center gap-2">
                    <a href="<?= base_url('admin/publikasi/edit/' . $b['id']) ?>" 
                       class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                        <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                    </a>
                    <form action="<?= base_url('admin/publikasi/delete/' . $b['id']) ?>" method="POST" onsubmit="return confirm('Hapus naskah policy brief ini?');">
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
