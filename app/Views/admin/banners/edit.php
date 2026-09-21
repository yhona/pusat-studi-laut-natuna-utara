<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Sunting Banner Slider</h2>
            <p class="text-xs text-slate-500 mt-1">Perbarui teks, gambar, atau tautan slide beranda.</p>
        </div>
        <a href="<?= base_url('admin/banners') ?>" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/banners/update/' . $banner['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-5">
            <!-- Current Image Preview -->
            <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                <div class="w-32 h-20 rounded-lg overflow-hidden bg-navy-950 shrink-0 border border-slate-300">
                    <img src="<?= base_url(esc($banner['image'])) ?>" alt="<?= esc($banner['title']) ?>" class="w-full h-full object-cover">
                </div>
                <div class="space-y-1 text-xs">
                    <span class="font-bold text-navy-950 block">Gambar Saat Ini:</span>
                    <span class="font-mono text-slate-600 block"><?= esc($banner['image']) ?></span>
                </div>
            </div>

            <!-- Badge & Tag -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Badge Label (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="badge" required value="<?= esc($banner['badge']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Badge Label (Inggris)
                    </label>
                    <input type="text" name="badge_en" value="<?= esc($banner['badge_en']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <!-- Title (ID & EN) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Judul Banner (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="title" required value="<?= esc($banner['title']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Judul Banner (Inggris)
                    </label>
                    <input type="text" name="title_en" value="<?= esc($banner['title_en']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <!-- Description (ID & EN) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Uraian Deskripsi (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="desc" rows="4" required class="w-full text-xs rounded-xl border border-slate-300 p-2.5 leading-relaxed"><?= esc($banner['desc']) ?></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Uraian Deskripsi (Inggris)
                    </label>
                    <textarea name="desc_en" rows="4" class="w-full text-xs rounded-xl border border-slate-300 p-2.5 leading-relaxed"><?= esc($banner['desc_en']) ?></textarea>
                </div>
            </div>

            <!-- Link URL & Tag Badges -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Target URL / Link Tombol
                    </label>
                    <input type="text" name="link_url" value="<?= esc($banner['link_url']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Tag Badge (Indonesia)
                    </label>
                    <input type="text" name="tag" value="<?= esc($banner['tag']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Tag Badge (Inggris)
                    </label>
                    <input type="text" name="tag_en" value="<?= esc($banner['tag_en']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <!-- Image Selection / Upload -->
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-3">
                <span class="text-xs font-bold text-navy-950 block">Ubah Gambar Latar</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Pilih dari Preset</label>
                        <select name="image_preset" class="w-full text-xs rounded-xl border border-slate-300 p-2.5 bg-white">
                            <option value="">-- Tetap Gunakan Gambar Saat Ini --</option>
                            <option value="images/hero_ship.jpg">Kapal Riset Bahari (images/hero_ship.jpg)</option>
                            <option value="images/batimetri_survey.jpg">Survei Batimetri & Akustik (images/batimetri_survey.jpg)</option>
                            <option value="images/mangrove_research.jpg">Riset Mangrove & Karbon (images/mangrove_research.jpg)</option>
                            <option value="images/kampus_umrah_dompak.jpg">Kampus UMRAH Dompak (images/kampus_umrah_dompak.jpg)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Atau Unggah Berkas Pengganti</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-xs file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-navy-900 file:text-gold-400 hover:file:bg-navy-800">
                    </div>
                </div>
            </div>

            <!-- Order & Active Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center pt-2">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Urutan (Sequence)</label>
                    <input type="number" name="order_seq" value="<?= esc($banner['order_seq']) ?>" min="1" max="99" class="w-32 text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div class="flex items-center gap-2 pt-5">
                    <input type="checkbox" name="is_active" id="is_active" value="1" <?= $banner['is_active'] ? 'checked' : '' ?> class="rounded border-slate-300 text-maritime-600 focus:ring-maritime-500">
                    <label for="is_active" class="text-xs font-semibold text-slate-700">Aktifkan Slide di Beranda Publik</label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('admin/banners') ?>" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 text-xs font-semibold hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-md transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-save mr-1.5"></i> Perbarui Banner
                </button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
