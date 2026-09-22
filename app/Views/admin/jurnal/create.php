<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Tambah Jurnal Ilmiah Baru</h2>
            <p class="text-xs text-slate-500 mt-1">Daftarkan terbitan berkala ilmiah kemaritiman binaan Universitas Maritim Raja Ali Haji.</p>
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
    <form action="<?= base_url('admin/jurnal/store') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-5">
            <!-- Nama Jurnal ID & EN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nama Jurnal Ilmiah (Bahasa Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="name" required value="<?= old('name') ?>" placeholder="Contoh: Jurnal Akuatiklestari"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nama Jurnal Ilmiah (Bahasa Inggris)
                    </label>
                    <input type="text" name="name_en" value="<?= old('name_en') ?>" placeholder="English title or same title..."
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
                </div>
            </div>

            <!-- Indeksasi, ISSN, URL OJS -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Status Akreditasi / Indeksasi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="indexing" required value="<?= old('indexing') ?>" placeholder="Contoh: SINTA 3 / Crossref / Garuda"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nomor ISSN / e-ISSN <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="issn" required value="<?= old('issn') ?>" placeholder="Contoh: e-ISSN: 2598-8204"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono focus:ring-1 focus:ring-maritime-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        URL Portal OJS Resmi <span class="text-rose-500">*</span>
                    </label>
                    <input type="url" name="journal_url" required value="<?= old('journal_url') ?>" placeholder="https://ojs.umrah.ac.id/..."
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
                </div>
            </div>

            <!-- Frekuensi Terbitan ID & EN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Frekuensi Terbitan (Indonesia)
                    </label>
                    <input type="text" name="frequency" value="<?= old('frequency', 'Terbit 2x Setahun') ?>" placeholder="Contoh: Terbit 2x Setahun (Juni & Desember)"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Frekuensi Terbitan (Inggris)
                    </label>
                    <input type="text" name="frequency_en" value="<?= old('frequency_en', 'Biannual Publication') ?>" placeholder="Example: Biannual Publication (June & Dec)"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
                </div>
            </div>

            <!-- Deskripsi Focus & Scope ID & EN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Fokus & Ruang Lingkup / Deskripsi (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="description" rows="4" required placeholder="Uraikan cakupan tema, prodi pengelola, dan fokus keilmuan jurnal..."
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 leading-relaxed focus:ring-1 focus:ring-maritime-500"><?= old('description') ?></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Focus & Scope / Description (English)
                    </label>
                    <textarea name="description_en" rows="4" placeholder="Describe the focus, managing faculty, and academic scope in English..."
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 leading-relaxed focus:ring-1 focus:ring-maritime-500"><?= old('description_en') ?></textarea>
                </div>
            </div>

            <!-- Cover Image & Order Num -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Gambar Sampul Jurnal (Opsional, max 4MB, JPG/PNG/WebP)
                    </label>
                    <input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2 bg-slate-50">
                    <p class="text-[11px] text-slate-400 mt-1">Dianjurkan rasio 3:4 atau sampul resmi OJS.</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nomor Urutan Tampil
                    </label>
                    <input type="number" name="order_num" value="<?= old('order_num', 0) ?>" min="0"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono focus:ring-1 focus:ring-maritime-500">
                </div>
            </div>

            <!-- Status Aktif Checkbox -->
            <div class="pt-2 flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked
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
                Simpan Jurnal Baru
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
