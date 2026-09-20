<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-5xl">
    
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-navy-950">Kelola Policy Brief & Publikasi Kemaritiman</h2>
            <p class="text-xs text-slate-500 mt-0.5">Perbarui rilis ringkasan eksekutif, susunan penyusun, dan rekomendasi kebijakan maritim</p>
        </div>
        <a href="<?= base_url('publikasi') ?>" target="_blank" class="text-xs text-maritime-700 hover:underline font-semibold flex items-center gap-1">
            <span>Lihat Halaman Publikasi</span> <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
        </a>
    </div>

    <form action="<?= base_url('admin/publikasi/update-brief') ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <?php foreach ($briefs as $index => $b): ?>
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-navy-900 text-gold-400 flex items-center justify-center font-bold text-xs"><?= $index + 1 ?></span>
                    <h3 class="font-bold text-sm text-navy-950">Naskah Policy Brief #<?= $index + 1 ?></h3>
                </div>
                <span class="font-mono text-xs font-bold text-maritime-700 bg-maritime-50 px-2.5 py-0.5 rounded border border-maritime-200"><?= esc($b['number']) ?></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="space-y-1 sm:col-span-2">
                    <label class="block text-[11px] font-bold text-slate-700">Nomor Publikasi Naskah *</label>
                    <input type="text" name="number[]" required value="<?= esc($b['number']) ?>"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                </div>
                <div class="space-y-1">
                    <label class="block text-[11px] font-bold text-slate-700">Tahun Terbit *</label>
                    <input type="text" name="year[]" required value="<?= esc($b['year']) ?>"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-[11px] font-bold text-slate-700">Judul Policy Brief *</label>
                <input type="text" name="title[]" required value="<?= esc($b['title']) ?>"
                       class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
            </div>

            <div class="space-y-1">
                <label class="block text-[11px] font-bold text-slate-700">Penyusun & Afiliasi Badan Riset *</label>
                <input type="text" name="author[]" required value="<?= esc($b['author']) ?>"
                       class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
            </div>

            <div class="space-y-1">
                <label class="block text-[11px] font-bold text-slate-700">Ringkasan Eksekutif & Kebijakan *</label>
                <textarea name="desc[]" required rows="3"
                          class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white"><?= esc($b['desc']) ?></textarea>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit" 
                    class="px-6 py-2.5 bg-navy-950 hover:bg-maritime-700 text-gold-400 hover:text-white rounded-xl font-bold text-xs shadow-md transition-all active:scale-[0.98] cursor-pointer flex items-center gap-2">
                <i class="fa-solid fa-check"></i>
                <span>Simpan Seluruh Perubahan Policy Brief</span>
            </button>
        </div>
    </form>

</div>

<?= $this->endSection() ?>
