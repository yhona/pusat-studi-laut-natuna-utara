<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Edit Naskah Policy Brief</h2>
            <p class="text-xs text-slate-500 mt-1">Perbarui nomor rilis, penyusun, naskah PDF, atau ringkasan rekomendasi.</p>
        </div>
        <a href="<?= base_url('admin/publikasi') ?>" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/publikasi/update/' . $brief['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nomor Naskah Publikasi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="number" required value="<?= esc($brief['number']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono focus:ring-1 focus:ring-maritime-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Jenis Publikasi <span class="text-rose-500">*</span>
                    </label>
                    <select name="type" class="w-full text-xs rounded-xl border border-slate-300 p-2.5 bg-white">
                        <option value="policy_brief" <?= $brief['type'] === 'policy_brief' ? 'selected' : '' ?>>Policy Brief Maritim</option>
                        <option value="jurnal" <?= $brief['type'] === 'jurnal' ? 'selected' : '' ?>>Jurnal & Artikel Ilmiah</option>
                        <option value="monograf" <?= $brief['type'] === 'monograf' ? 'selected' : '' ?>>Buku / Monograf Riset</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Tahun Terbit <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" name="year" required value="<?= esc($brief['year']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Judul Publikasi (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="title" required value="<?= esc($brief['title']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Judul Publikasi (Inggris)
                    </label>
                    <input type="text" name="title_en" value="<?= esc($brief['title_en'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Tim Penulis / Afiliasi (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="author" required value="<?= esc($brief['author']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Tim Penulis / Afiliasi (Inggris)
                    </label>
                    <input type="text" name="author_en" value="<?= esc($brief['author_en'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Ringkasan Eksekutif (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="desc" rows="4" required
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 leading-relaxed"><?= esc($brief['desc']) ?></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Ringkasan Eksekutif (Inggris)
                    </label>
                    <textarea name="desc_en" rows="4"
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 leading-relaxed"><?= esc($brief['desc_en'] ?? '') ?></textarea>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">
                    Ganti Naskah PDF (Biarkan kosong jika tidak diubah)
                </label>
                <input type="file" name="file_pdf" accept=".pdf"
                       class="w-full text-xs rounded-xl border border-slate-300 p-2 bg-slate-50">
                <?php if (!empty($brief['file_path'])): ?>
                    <div class="flex items-center gap-2 mt-2">
                        <i class="fa-solid fa-file-pdf text-rose-600"></i>
                        <span class="text-[11px] text-slate-600 font-mono"><?= esc($brief['file_path']) ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="pt-2 flex items-center gap-2">
                <input type="checkbox" name="is_published" id="is_published" value="1" <?= $brief['is_published'] ? 'checked' : '' ?>
                       class="rounded border-slate-300 text-maritime-600 focus:ring-maritime-500">
                <label for="is_published" class="text-xs text-slate-700 font-semibold">
                    Publikasikan di portal web
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="<?= base_url('admin/publikasi') ?>" 
               class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                Batal
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-md transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
