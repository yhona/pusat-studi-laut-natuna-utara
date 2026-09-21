<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Sunting Dokumentasi Riset</h2>
            <p class="text-xs text-slate-500 mt-1">Perbarui detail ekspedisi, parameter riset, atau foto dokumentasi.</p>
        </div>
        <a href="<?= base_url('admin/galeri') ?>" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/galeri/update/' . $item['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-5">
            <!-- Current Photo Preview -->
            <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                <div class="w-32 h-20 rounded-lg bg-navy-950 overflow-hidden shrink-0 border border-slate-300">
                    <img src="<?= base_url(esc($item['image'])) ?>" alt="<?= esc($item['title']) ?>" class="w-full h-full object-cover">
                </div>
                <div class="space-y-1 text-xs">
                    <span class="font-bold text-navy-950 block">Berkas Foto Saat Ini:</span>
                    <span class="font-mono text-slate-600 block"><?= esc($item['image']) ?></span>
                </div>
            </div>

            <!-- Title & Category -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Judul Kegiatan / Ekspedisi (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="title" required value="<?= esc($item['title']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Kategori Kegiatan <span class="text-rose-500">*</span>
                    </label>
                    <select name="category" required class="w-full text-xs rounded-xl border border-slate-300 p-2.5 bg-white">
                        <option value="ekspedisi" <?= $item['category'] === 'ekspedisi' ? 'selected' : '' ?>>Ekspedisi Laut</option>
                        <option value="laboratorium" <?= $item['category'] === 'laboratorium' ? 'selected' : '' ?>>Laboratorium</option>
                        <option value="blue-carbon" <?= $item['category'] === 'blue-carbon' ? 'selected' : '' ?>>Blue Carbon</option>
                    </select>
                </div>
            </div>

            <!-- Title EN -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">
                    Judul Kegiatan / Ekspedisi (Inggris)
                </label>
                <input type="text" name="title_en" value="<?= esc($item['title_en']) ?>"
                       class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
            </div>

            <!-- Date & Location -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Waktu Pelaksanaan (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="date_text" required value="<?= esc($item['date_text']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Waktu Pelaksanaan (Inggris)
                    </label>
                    <input type="text" name="date_text_en" value="<?= esc($item['date_text_en']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Lokasi / Wilayah Survei (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="location" required value="<?= esc($item['location']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Lokasi / Wilayah Survei (Inggris)
                    </label>
                    <input type="text" name="location_en" value="<?= esc($item['location_en']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <!-- Vessel & Focal -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Wahana / Kapal / Fasilitas Riset (Indonesia)
                    </label>
                    <input type="text" name="vessel" value="<?= esc($item['vessel']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Wahana / Kapal / Fasilitas Riset (Inggris)
                    </label>
                    <input type="text" name="vessel_en" value="<?= esc($item['vessel_en']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Fokus Kajian / Parameter (Indonesia)
                    </label>
                    <input type="text" name="focal" value="<?= esc($item['focal']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Fokus Kajian / Parameter (Inggris)
                    </label>
                    <input type="text" name="focal_en" value="<?= esc($item['focal_en']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <!-- Narrative Description -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Uraian Teknis Dokumentasi (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="desc" rows="4" required class="w-full text-xs rounded-xl border border-slate-300 p-2.5 leading-relaxed"><?= esc($item['desc']) ?></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Uraian Teknis Dokumentasi (Inggris)
                    </label>
                    <textarea name="desc_en" rows="4" class="w-full text-xs rounded-xl border border-slate-300 p-2.5 leading-relaxed"><?= esc($item['desc_en']) ?></textarea>
                </div>
            </div>

            <!-- Image Selection / Upload -->
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-3">
                <span class="text-xs font-bold text-navy-950 block">Ubah Foto Dokumentasi</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Pilih dari Preset Gambar</label>
                        <select name="image_preset" class="w-full text-xs rounded-xl border border-slate-300 p-2.5 bg-white">
                            <option value="">-- Tetap Gunakan Foto Saat Ini --</option>
                            <option value="images/hero_ship.jpg">Ekspedisi Kapal Bahari (images/hero_ship.jpg)</option>
                            <option value="images/batimetri_survey.jpg">Survei Batimetri (images/batimetri_survey.jpg)</option>
                            <option value="images/mangrove_research.jpg">Riset Mangrove Bintan (images/mangrove_research.jpg)</option>
                            <option value="images/lab_oseanografi.jpg">Lab Oseanografi (images/lab_oseanografi.jpg)</option>
                            <option value="images/kualitas_air_sedimen.jpg">Analisis Air & Sedimen (images/kualitas_air_sedimen.jpg)</option>
                            <option value="images/stasiun_pasut_cuaca.jpg">Stasiun Pasut & Cuaca (images/stasiun_pasut_cuaca.jpg)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Atau Unggah Berkas Baru</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-xs file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-navy-900 file:text-gold-400 hover:file:bg-navy-800">
                    </div>
                </div>
            </div>

            <!-- Order & Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center pt-2">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Urutan Tampilan</label>
                    <input type="number" name="order_seq" value="<?= esc($item['order_seq']) ?>" min="1" max="99" class="w-32 text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div class="flex items-center gap-2 pt-5">
                    <input type="checkbox" name="is_active" id="is_active" value="1" <?= $item['is_active'] ? 'checked' : '' ?> class="rounded border-slate-300 text-maritime-600 focus:ring-maritime-500">
                    <label for="is_active" class="text-xs font-semibold text-slate-700">Tampilkan di Galeri Beranda</label>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('admin/galeri') ?>" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 text-xs font-semibold hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-md transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-save mr-1.5"></i> Perbarui Dokumentasi
                </button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
