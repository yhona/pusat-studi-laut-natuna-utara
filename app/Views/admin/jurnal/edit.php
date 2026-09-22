<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Edit Jurnal Ilmiah</h2>
            <p class="text-xs text-slate-500 mt-1">Perbarui status akreditasi, nomor ISSN, tautan OJS, atau cakupan fokus keilmuan.</p>
        </div>
        <a href="<?= base_url('admin/jurnal') ?>" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Validation Errors Alert -->
    <?php if (! empty(session()->getFlashdata('errors'))): ?>
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1.5 shadow-xs">
        <div class="font-bold flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
            <span>Terdapat beberapa kesalahan pengisian formulir:</span>
        </div>
        <ul class="list-disc list-inside pl-2 space-y-0.5 text-slate-600">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <!-- Form -->
    <form action="<?= base_url('admin/jurnal/update/' . $journal['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-5">
            <!-- Slug & Current Public Preview -->
            <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-slate-700">Slug URL:</span>
                    <span class="font-mono text-maritime-700 bg-white px-2 py-0.5 rounded border border-slate-200"><?= esc($journal['slug']) ?></span>
                </div>
                <a href="<?= esc($journal['journal_url']) ?>" target="_blank" rel="noopener noreferrer" 
                   class="inline-flex items-center gap-1.5 font-bold text-maritime-600 hover:text-navy-950">
                    <span>Kunjungi Portal OJS Aktif</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </a>
            </div>

            <!-- Nama Jurnal ID & EN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nama Jurnal Ilmiah (Bahasa Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="name" required value="<?= esc(old('name', $journal['name'])) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nama Jurnal Ilmiah (Bahasa Inggris)
                    </label>
                    <input type="text" name="name_en" value="<?= esc(old('name_en', $journal['name_en'] ?? '')) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
                </div>
            </div>

            <!-- Indeksasi, ISSN, URL OJS -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Status Akreditasi / Indeksasi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="indexing" required value="<?= esc(old('indexing', $journal['indexing'])) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nomor ISSN / e-ISSN <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="issn" required value="<?= esc(old('issn', $journal['issn'])) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono focus:ring-1 focus:ring-maritime-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        URL Portal OJS Resmi <span class="text-rose-500">*</span>
                    </label>
                    <input type="url" name="journal_url" required value="<?= esc(old('journal_url', $journal['journal_url'])) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
                </div>
            </div>

            <!-- Frekuensi Terbitan ID & EN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Frekuensi Terbitan (Indonesia)
                    </label>
                    <input type="text" name="frequency" value="<?= esc(old('frequency', $journal['frequency'] ?? 'Terbit 2x Setahun')) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Frekuensi Terbitan (Inggris)
                    </label>
                    <input type="text" name="frequency_en" value="<?= esc(old('frequency_en', $journal['frequency_en'] ?? 'Biannual Publication')) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
                </div>
            </div>

            <!-- Deskripsi Focus & Scope ID & EN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Fokus & Ruang Lingkup / Deskripsi (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="description" rows="4" required
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 leading-relaxed focus:ring-1 focus:ring-maritime-500"><?= esc(old('description', $journal['description'])) ?></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Focus & Scope / Description (English)
                    </label>
                    <textarea name="description_en" rows="4"
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 leading-relaxed focus:ring-1 focus:ring-maritime-500"><?= esc(old('description_en', $journal['description_en'] ?? '')) ?></textarea>
                </div>
            </div>

            <!-- Cover Image & Order Num -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Ganti Gambar Sampul (Biarkan kosong jika tidak diubah)
                    </label>
                    <input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2 bg-slate-50">
                    <?php if (! empty($journal['cover_image'])): ?>
                        <div class="flex items-center gap-3 mt-2.5 p-2 bg-slate-50 rounded-xl border border-slate-200">
                            <img src="<?= base_url($journal['cover_image']) ?>" alt="Cover" class="w-12 h-16 object-cover rounded shadow-xs">
                            <div class="text-[11px] text-slate-500 truncate">
                                <span class="block font-bold text-slate-700">Sampul Saat Ini:</span>
                                <span class="font-mono"><?= esc($journal['cover_image']) ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nomor Urutan Tampil
                    </label>
                    <input type="number" name="order_num" value="<?= esc(old('order_num', $journal['order_num'] ?? 0)) ?>" min="0"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono focus:ring-1 focus:ring-maritime-500">
                </div>
            </div>

            <!-- Status Aktif Checkbox -->
            <div class="pt-2 flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" <?= ! empty($journal['is_active']) ? 'checked' : '' ?>
                       class="rounded border-slate-300 text-maritime-600 focus:ring-maritime-500">
                <label for="is_active" class="text-xs text-slate-700 font-semibold cursor-pointer">
                    Publikasikan dan tampilkan langsung di halaman publik (/publikasi#jurnal)
                </label>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3">
            <a href="<?= base_url('admin/jurnal') ?>" 
               class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                Batal
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-md transition-all active:scale-[0.98]">
                Simpan Perubahan Jurnal
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
