<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Sambutan Pimpinan / Koordinator</h2>
            <p class="text-xs text-slate-500 mt-1">
                Atur foto, nama pimpinan, gelar, dan narasi sambutan utama yang tampil di beranda depan portal.
            </p>
        </div>
        <a href="<?= base_url() ?>#sambutan" target="_blank"
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
            <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
            <span>Lihat di Beranda</span>
        </a>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/sambutan/update') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-6">
            
            <!-- Foto Pimpinan & Info Dasar -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start pb-6 border-b border-slate-100">
                <div class="md:col-span-4 flex flex-col items-center text-center">
                    <label class="block text-xs font-bold text-slate-700 mb-2">Foto Resmi Pimpinan</label>
                    <div class="w-44 h-52 rounded-2xl overflow-hidden border-2 border-slate-200 shadow-md relative bg-slate-100">
                        <img src="<?= base_url(esc($sambutan['image'])) ?>" alt="<?= esc($sambutan['name']) ?>" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="mt-3 w-full">
                        <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                               class="text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-navy-900 file:text-gold-400 hover:file:bg-navy-800 cursor-pointer w-full">
                        <p class="text-[10px] text-slate-400 mt-1">JPG, PNG, atau WebP (Maks. 5MB)</p>
                    </div>
                </div>

                <div class="md:col-span-8 space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Nama Lengkap & Gelar Pimpinan <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="name" required placeholder="Contoh: Dr. Atika Thahira, S.H., M.H."
                               value="<?= old('name', $sambutan['name']) ?>"
                               class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none font-bold">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Jabatan / Amanah (Bahasa Indonesia) <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="title" required placeholder="Contoh: Koordinator Pusat Studi Laut Natuna Utara UMRAH"
                               value="<?= old('title', $sambutan['title']) ?>"
                               class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Jabatan / Amanah (Bahasa Inggris)
                        </label>
                        <input type="text" name="title_en" placeholder="Contoh: Center Coordinator of North Natuna Sea Research Center UMRAH"
                               value="<?= old('title_en', $sambutan['title_en']) ?>"
                               class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                    </div>

                    <div class="pt-2">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" <?= old('is_active', $sambutan['is_active']) ? 'checked' : '' ?>
                                   class="rounded text-maritime-600 focus:ring-maritime-500 w-4 h-4">
                            <span class="text-xs font-semibold text-slate-700">Tampilkan Blok Sambutan di Beranda</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Headings -->
            <div class="space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-wider text-maritime-600">Judul Utama Sambutan</h4>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Judul Utama (Bahasa Indonesia)
                        </label>
                        <input type="text" name="heading" placeholder="Contoh: Mengokohkan Kedaulatan Bahari Melalui Riset Saintifik..."
                               value="<?= old('heading', $sambutan['heading'] ?? '') ?>"
                               class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none font-semibold">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Judul Utama (Bahasa Inggris)
                        </label>
                        <input type="text" name="heading_en" placeholder="Contoh: Strengthening Maritime Sovereignty Through Scientific Rigor..."
                               value="<?= old('heading_en', $sambutan['heading_en'] ?? '') ?>"
                               class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Kutipan Kunci / Quote -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h4 class="text-xs font-bold uppercase tracking-wider text-maritime-600">Kutipan Kunci (Highlight Quote)</h4>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Kutipan Kunci (Bahasa Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="quote" rows="3" required placeholder="Kutipan visi strategis pimpinan..."
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none italic"><?= old('quote', $sambutan['quote']) ?></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Kutipan Kunci (Bahasa Inggris)
                    </label>
                    <textarea name="quote_en" rows="3" placeholder="Key visionary quote from the coordinator..."
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none italic"><?= old('quote_en', $sambutan['quote_en']) ?></textarea>
                </div>
            </div>

            <!-- Narasi Sambutan Lengkap -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h4 class="text-xs font-bold uppercase tracking-wider text-maritime-600">Narasi Sambutan Lengkap</h4>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Narasi / Paragraf Sambutan (Bahasa Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="content" rows="4" required placeholder="Paragraf sambutan yang menguraikan visi riset maritim..."
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none leading-relaxed"><?= old('content', $sambutan['content']) ?></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Narasi / Paragraf Sambutan (Bahasa Inggris)
                    </label>
                    <textarea name="content_en" rows="4" placeholder="Paragraph of the leader's address detailing the maritime research vision..."
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none leading-relaxed"><?= old('content_en', $sambutan['content_en']) ?></textarea>
                </div>
            </div>

            <!-- Buttons -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <button type="submit" 
                        class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-save mr-1.5"></i> Simpan Perubahan Sambutan
                </button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
