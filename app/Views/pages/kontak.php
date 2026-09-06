<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Page Header Banner -->
<div class="bg-navy-950 text-white py-14 relative overflow-hidden border-b-2 border-gold-500">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex items-center space-x-2 text-xs text-gold-400 mb-2 font-medium">
            <a href="<?= base_url() ?>" class="hover:underline">Beranda</a>
            <span>/</span>
            <span class="text-slate-300">Kontak</span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white">Kontak & Pengajuan Kerjasama Riset</h1>
        <p class="text-slate-300 text-xs sm:text-sm mt-1 max-w-2xl">
            Hubungi sekretariat Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center) UMRAH untuk diskusi inisiasi penelitian kolaboratif, permohonan jasa survei, dan konsultasi kebijakan.
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <?php if (!empty($success)): ?>
        <div class="mb-8 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
            <span><?= esc($success) ?></span>
        </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
        <div class="mb-8 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm flex items-center gap-3">
            <i class="fa-solid fa-triangle-exclamation text-rose-600 text-lg"></i>
            <span><?= esc($error) ?></span>
        </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Col 1: Information & Address -->
            <div class="lg:col-span-5 space-y-6">
                
                <div class="bg-white rounded-2xl p-7 border border-slate-200 shadow-xs space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block">Sekretariat Resmi</span>
                        <h3 class="text-lg font-bold text-navy-950 mt-1">Pusat Studi Laut Natuna Utara (NNSRC UMRAH)</h3>
                    </div>

                    <div class="space-y-4 text-xs sm:text-sm text-slate-600">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center flex-shrink-0 text-sm mt-0.5">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <strong class="text-navy-900 block">Alamat Kantor:</strong>
                                <span>Gedung LPPM UMRAH Lantai 2, Kampus Terpadu Dompak, Jl. Politeknik, Kota Tanjungpinang, Kepulauan Riau 29111</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center flex-shrink-0 text-sm">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <strong class="text-navy-900 block">Email Resmi:</strong>
                                <span>psk@umrah.ac.id / lppm@umrah.ac.id</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center flex-shrink-0 text-sm">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <strong class="text-navy-900 block">Telepon / Narahubung:</strong>
                                <span>(0771) 4500089 | WhatsApp: 0812-7000-8991</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center flex-shrink-0 text-sm mt-0.5">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <strong class="text-navy-900 block">Waktu Layanan:</strong>
                                <span>Senin – Jumat: 08.00 – 16.00 WIB</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Campus Location Map Box Placeholder -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-3">
                    <h4 class="text-xs font-bold text-navy-950 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-map text-maritime-600"></i> Lokasi Kampus Dompak UMRAH
                    </h4>
                    <div class="h-44 rounded-xl bg-slate-100 border border-slate-200 flex flex-col items-center justify-center text-slate-400 text-xs p-4 text-center space-y-2">
                        <i class="fa-solid fa-location-crosshairs text-3xl text-maritime-600"></i>
                        <span class="font-medium text-slate-600">Pulau Dompak, Tanjungpinang</span>
                        <a href="https://maps.google.com/?q=Universitas+Maritim+Raja+Ali+Haji+Dompak" target="_blank" class="text-maritime-600 underline font-semibold">
                            Buka di Google Maps →
                        </a>
                    </div>
                </div>

            </div>

            <!-- Col 2: Consultation & Collaboration Form -->
            <div class="lg:col-span-7" id="kerjasama">
                <div class="bg-white rounded-2xl p-7 sm:p-9 border border-slate-200 shadow-sm space-y-6">
                    <div>
                        <span class="text-gold-600 uppercase text-xs font-bold tracking-wider block">Formulir Terpadu</span>
                        <h3 class="text-xl sm:text-2xl font-bold text-navy-950 mt-1">Pengajuan Inisiasi Riset & Konsultasi</h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1">Silakan lengkapi formulir berikut. Tim sekretariat akan menindaklanjuti dalam kurun 1x24 jam kerja.</p>
                    </div>

                    <form action="<?= base_url('kontak/kirim') ?>" method="POST" class="space-y-4 text-xs sm:text-sm">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block font-semibold text-slate-700">Nama Lengkap & Gelar <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama" value="<?= esc(old('nama')) ?>" required placeholder="Contoh: Dr. Ahmad Fauzi" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-maritime-600 text-xs sm:text-sm">
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-semibold text-slate-700">Institusi / Lembaga / Perusahaan <span class="text-rose-500">*</span></label>
                                <input type="text" name="instansi" value="<?= esc(old('instansi')) ?>" required placeholder="Contoh: Dinas Kelautan & Perikanan / PT XYZ" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-maritime-600 text-xs sm:text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block font-semibold text-slate-700">Email Resmi <span class="text-rose-500">*</span></label>
                                <input type="email" name="email" value="<?= esc(old('email')) ?>" required placeholder="nama@instansi.go.id" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-maritime-600 text-xs sm:text-sm">
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-semibold text-slate-700">Nomor Kontak / WhatsApp <span class="text-rose-500">*</span></label>
                                <input type="tel" name="telepon" value="<?= esc(old('telepon')) ?>" required placeholder="0812xxxxxxxx" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-maritime-600 text-xs sm:text-sm">
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block font-semibold text-slate-700">Kategori Keperluan / Layanan <span class="text-rose-500">*</span></label>
                            <select name="kategori" required class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-maritime-600 text-xs sm:text-sm bg-white text-slate-700">
                                <option value="">-- Pilih Kategori Layanan --</option>
                                <option value="kerjasama" <?= old('kategori') === 'kerjasama' ? 'selected' : '' ?>>Inisiasi MoU / Perjanjian Kerjasama Riset</option>
                                <option value="batimetri" <?= old('kategori') === 'batimetri' ? 'selected' : '' ?>>Permohonan Jasa Survei Batimetri & Oseanografi</option>
                                <option value="amdal" <?= old('kategori') === 'amdal' ? 'selected' : '' ?>>Uji Kualitas Air Laut & Kajian AMDAL Pesisir</option>
                                <option value="zonasi" <?= old('kategori') === 'zonasi' ? 'selected' : '' ?>>Konsultasi Regulasi Zonasi Ruang Laut (RZWP-3-K)</option>
                                <option value="pelatihan" <?= old('kategori') === 'pelatihan' ? 'selected' : '' ?>>Pelatihan GIS & Remote Sensing Kelautan</option>
                                <option value="lainnya" <?= old('kategori') === 'lainnya' ? 'selected' : '' ?>>Pertanyaan Umum / Lainnya</option>
                            </select>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block font-semibold text-slate-700">Uraian Ringkas Kebutuhan / Kerjasama <span class="text-rose-500">*</span></label>
                            <textarea name="pesan" rows="4" required placeholder="Jelaskan secara singkat latar belakang kebutuhan, lokasi perairan terkait, dan jadwal yang diharapkan..." class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-maritime-600 text-xs sm:text-sm"><?= esc(old('pesan')) ?></textarea>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-navy-900 hover:bg-navy-950 text-gold-400 font-bold text-xs sm:text-sm shadow-md transition-all">
                                <i class="fa-solid fa-paper-plane"></i> Kirim Pengajuan Kerjasama
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>

<?= $this->endSection() ?>
